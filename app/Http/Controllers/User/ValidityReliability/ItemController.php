<?php

namespace App\Http\Controllers\User\ValidityReliability;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ItemGroupRepository;
use App\Repositories\TicketDataRepository;
use App\Repositories\ItemValidationRepository;
use App\Repositories\ValidityReliabilityRepository;

use DataTables, DB;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        $this->vr = new ValidityReliabilityRepository();
        $this->ticket = new TicketDataRepository();
        $this->groupRepo = new ItemGroupRepository();
        $this->itemRepo = new ItemValidationRepository();
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            try {
                $group = $this->groupRepo->getByUserId(auth()->user()->id, 'validation');
                $data = $this->itemRepo->getByTicketId($group ? $group->id : 0);
                return DataTables::of($data)
                                ->addIndexColumn()
                                ->addColumn('action', function ($row){
                                    return '
                                        <button onclick="openModal('.$row['id'].')" class="btn btn-warning m-1 py-2"><i class="mdi mdi-lead-pencil"></i></button>
                                        <button onclick="deleteData('.$row['id'].')" class="btn btn-danger m-1 py-2"><i class="mdi mdi-delete-forever"></i></button>
                                    ';
                                })
                                ->rawColumns(['action'])
                                ->make(true);
            } catch (\Throwable $th) {
                return response()->json(['message' => 'Server error : '.$th->getMessage()], 500);
            }
        }

        return view('pages.research.validity-reliability.item');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $action = route('user.validity-and-reliability-item.store');

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
            'item_name' => ['required', 'string']
        ]);

        try {
            DB::beginTransaction();

            // $group_id = 0;
            $qualification = 1;

            $getGroup = $this->groupRepo->getByUserId(auth()->user()->id, 'validation');
            if(!$getGroup) {
                $groupData = [
                    'item_number' => $this->groupRepo->getGroupNumber(),
                    'user_id' => auth()->user()->id,
                    'type' => 'validation',
                ];

                $groupCreate = $this->groupRepo->create($groupData);
                $group_id = $groupCreate->id;
            } else {
                $group_id = $getGroup->id;
                $getLastItem = $this->itemRepo->getDataOrderByLastNumber($group_id);
                if($getLastItem){
                    $this->ticket->deleteByUserId(auth()->user()->id, 'validity-reliability');
                    $qualification = intval($getLastItem->id)+1;
                } else {
                    $qualification = 1;
                }

            }

            $data = [
                'item_name' => $request->item_name,
                'qualification' => $qualification,
                'group_id' => $group_id
            ];

            $this->itemRepo->create($data);

            DB::commit();

            return response()->json(['message' => 'Data saved successfully'], 200);
        } catch (\Throwable $th) {
            DB::rollback();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            DB::beginTransaction();

            $delete = $this->itemRepo->deleteData($id);
            $this->ticket->deleteByUserId(auth()->user()->id, 'validity-reliability');

            DB::commit();

            if($delete) return response()->json(['message' => 'Data deleted successfully'], 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => 'server error: '.$th->getMessage()], 500);
        }
    }
}
