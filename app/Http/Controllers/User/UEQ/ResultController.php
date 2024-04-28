<?php

namespace App\Http\Controllers\User\UEQ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UeqRepository;
use App\Repositories\TicketDataRepository;
use App\Repositories\TValueRepository;

class ResultController extends Controller
{
    public function __construct()
    {
        $this->ueq = new UeqRepository();
        $this->ticket = new TicketDataRepository();
        $this->t = new TValueRepository();
    }
    public function index()
    {
        $findData = $ticket = $this->ticket->getByUserId(auth()->user()->id, 'ueq');
        if(!$findData) return view('pages.research.ueq.result', compact(['findData']));
        else {
            $data = $this->ueq->getByTicketId($findData->id);
            $qData = $this->dataForQ($findData, $data);
            $ueqScales = $this->UEQScales($findData, $data);
            $phq = $this->PHQ($ueqScales['meanQuestionaire']);
            $benchmark = $this->benchmark($ueqScales['meanQuestionaire'], $ueqScales['type']);

            $show = [
                'phq' => $phq,
                'ueqScales' => $ueqScales,
                'qData' => $qData,
                'data' => $data,
                'benchmark' => $benchmark
            ];

            return view('pages.research.ueq.result', compact(['findData', 'show']));
        }
    }

    public function dataForQ($findData, $data)
    {
        $meanQuestionnaire = [];
        $varQuestionnaire = [];
        $stdQuestionnaire = [];
        $confidenceQuestionnaire = [];
        for ($i=1; $i <= 26 ; $i++) {
            $meanQuestionnaire[] = number_format($this->ueq->getAverageByTicketIdAndType($findData->id, 'q'.$i), 3, '.', '');
        }
        $q1 = 0;$q2 = 0;$q3 = 0;$q4 = 0;$q5 = 0;$q6 = 0;$q7 = 0;$q8 = 0;$q9 = 0;$q10 = 0;$q11 = 0;$q12 = 0;$q13 = 0;$q14 = 0;$q15 = 0;$q16 = 0;$q17 = 0;$q18 = 0;$q19 = 0;$q20 = 0;$q21 = 0;$q22 = 0;$q23 = 0;$q24 = 0;$q25 = 0;$q26 = 0;
        foreach ($data as $index => $dt) {
            $q1 += pow((($dt->q1) - $meanQuestionnaire[0]),2);
            $q2 += pow((($dt->q2) - $meanQuestionnaire[1]),2);
            $q3 += pow((($dt->q3) - $meanQuestionnaire[2]),2);
            $q4 += pow((($dt->q4) - $meanQuestionnaire[3]),2);
            $q5 += pow((($dt->q5) - $meanQuestionnaire[4]),2);
            $q6 += pow((($dt->q6) - $meanQuestionnaire[5]),2);
            $q7 += pow((($dt->q7) - $meanQuestionnaire[6]),2);
            $q8 += pow((($dt->q8) - $meanQuestionnaire[7]),2);
            $q9 += pow((($dt->q9) - $meanQuestionnaire[8]),2);
            $q10 += pow((($dt->q10) - $meanQuestionnaire[9]),2);
            $q11 += pow((($dt->q11) - $meanQuestionnaire[10]),2);
            $q12 += pow((($dt->q12) - $meanQuestionnaire[11]),2);
            $q13 += pow((($dt->q13) - $meanQuestionnaire[12]),2);
            $q14 += pow((($dt->q14) - $meanQuestionnaire[13]),2);
            $q15 += pow((($dt->q15) - $meanQuestionnaire[14]),2);
            $q16 += pow((($dt->q16) - $meanQuestionnaire[15]),2);
            $q17 += pow((($dt->q17) - $meanQuestionnaire[16]),2);
            $q18 += pow((($dt->q18) - $meanQuestionnaire[17]),2);
            $q19 += pow((($dt->q19) - $meanQuestionnaire[18]),2);
            $q20 += pow((($dt->q20) - $meanQuestionnaire[19]),2);
            $q21 += pow((($dt->q21) - $meanQuestionnaire[20]),2);
            $q22 += pow((($dt->q22) - $meanQuestionnaire[21]),2);
            $q23 += pow((($dt->q23) - $meanQuestionnaire[22]),2);
            $q24 += pow((($dt->q24) - $meanQuestionnaire[23]),2);
            $q25 += pow((($dt->q25) - $meanQuestionnaire[24]),2);
            $q26 += pow((($dt->q26) - $meanQuestionnaire[25]),2);
        }
        $quadraticQuestionnaire = [$q1,$q2,$q3,$q4,$q5,$q6,$q7,$q8,$q9,$q10,$q11,$q12,$q13,$q14,$q15,$q16,$q17,$q18,$q19,$q20,$q21,$q22,$q23,$q24,$q25,$q26];
        $t = $this->t->getByItem($data->count());
        for ($i=0; $i < 26 ; $i++) {
            $varQuestionnaire[] = number_format(($quadraticQuestionnaire[$i]) / ($data->count()-1), 3, '.', '');
            $stdQuestionnaire[] = number_format(sqrt($varQuestionnaire[$i]), 3, '.', '');
            $confidenceQuestionnaire[] = number_format($t->t0_05 * ($stdQuestionnaire[$i]/sqrt($data->count())), 3, '.', '');
        }

        return [
            'meanQuestionaire' => $meanQuestionnaire,
            'varQuestionnaire' => $varQuestionnaire,
            'stdQuestionnaire' => $stdQuestionnaire,
            'confidenceQuestionnaire' =>  $confidenceQuestionnaire,
        ];
    }
    public function UEQScales($findData, $data)
    {
        $meanQuestionnaire = [
            number_format($this->ueq->getAverageByTicketIdAndType($findData->id, 'attractiveness'), 3, '.', ''),
            number_format($this->ueq->getAverageByTicketIdAndType($findData->id, 'perspicuity'), 3, '.', ''),
            number_format($this->ueq->getAverageByTicketIdAndType($findData->id, 'efficiency'), 3, '.', ''),
            number_format($this->ueq->getAverageByTicketIdAndType($findData->id, 'dependability'), 3, '.', ''),
            number_format($this->ueq->getAverageByTicketIdAndType($findData->id, 'stimulation'), 3, '.', ''),
            number_format($this->ueq->getAverageByTicketIdAndType($findData->id, 'novelty'), 3, '.', ''),
        ];
        $varQuestionnaire = [];
        $stdQuestionnaire = [];
        $confidenceQuestionnaire = [];
        $att = 0;$per = 0;$eff = 0;$dep = 0;$sti = 0;$nov = 0;
        foreach ($data as $index => $dt) {
            $att += pow((($dt->attractiveness - $meanQuestionnaire[0])), 2);
            $per += pow((($dt->perspicuity - $meanQuestionnaire[1])), 2);
            $eff += pow((($dt->efficiency - $meanQuestionnaire[2])), 2);
            $dep += pow((($dt->dependability - $meanQuestionnaire[3])), 2);
            $sti += pow((($dt->stimulation - $meanQuestionnaire[4])), 2);
            $nov += pow((($dt->novelty - $meanQuestionnaire[5])), 2);
        }
        $quadraticQuestionnaire = [$att, $per, $eff, $dep, $sti, $nov];
        $t = $this->t->getByItem($data->count());
        for ($i=0; $i < 6 ; $i++) {
            $varQuestionnaire[] = number_format(($quadraticQuestionnaire[$i]) / ($data->count()-1), 3, '.', '');
            $stdQuestionnaire[] = number_format(sqrt($varQuestionnaire[$i]), 3, '.', '');
            $confidenceQuestionnaire[] = number_format($t->t0_05 * ($stdQuestionnaire[$i]/sqrt($data->count())), 3, '.', '');
        }
        return [
            'type' => ['Attractiveness', 'Perspicuity', 'Efficiency', 'Dependability', 'Stimulation', 'Novelty'],
            'meanQuestionaire' => $meanQuestionnaire,
            'varQuestionnaire' => $varQuestionnaire,
            'stdQuestionnaire' => $stdQuestionnaire,
            'confidenceQuestionnaire' =>  $confidenceQuestionnaire,
        ];
    }
    public function PHQ($data)
    {
        $att = $data[0];
        $pq = ($data[1]+$data[2]+$data[3])/3;
        $hq = ($data[4]+$data[5])/2;

        return [
            'type' => ['Attractiveness', 'Pragmatic Quality', 'Hedonic Quality'],
            'value' => [$att, $pq, $hq]
        ];
    }
    public function benchmark($data, $type)
    {
        $comparisson = [];
        $interpretation = [];

        ($data[0] <= 0.69) ? $comparisson[] = 'Bad' : (
            (($data[0] > 0.69) && ($data[0] <= 1.18)) ? $comparisson[] = 'Below Average' : (
                (($data[0] > 1.18) && ($data[0] <= 1.58)) ? $comparisson[] = 'Above Average' : (
                    (($data[0] > 1.58) && ($data[0] <= 1.84)) ? $comparisson[] = 'Good' : (
                        $comparisson[] = 'Excellent'
                    )
                )
            )
        );

        ($data[1] <= 0.72) ? $comparisson[] = 'Bad' : (
            (($data[1] > 0.72) && ($data[1] <= 1.2)) ? $comparisson[] = 'Below Average' : (
                (($data[1] > 1.2) && ($data[1] <= 1.73)) ? $comparisson[] = 'Above Average' : (
                    (($data[1] > 1.73) && ($data[1] <= 2)) ? $comparisson[] = 'Good' : (
                        $comparisson[] = 'Excellent'
                    )
                )
            )
        );

        ($data[2] <= 0.6) ? $comparisson[] = 'Bad' : (
            (($data[2] > 0.6) && ($data[2] <= 1.05)) ? $comparisson[] = 'Below Average' : (
                (($data[2] > 1.05) && ($data[2] <= 1.5)) ? $comparisson[] = 'Above Average' : (
                    (($data[2] > 1.5) && ($data[2] <= 1.88)) ? $comparisson[] = 'Good' : (
                        $comparisson[] = 'Excellent'
                    )
                )
            )
        );

        ($data[3] <= 0.78) ? $comparisson[] = 'Bad' : (
            (($data[3] > 0.78) && ($data[3] <= 1.14)) ? $comparisson[] = 'Below Average' : (
                (($data[3] > 1.14) && ($data[3] <= 1.48)) ? $comparisson[] = 'Above Average' : (
                    (($data[3] > 1.48) && ($data[3] <= 1.7)) ? $comparisson[] = 'Good' : (
                        $comparisson[] = 'Excellent'
                    )
                )
            )
        );

        ($data[4] <= 0.5) ? $comparisson[] = 'Bad' : (
            (($data[4] > 0.5) && ($data[4] <= 1)) ? $comparisson[] = 'Below Average' : (
                (($data[4] > 1) && ($data[4] <= 1.35)) ? $comparisson[] = 'Above Average' : (
                    (($data[4] > 1.35) && ($data[4] <= 1.7)) ? $comparisson[] = 'Good' : (
                        $comparisson[] = 'Excellent'
                    )
                )
            )
        );

        ($data[5] <= 0.16) ? $comparisson[] = 'Bad' : (
            (($data[5] > 0.16) && ($data[5] <= 0.7)) ? $comparisson[] = 'Below Average' : (
                (($data[5] > 0.7) && ($data[5] <= 1.12)) ? $comparisson[] = 'Above Average' : (
                    (($data[5] > 1.12) && ($data[5] <= 1.6)) ? $comparisson[] = 'Good' : (
                        $comparisson[] = 'Excellent'
                    )
                )
            )
        );

        for($i = 0; $i < 6; $i++){
            if($comparisson[$i] == 'Bad') $interpretation[] = 'In the range of the 25% worst results';
            if($comparisson[$i] == 'Below Average') $interpretation[] = '50% of results better, 25% of results worse';
            if($comparisson[$i] == 'Above Average') $interpretation[] = '25% of results better, 50% of results worse';
            if($comparisson[$i] == 'Good') $interpretation[] = '10% of results better, 75% of results worse';
            if($comparisson[$i] == 'Excellent') $interpretation[] = 'In the range of the 10% best results';
        }
        return [
            'type' => $type,
            'mean' => $data,
            'comparisson' => $comparisson,
            'interpretation' => $interpretation
        ];
    }
}
