<?php

namespace App\Http\Controllers\User\UEQ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UeqRepository;
use App\Repositories\TicketDataRepository;
use App\Imports\UEQImport;
use Excel;
use DataTables, DB, File, Storage;

class DataController extends Controller
{
    public function __construct()
    {
        $this->ueq = new UeqRepository();
        $this->ticket = new TicketDataRepository();
    }
    public function index()
    {
        try {
            $ticket = $this->ticket->getByUserId(auth()->user()->id, 'ueq');
            $get_ueq = \App\Models\MenuAccess::where('menu_name','UEQ')->first();

            return view('pages.research.ueq.index', compact(['ticket', 'get_ueq']));
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
                'type' => 'ueq',
            ];
            $createTicket = $this->ticket->create($ticketData);

            $excel = $request->excel_file;
            $import = Excel::import(new UEQImport($createTicket->id), $excel);

            DB::commit();
            if($import) {
                return back()->with('success_data', 'Data create successfully');
            }

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error_data', 'Please use the template provided to send your data');
        }
    }
    public function json(Request $request)
    {
        if($request->ajax()) {
            try {
                $ticket = $this->ticket->getByUserId(auth()->user()->id,'ueq');
                $data = $this->ueq->getByTicketId($ticket ? $ticket->id : 0);
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('att', function($row){
                            return doubleval($row['attractiveness']) > 0 ? number_format($row['attractiveness'], 2, '.', '') : '';
                        })
                        ->addColumn('per', function($row){
                            return doubleval($row['perspicuity']) > 0 ? number_format($row['perspicuity'], 2, '.', '') : '';
                        })
                        ->addColumn('eff', function($row){
                            return doubleval($row['efficiency']) > 0 ? number_format($row['efficiency'], 2, '.', '') : '';
                        })
                        ->addColumn('dep', function($row){
                            return doubleval($row['dependability']) > 0 ? number_format($row['dependability'], 2, '.', '') : '';
                        })
                        ->addColumn('sti', function($row){
                            return doubleval($row['stimulation']) > 0 ? number_format($row['stimulation'], 2, '.', '') : '';
                        })
                        ->addColumn('nov', function($row){
                            return doubleval($row['novelty']) > 0 ? number_format($row['novelty'], 2, '.', '') : '';
                        })
                        ->rawColumns(['att','per','eff','dep','sti','nov'])
                        ->make(true);
            } catch (\Throwable $th) {
                return response()->json(['message' => 'Server error : '.$th->getMessage()], 500);
            }
        }
    }
    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();

            $delete = $this->ticket->deleteByUserId(auth()->user()->id, 'ueq');

            DB::commit();

            return back()->with('success_data', 'Data delete successfully');

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Server error : '.$th->getMessage()], 500);
        }
    }
}
