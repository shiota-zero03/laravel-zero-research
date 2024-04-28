<?php

namespace App\Http\Controllers\User\SUS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SusRepository;
use App\Repositories\TicketDataRepository;
use App\Imports\SUSImport;
use Excel;
use DataTables, DB, File, Storage;

class DataController extends Controller
{
    public function __construct()
    {
        $this->sus = new SusRepository();
        $this->ticket = new TicketDataRepository();
    }
    public function index()
    {
        try {
            $ticket = $this->ticket->getByUserId(auth()->user()->id, 'sus');

            $total_nilai = 0;
            $sus_score = 0;
            $acc = '';
            $gs = '';
            $ads = '';

            if($ticket){
                $sus = $this->sus->getByTicketId($ticket->id);
                foreach($sus as $data){
                    $total = ((intval($data['q1']) - 1) + (5 - intval($data['q2'])) + (intval($data['q3']) - 1) + (5 - intval($data['q4'])) + (intval($data['q5']) - 1) + (5 - intval($data['q6'])) + (intval($data['q7']) - 1) + (5 - intval($data['q8'])) + (intval($data['q9']) - 1) + (5 - intval($data['q10'])));
                    $nilai = $total * 2.5;
                    $total_nilai += $nilai;
                }
                $sus_score = $total_nilai / $sus->count();
            }

            if($sus_score < 51){
                $gs = 'F';
                $adj = 'Awful';
                $acc = 'Not Acceptable';
            } else {
                if(($sus_score > 51) && ($sus_score < 68)) {
                    $gs = 'D';
                    $adj = 'Poor';
                } elseif($sus_score == 68) {
                    $gs = 'C';
                    $adj = 'Okay';
                } elseif(($sus_score > 68) && ($sus_score <= 80.3)) {
                    $gs = 'B';
                    $adj = 'Good';
                } elseif($sus_score > 80.3) {
                    $gs = 'A';
                    $adj = 'Excellent';
                }

                if(($sus_score >= 51) && ($sus_score < 61)) $acc = 'Marginal Low';
                elseif(($sus_score >= 61) && ($sus_score < 71)) $acc = 'Marginal High';
                elseif(($sus_score >= 71) && ($sus_score <= 100)) $acc = 'Acceptable';
            }

            $get_sus = \App\Models\MenuAccess::where('menu_name','SUS')->first();

            $sus_data = [
                'sus_score' => number_format($sus_score, '2', '.', ','),
                'acceptability' => $acc,
                'grade_scale' => $gs,
                'adjective' => $adj
            ];

            return view('pages.research.sus.index', compact(['ticket', 'sus_data', 'get_sus']));
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
                'type' => 'sus',
            ];
            $createTicket = $this->ticket->create($ticketData);

            $excel = $request->excel_file;
            $import = Excel::import(new SUSImport($createTicket->id), $excel);

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
                $ticket = $this->ticket->getByUserId(auth()->user()->id, 'sus');
                $data = $this->sus->getByTicketId($ticket ? $ticket->id : 0);
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('sus1', function($row) { return $row['q1'].' | '.(intval($row['q1']) - 1);})
                        ->addColumn('sus2', function($row) { return $row['q2'].' | '.(5 - intval($row['q2']));})
                        ->addColumn('sus3', function($row) { return $row['q3'].' | '.(intval($row['q3']) - 1);})
                        ->addColumn('sus4', function($row) { return $row['q4'].' | '.(5 - intval($row['q4']));})
                        ->addColumn('sus5', function($row) { return $row['q5'].' | '.(intval($row['q5']) - 1);})
                        ->addColumn('sus6', function($row) { return $row['q6'].' | '.(5 - intval($row['q6']));})
                        ->addColumn('sus7', function($row) { return $row['q7'].' | '.(intval($row['q7']) - 1);})
                        ->addColumn('sus8', function($row) { return $row['q8'].' | '.(5 - intval($row['q8']));})
                        ->addColumn('sus9', function($row) { return $row['q9'].' | '.(intval($row['q9']) - 1);})
                        ->addColumn('sus10', function($row) { return $row['q10'].' | '.(5 - intval($row['q10']));})
                        ->addColumn('total', function($row) { return ( (intval($row['q1']) - 1) + (5 - intval($row['q2'])) + (intval($row['q3']) - 1) + (5 - intval($row['q4'])) + (intval($row['q5']) - 1) + (5 - intval($row['q6'])) + (intval($row['q7']) - 1) + (5 - intval($row['q8'])) + (intval($row['q9']) - 1) + (5 - intval($row['q10'])) );})
                        ->addColumn('nilai', function($row) { return ( ((intval($row['q1']) - 1) + (5 - intval($row['q2'])) + (intval($row['q3']) - 1) + (5 - intval($row['q4'])) + (intval($row['q5']) - 1) + (5 - intval($row['q6'])) + (intval($row['q7']) - 1) + (5 - intval($row['q8'])) + (intval($row['q9']) - 1) + (5 - intval($row['q10']))) * 2.5 );})
                        ->rawColumns(['sus1', 'sus2', 'sus3', 'sus4', 'sus5', 'sus6', 'sus7', 'sus8', 'sus9', 'sus10', 'total', 'nilai'])
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

            $delete = $this->ticket->deleteByUserId(auth()->user()->id, 'sus');

            DB::commit();
            if($delete){
                return back()->with('success_data', 'Data delete successfully');
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Server error : '.$th->getMessage()], 500);
        }
    }
}
