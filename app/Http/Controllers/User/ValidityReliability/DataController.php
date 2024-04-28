<?php

namespace App\Http\Controllers\User\ValidityReliability;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ValidityReliabilityRepository;
use App\Repositories\TicketDataRepository;
use App\Repositories\ItemGroupRepository;
use App\Repositories\ItemValidationRepository;

use App\Imports\ValidityReliabilityImport;
use Excel;
use DataTables, DB, File, Storage;

class DataController extends Controller
{
    public function __construct()
    {
        $this->vr = new ValidityReliabilityRepository();
        $this->ticket = new TicketDataRepository();
        $this->groupRepo = new ItemGroupRepository();
        $this->itemRepo = new ItemValidationRepository();
    }
    public function index()
    {
        try {
            $ticket = $this->ticket->getByUserId(auth()->user()->id, 'validity-reliability');
            $get_validity = \App\Models\MenuAccess::where('menu_name','VALIDITY AND RELIABILITY')->first();

            $group = $this->groupRepo->getByUserId(auth()->user()->id, 'validation');
            $item_data = $this->itemRepo->getByTicketId($group ? $group->id : 0);

            $dataByTicket = $this->vr->getByTicketId($ticket ? $ticket->id : 0);

            $dataByItem = [];
            if($item_data->count() > 0){
                for($i = 0; $i < $item_data->count(); $i++){
                    $dataByItem[] = $this->vr->getByItemAndTicketId($ticket ? $ticket->id : 0, $item_data ? $item_data[$i]->id : 0);
                }
            }

            return view('pages.research.validity-reliability.index', compact(['ticket', 'get_validity', 'item_data', 'dataByTicket', 'dataByItem']));
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Server error : '.$th->getMessage()], 500);
        }
    }
    public function create(Request $request)
    {
        try {
            DB::beginTransaction();

            $ticketData = [
                'ticket_number' => $this->ticket->getTicketNumber(),
                'user_id' => auth()->user()->id,
                'type' => 'validity-reliability',
            ];
            $createTicket = $this->ticket->create($ticketData);
            $group = $this->groupRepo->getByUserId(auth()->user()->id, 'validation');
            $item_data = $this->itemRepo->getByTicketId($group ? $group->id : 0);

            $excel = $request->excel_file;
            if($item_data->count() > 0){
                $import = Excel::import(new ValidityReliabilityImport($createTicket->id, $item_data), $excel);
            } else {
                return redirect()->route('user.validity-and-reliability-item.index')->with('error_data', 'Please insert the item of questionnaire first');
            }

            DB::commit();
            if($import) {
                return back()->with('success_data', 'Data create successfully');
            }

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error_data', $th->getMessage());
        }
    }
    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();

            $delete = $this->ticket->deleteByUserId(auth()->user()->id, 'validity-reliability');

            DB::commit();
            if($delete){
                return back()->with('success_data', 'Data delete successfully');
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Server error : '.$th->getMessage()], 500);
        }
    }
}
