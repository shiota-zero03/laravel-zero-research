@extends('pages.template.theme')
@section('title', 'UEQ Result')
@section('content')

    <style>
        .data-scroll{
            overflow-x: scroll;
            white-space: nowrap;
        }
        .data-scroll::-webkit-scrollbar{
            height: 5px;
        }
        .data-scroll::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 20px;
        }
        .data-scroll::-webkit-scrollbar-track{
            background: white;
            border-radius: 20px;
        }
    </style>
    <div class="row">
        <div class="col-12">UEQ Result</div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            @if(!$findData)
                <div class="card p-md-3 p-2 mb-2">
                    <div>
                        <div class="my-1 text-center">
                            <span><em>There is no UEQ Data Found</em></span><br /><br />
                            <a href="{{ route('user.ueq.data.index') }}" class="btn btn-success d-flex align-items-center justify-content-center"><i class="mdi mdi-database icon-sm mt-1 me-2"></i>Upload the questionaire data</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="card p-md-3 p-2 mb-2">
                    <div>
                        <div class="my-1">
                            <h5 class="card-title">
                                Distribution of UEQ Data
                            </h5>
                        </div>
                        <div class="my-1">
                            <div class="border data-scroll">
                                <table class="table table-bordered text-white table-hovered">
                                    <thead>
                                        <tr>
                                            <th class="text-white" rowspan="2">Item</th>
                                            <th class="text-white" rowspan="2">Mean</th>
                                            <th class="text-white" rowspan="2">Variance</th>
                                            <th class="text-white" rowspan="2">Std. Dev.</th>
                                            <th class="text-white" rowspan="2">N</th>
                                            <th class="text-white" colspan="3">Confidence interval (p=0.05)</th>
                                            <th class="text-white" rowspan="2">Scale</th>
                                            <th rowspan="2"></th>
                                        </tr>
                                        <tr>
                                            <th class="text-white">Confidence</th>
                                            <th class="text-white" colspan="2">Confidence interval</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 0; $i < 26; $i++)
                                            <tr>
                                                <td>{{ $i+1 }}</td>
                                                <td>{{ $show['qData']['meanQuestionaire'][$i] }}</td>
                                                <td>{{ $show['qData']['varQuestionnaire'][$i] }}</td>
                                                <td>{{ $show['qData']['stdQuestionnaire'][$i] }}</td>
                                                <td>{{ $show['data']->count() }}</td>
                                                <td>{{ $show['qData']['confidenceQuestionnaire'][$i] }}</td>
                                                <td>{{ $show['qData']['meanQuestionaire'][$i] - $show['qData']['confidenceQuestionnaire'][$i] }}</td>
                                                <td>{{ $show['qData']['meanQuestionaire'][$i] + $show['qData']['confidenceQuestionnaire'][$i] }}</td>
                                                @if(in_array($i, [0, 11, 13, 15, 23, 24]))
                                                    <td>
                                                        Attractiveness
                                                    </td>
                                                    <td style="background-color: rgb(171, 33, 142)" class="text-white"></td>
                                                @elseif(in_array($i, [1, 3, 12, 20]))
                                                    <td>
                                                        Perspicuity
                                                    </td>
                                                    <td style="background-color: rgb(118, 147, 60)" class="text-white"></td>
                                                @elseif(in_array($i, [8, 19, 21, 22]))
                                                    <td>
                                                        Efficiency
                                                    </td>
                                                    <td style="background-color: rgb(66, 124, 172)" class="text-white"></td>
                                                @elseif(in_array($i, [7, 10, 16, 18]))
                                                    <td>
                                                        Dependability
                                                    </td>
                                                    <td style="background-color: rgb(36, 214, 210)" class="text-white"></td>
                                                @elseif(in_array($i, [4, 5, 6, 17]))
                                                    <td>
                                                        Stimulation
                                                    </td>
                                                    <td style="background-color: rgb(193, 70, 70)" class="text-white"></td>
                                                @elseif(in_array($i, [2, 9, 14, 25]))
                                                    <td>
                                                        Novelty
                                                    </td>
                                                    <td style="background-color: rgb(224, 157, 0)" class="text-white"></td>
                                                @endif
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card p-md-3 p-2 mb-2">
                    <div class="mb-3">
                        <div class="my-1">
                            <h5 class="card-title">
                                UEQ Scales
                            </h5>
                        </div>
                        <div class="my-1">
                            <div class="border data-scroll">
                                <table class="table table-bordered text-white table-hovered">
                                    <thead>
                                        <tr>
                                            <th class="text-white" rowspan="2">Item</th>
                                            <th class="text-white" rowspan="2">Mean</th>
                                            <th class="text-white" rowspan="2">Variance</th>
                                            <th class="text-white" rowspan="2">Std. Dev.</th>
                                            <th class="text-white" rowspan="2">N</th>
                                            <th class="text-white" colspan="3">Confidence interval (p=0.05)</th>
                                        </tr>
                                        <tr>
                                            <th class="text-white">Confidence</th>
                                            <th class="text-white" colspan="2">Confidence interval</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 0; $i < 6; $i++)
                                            <tr>
                                                <th>{{ $show['ueqScales']['type'][$i] }}</th>
                                                <td>{{ $show['ueqScales']['meanQuestionaire'][$i] }}</td>
                                                <td>{{ $show['ueqScales']['varQuestionnaire'][$i] }}</td>
                                                <td>{{ $show['ueqScales']['stdQuestionnaire'][$i] }}</td>
                                                <td>{{ $show['data']->count() }}</td>
                                                <td>{{ $show['ueqScales']['confidenceQuestionnaire'][$i] }}</td>
                                                <td>{{ $show['ueqScales']['meanQuestionaire'][$i] - $show['ueqScales']['confidenceQuestionnaire'][$i] }}</td>
                                                <td>{{ $show['ueqScales']['meanQuestionaire'][$i] + $show['ueqScales']['confidenceQuestionnaire'][$i] }}</td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="mt-1 mb-3">
                        <h6 class="card-title">UEQ Scale Graphic</h6>
                        <canvas class="d-md-block d-none border border-white border-2 px-md-3 py-md-4 rounded" id="scaleMD" width="400" height="150"></canvas>
                        <canvas class="d-md-none border border-white border-2 px-2 py-4 rounded" id="scale" width="400" height="300"></canvas>
                    </div>
                </div>
                <div class="card p-md-3 p-2 mb-2">
                    <div>
                        <div class="my-1">
                            <h5 class="card-title">
                                Pragmatic and Hedonic Quality
                            </h5>
                        </div>
                        <div class="my-1">
                            <div class="row">
                                <div class="col-md-7 col-12 mb-3">
                                    <div class="border">
                                        <table class="table table-bordered text-white table-hovered">
                                            <thead>
                                                <tr>
                                                    <th colspan="2" class="text-white">Pragmatic and Hedonic Quality</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($i = 0; $i < 3; $i++)
                                                    <tr>
                                                        <th>{{ $show['phq']['type'][$i] }}</th>
                                                        <td>{{ number_format($show['phq']['value'][$i], 3, '.', '') }}</td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-5 col-12 mb-3">
                                    <canvas class="d-md-block d-none  border border-white border-2 px-md-3 py-md-4 rounded" id="phqMD" width="400" height="250"></canvas>
                                    <canvas class="d-md-none d-block  border border-white border-2 px-2 py-4 rounded" id="phq" width="400" height="350"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card p-md-3 p-2 mb-2">
                    <div>
                        <div class="my-1">
                            <h5 class="card-title">
                                Benchmark
                            </h5>
                        </div>
                        <div class="my-1">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="border data-scroll">
                                        <table class="table table-bordered text-white table-hovered w-100">
                                            <thead>
                                                <tr>
                                                    <th>Scale</th>
                                                    <th>Mean</th>
                                                    <th>Comparisson to benchmark</th>
                                                    <th>Interpretation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($i = 0; $i < 6; $i++)
                                                    <tr>
                                                        <td>{{ $show['benchmark']['type'][$i] }}</td>
                                                        <td>{{ $show['benchmark']['mean'][$i] }}</td>
                                                        <td>{{ $show['benchmark']['comparisson'][$i] }}</td>
                                                        <td>{{ $show['benchmark']['interpretation'][$i] }}</td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <h6 class="card-title">
                                        Benchmark Graphic
                                    </h6>
                                    <canvas class="d-md-block d-none  border border-white border-2 px-md-3 py-md-4 rounded" id="benchmarkMD" width="400" height="180"></canvas>
                                    <canvas class="d-md-none d-block  border border-white border-2 px-2 py-4 rounded" id="benchmark" width="400" height="350"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection

