<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\MenuRepository;
use DataTables, Storage, File, DB;

class MenuAccessController extends Controller
{
    private $repo;
    public function __construct(MenuRepository $repo)
    {
        $this->repo = $repo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = $this->repo->getAll();
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('template', function ($row){
                                return '<a href="'.asset('storage'.$row['document']).'" class="btn btn-primary m-1 py-2" target="__blank"><i class="mdi mdi-cloud-download me-2"></i>'.basename($row['document']).'</a>';
                            })
                            ->addColumn('action', function ($row){
                                if(auth()->user()->role == 1){
                                    return '
                                        <button onclick="openModal('.$row['id'].')" class="btn btn-warning m-1 py-2"><i class="mdi mdi-lead-pencil"></i></button>
                                        <button onclick="deleteData('.$row['id'].')" class="btn btn-danger m-1 py-2"><i class="mdi mdi-delete-forever"></i></button>
                                    ';
                                } else {
                                    return '
                                        <button onclick="openModal('.$row['id'].')" class="btn btn-warning m-1 py-2"><i class="mdi mdi-lead-pencil"></i></button>
                                    ';
                                }
                            })
                            ->rawColumns(['template', 'action'])
                            ->make(true);
        }

        return view('pages.menu-access.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $action = route('admin.menu-access.menu-access.store');
        $data = [
            'action' => $action,
            'method' => 'POST'
        ];

        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'menu_name' => ['required', 'string', 'unique:menu_accesses,menu_name'],
            'document_template' => ['required', 'file'],
            'status' => ['required', 'string']
        ]);

        try{
            DB::beginTransaction();

            $file = $request->file('document_template');
            $namafile = time().'_'.$file->getClientOriginalName();
            Storage::disk('local')->put('/public/files/template/'.$namafile, File::get($file));
            $saveFile = '/files/template/'.$namafile;

            $data = [
                'menu_name' => \Str::upper($request->menu_name),
                'document' => $saveFile,
                'status' => $request->status
            ];

            $create = $this->repo->createData($data);

            DB::commit();

            if($create) return response()->json(['message' => 'Data saved successfully'], 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => 'server error: '.$th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            DB::beginTransaction();

            $action = route('admin.menu-access.menu-access.update', $id);
            $menu = $this->repo->getById($id);
            $data = [
                'action' => $action,
                'method' => 'PUT',
                'menu_name' => $menu->menu_name,
                'status' => $menu->status,
                'document' => basename($menu->document),
                'id' => $menu->id
            ];

            DB::commit();

            return response()->json([
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => 'server error: '.$th->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'menu_name' => ['required', 'string'],
            'status' => ['required', 'string']
        ]);

        $fst_data = $this->repo->getById($id);
        if($fst_data->menu_name != \Str::upper($request->menu_name)) $request->validate([ 'menu_name' => ['unique:menu_accesses,menu_name'] ]);

        try{
            DB::beginTransaction();

            if($request->file('document_template')) {
                $file = $request->file('document_template');
                $namafile = time().'_'.$file->getClientOriginalName();
                Storage::disk('local')->put('/public/files/template/'.$namafile, File::get($file));
                $saveFile = '/files/template/'.$namafile;
            } else {
                $saveFile = $fst_data->document;
            }

            $data = [
                'menu_name' => \Str::upper($request->menu_name),
                'document' => $saveFile,
                'status' => $request->status
            ];
            $update = $this->repo->updateData($data, intval($id));

            DB::commit();

            if($update) return response()->json(['message' => 'Data saved successfully'], 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => 'server error: '.$th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            DB::beginTransaction();

            $delete = $this->repo->deleteData($id);

            DB::commit();

            if($delete) return response()->json(['message' => 'Data deleted successfully'], 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => 'server error: '.$th->getMessage()], 500);
        }
    }
}
