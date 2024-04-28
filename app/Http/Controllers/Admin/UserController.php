<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\UserRepository;
use DataTables, DB, Hash;

class UserController extends Controller
{
    private $repo;
    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }
    public function index(Request $request, string $role)
    {
        if($request->ajax()) {
            if($role == 'admin-data'){
                $data = $this->repo->getByRole('2');
                return DataTables::of($data)
                                    ->addIndexColumn()
                                    ->addColumn('profile', function($row) {
                                        if($row['profile_picture']) return '<div class="text-center"> <img src="'.$row['profile_picture'].'" style="width: 50px; height: auto" /> </div>';
                                        else return '<div class="text-center"> <small><em>No Profile</em></small> </div>';
                                    })
                                    ->addColumn('status', function ($row){
                                        if($row['email_verified_at']) return '<span class="text-success fst-italic">Active</span>';
                                        else return '<span class="text-danger fst-italic">Not Activated</span>';
                                    })
                                    ->addColumn('action', function ($row){
                                        return '
                                            <button onclick="openModal('.$row['id'].')" class="btn btn-warning m-1 py-2"><i class="mdi mdi-lead-pencil"></i></button>
                                            <button onclick="deleteData('.$row['id'].')" class="btn btn-danger m-1 py-2"><i class="mdi mdi-delete-forever"></i></button>
                                        ';
                                    })
                                    ->rawColumns(['profile', 'status', 'action'])
                                    ->make(true);
            } elseif($role == 'user-data'){
                $data = $this->repo->getByRole('3');
                return DataTables::of($data)
                                    ->addIndexColumn()
                                    ->addColumn('profile', function($row) {
                                        if($row['profile_picture']) return '<div class="text-center"> <img src="'.asset('storage'.auth()->user()->profile_picture).'" style="width: 50px; height: auto" /> </div>';
                                        else return '<div class="text-center"> <small><em>No Profile</em></small> </div>';
                                    })
                                    ->addColumn('status', function ($row){
                                        if($row['email_verified_at']) return '<span class="text-success fst-italic">Active</span>';
                                        else return '<span class="text-danger fst-italic">Not Activated</span>';
                                    })
                                    ->addColumn('action', function ($row){
                                        return '
                                            <button onclick="openModal('.$row['id'].')" class="btn btn-warning m-1 py-2"><i class="mdi mdi-lead-pencil"></i></button>
                                            <button onclick="deleteData('.$row['id'].')" class="btn btn-danger m-1 py-2"><i class="mdi mdi-delete-forever"></i></button>
                                        ';
                                    })
                                    ->rawColumns(['profile', 'status', 'action'])
                                    ->make(true);
            }
        }
        if($role == 'admin-data') return view('pages.user.admin.index');
        elseif($role == 'user-data') return view('pages.user.user.index');
    }
    public function create(string $role)
    {
        $action = route('admin.user.store', $role);

        $data = [
            'action' => $action,
            'method' => 'POST'
        ];

        return response()->json([
            'data' => $data
        ]);
    }
    public function store(Request $request, string $role)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'username' => ['required', 'string', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string'],
        ]);

        try{
            DB::beginTransaction();

            $data = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_verified_at' => now(),
                'role' => $role == 'admin-data' ? 2 : 3
            ];

            $create = $this->repo->createData($data);

            DB::commit();

            if($create) return response()->json(['message' => 'Data saved successfully'], 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => 'server error: '.$th->getMessage()], 500);
        }
    }
    public function edit(string $role, string $id)
    {
        try{
            DB::beginTransaction();

            $action = route('admin.user.update', [$role, $id]);
            $user = $this->repo->getById($id);
            $data = [
                'action' => $action,
                'method' => 'PUT',
                'name' => $user->name,
                'email' => $user->email,
                'username' => $user->username,
                'password' => $user->password,
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
    public function update(string $role, string $id, Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'username' => ['required', 'string'],
            'email' => ['required', 'email'],
        ]);

        $fst_data = $this->repo->getById($id);
        if($fst_data->username != $request->username) $request->validate([ 'username' => ['unique:users,username'] ]);
        if($fst_data->email != $request->email) $request->validate([ 'email' => ['unique:users,email'] ]);

        try{
            DB::beginTransaction();

            if(!$request->password) $password = $fst_data->password;
            else $password = Hash::make($request->password);

            $data = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $password,
            ];
            $update = $this->repo->updateData($data, intval($id));

            DB::commit();

            if($update) return response()->json(['message' => 'Data saved successfully'], 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => 'server error: '.$th->getMessage()], 500);
        }
    }
    public function destroy(string $role, string $id)
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
