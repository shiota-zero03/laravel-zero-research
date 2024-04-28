@extends('pages.template.theme')
@section('title', 'SUS Documentation')
@section('content')

    <div class="row">
        <div class="col-12">SUS Documentation</div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="container py-2 py-md-4">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="panel panel-default px-md-3">
                                <div class="panel-heading text-center alert alert-success">
                                    <i class="mdi mdi-library-books me-2"></i> PROCEDURE FOR USING THE SUS SYSTEM
                                </div>
                                <div class="panel-body card alert">
                                    <ul class="timeline">
                                        <li>
                                            <div class="timeline-badge primary"><i class="mdi mdi-cloud-upload"></i></div>
                                            <div class="timeline-panel ">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Import SUS Data</h4>
                                                </div>
                                                <div class="timeline-body">
                                                    <ol>
                                                        <li>Start</li>
                                                        <li>Prepare the data to be entered into the sus table</li>
                                                        <li>Import data on the Questionnaire Data page (excel file must be adapted to the template provided)</li>
                                                        <li>Finish</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge primary"><i class="mdi mdi-cloud-upload"></i></div>
                                            <div class="timeline-panel ">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">See the Result</h4>
                                                </div>
                                                <div class="timeline-body">
                                                    <ol>
                                                        <li>You can see the result in questionnaire data page</li>
                                                        <li>To find out how to calculate SUS score, you can go to the following page</li>
                                                        <li><a href="https://www.edisusilo.com/cara-menggunakan-system-usability-scale/" target="__blank" class="btn btn-primary my-1">Click here to switch pages</a></li>
                                                        <li>Finish</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="panel-heading text-center alert alert-primary">
                                    <i class="mdi mdi-flag-checkered me-2"></i> THANKS FOR USING OUR SYSTEM
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')



@endsection
