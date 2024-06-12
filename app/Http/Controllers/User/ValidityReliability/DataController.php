<?php

namespace App\Http\Controllers\User\ValidityReliability;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ValidityReliabilityRepository;
use App\Repositories\TicketDataRepository;
use App\Repositories\ItemGroupRepository;
use App\Repositories\ItemValidationRepository;
use App\Repositories\RValueRepository;

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
        $this->r = new RValueRepository();
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
                if( intval(count($dataByItem[0])) > 0 ){
                    $yIndex = [];

                    $sigmaY = 0;
                    $sigmaYY = 0;
                    $sigmaYSquare = 0;

                    $sigmaX = [];
                    $sigmaXX = [];
                    $sigmaXSquare = [];

                    $sigmaXY = [];

                    $sigmaXR = [];

                    foreach ($dataByItem[0] as $index => $item){
                        $countItem = 0;

                        foreach ($item_data as $item_index => $data){
                            $countItem += intval($dataByItem[$item_index][$index]->value);
                        }

                        $sigmaY += $countItem;
                        $yIndex[] = $countItem;
                    }

                    foreach ($yIndex as $index => $item) {
                        $sigmaYY += pow($item, 2);
                    }
                    $sigmaYSquare = pow($sigmaY, 2);

                    foreach ($dataByItem as $index => $item) {
                        $xvaluePerItem = 0;
                        $xxvaluePerItem = 0;
                        $xyPerItem = 0;
                        $xrPerItem = 0;

                        foreach ($item as $key => $value) {
                            $xvaluePerItem += intval($value->value);
                            $xrPerItem += pow(intval($value->value), 2);
                            $xxvaluePerItem += pow(intval($value->value), 2);
                            $xyPerItem += intval($value->value) * $yIndex[$key];
                        }

                        $sigmaX[] = $xvaluePerItem;
                        $sigmaXX[] = $xxvaluePerItem;
                        $sigmaXY[] = $xyPerItem;

                        $sigmaXSquare[] = pow($xvaluePerItem, 2);

                        $sigmaXR[] = $xrPerItem;
                    }
                    $datavr = [
                        'n' => count($yIndex),
                        'r_table' => $this->r->getByItem(count($yIndex))->r_005,
                        'sigma_x' => $sigmaX,
                        'sigma_y' => $sigmaY,
                        'sigma_xx' => $sigmaXX,
                        'sigma_yy' => $sigmaYY,
                        'sigma_xy' => $sigmaXY,
                        'sigmax_sigmax' => $sigmaXSquare,
                        'sigmay_sigmay' => $sigmaYSquare,

                        'sigma_xr' => $sigmaXR
                    ];
                } else {
                    $datavr = null;
                }
            } else {
                $datavr = null;
            }

            return view('pages.research.validity-reliability.index', compact(['ticket', 'get_validity', 'item_data', 'dataByTicket', 'dataByItem', 'datavr']));
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