@section('script')
    @if($findData)
        <script>
            const datasetsScale = [{
                label: "Mean Data",
                backgroundColor: ["rgb(171, 33, 142)","rgb(118, 147, 60)","rgb(66, 124, 172)","rgb(36, 214, 210)","rgb(193, 70, 70)","rgb(224, 157, 0)"],
                maxBarThickness: 50,
                data: [
                    "{{ $show['ueqScales']['meanQuestionaire'][0] }}",
                    "{{ $show['ueqScales']['meanQuestionaire'][1] }}",
                    "{{ $show['ueqScales']['meanQuestionaire'][2] }}",
                    "{{ $show['ueqScales']['meanQuestionaire'][3] }}",
                    "{{ $show['ueqScales']['meanQuestionaire'][4] }}",
                    "{{ $show['ueqScales']['meanQuestionaire'][5] }}",
                ],
            }];
            const optionsScale = {
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                min: -3,
                                max:3,
                            },
                        }
                    ],
                },
                legend: {display: false},
            };
            new Chart('scale',{
                type: 'bar',
                data: {
                    labels: ['A', 'P', 'E', 'D', 'S', 'N'],
                    datasets: datasetsScale
                },
                options: optionsScale
            });
            new Chart('scaleMD',{
                type: 'bar',
                data: {
                    labels: ['Attractiveness', 'Perspicuity', 'Efficiency', 'Dependability', 'Stimulation', 'Novelty'],
                    datasets: datasetsScale
                },
                options: optionsScale
            });
        </script>
        <script>
            const datasetsPHQ = [{
                label: "Mean Data",
                backgroundColor: ["red", "yellow", "green"],
                maxBarThickness: 50,
                data: [
                    "{{ $show['phq']['value'][0] }}",
                    "{{ $show['phq']['value'][1] }}",
                    "{{ $show['phq']['value'][2] }}"
                ],
            }];
            const optionsPHQ = {
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                min: -3,
                                max:3,
                            },
                        }
                    ],
                },
                legend: {display: false},
            };
            new Chart('phq',{
                type: 'bar',
                data: {
                    labels: ['Att', 'PQ', 'HQ'],
                    datasets: datasetsPHQ
                },
                options: optionsPHQ
            });
            new Chart('phqMD',{
                type: 'bar',
                data: {
                    labels: ['Attractiveness', 'Pragmatic Quality', 'Hedonic Quality'],
                    datasets: datasetsPHQ
                },
                options: optionsPHQ
            });
        </script>
        <script>
            const datasetsBenchmark = [
                {
                    label: 'Bad',
                    type: 'bar',
                    maxBarThickness: 50,
                    data: [
                        [-1,0.69],
                        [-1,0.72],
                        [-1,0.6],
                        [-1,0.78],
                        [-1,0.5],
                        [-1,0.16],
                    ],
                    backgroundColor: 'rgb(217, 48, 29)',
                    order: 2,
                },
                {
                    label: 'Below Average',
                    type: 'bar',
                    maxBarThickness: 50,
                    data: [
                        [0.69, 1.18],
                        [0.72, 1.2],
                        [0.6, 1.05],
                        [0.78, 1.14],
                        [0.5, 1],
                        [0.16, 0.7],
                    ],
                    backgroundColor: 'rgb(254, 162, 52)',
                    order: 2,
                },
                {
                    label: 'Above Average',
                    type: 'bar',
                    maxBarThickness: 50,
                    data: [
                        0.4,
                        0.53,
                        0.45,
                        0.34,
                        0.35,
                        0.42
                    ],
                    backgroundColor: 'rgb(210, 246, 138)',
                    order: 2,
                },
                {
                    label: 'Good',
                    type: 'bar',
                    maxBarThickness: 50,
                    data: [
                        0.26,
                        0.27,
                        0.38,
                        0.22,
                        0.35,
                        0.48,

                    ],
                    backgroundColor: 'rgb(114, 179, 47)',
                    order: 2,
                },
                {
                    label: 'Excellent',
                    type: 'bar',
                    maxBarThickness: 50,
                    data: [
                        0.66,
                        0.5,
                        0.62,
                        0.8,
                        0.8,
                        0.9,
                    ],
                    backgroundColor: 'rgb(75, 136, 29)',
                    order: 2,
                },
                {
                    label: 'Mean Value',
                    type: 'line',
                    borderColor: 'white',
                    backgroundColor: '#191c24',
                    borderWidth: 2,
                    pointRadius: 10,
                    data: [
                        "{{ $show['benchmark']['mean'][0] }}",
                        "{{ $show['benchmark']['mean'][1] }}",
                        "{{ $show['benchmark']['mean'][2] }}",
                        "{{ $show['benchmark']['mean'][3] }}",
                        "{{ $show['benchmark']['mean'][4] }}",
                        "{{ $show['benchmark']['mean'][5] }}",
                    ],
                },
            ];
            const optionsBenchmark = {
                scales: {
                    yAxes: [{
                        stacked: true,
                        ticks: {
                            beginAtZero: false,
                            min: -1,
                            max: 2.5,
                        },
                    }],
                    xAxes: [{
                        stacked: true
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                    filter: function (tooltipItem, chartData) {
                        if (tooltipItem.datasetIndex >= 0) {
                            const datasetType = chartData.datasets[tooltipItem.datasetIndex].type;
                            return datasetType !== 'bar';
                        }
                        return true;
                    }
                }
            };

            new Chart('benchmark',{
                type: 'bar',
                data: {
                    labels: ['A', 'P', 'E', 'D', 'S', 'N'],
                    datasets: datasetsBenchmark
                },
                options: optionsBenchmark
            });
            new Chart('benchmarkMD',{
                type: 'bar',
                data: {
                    labels: ['Attractiveness', 'Perspicuity', 'Efficiency', 'Dependability', 'Stimulation', 'Novelty'],
                    datasets: datasetsBenchmark
                },
                options: optionsBenchmark
            });
        </script>
    @endif
@endsection
