@extends('pages.template.theme')
@section('title', 'Validity and Reliability Result')
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
        <div class="col-12">Validity and Reliability Result</div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            @if(!$data)
                <div class="card p-md-3 p-2 mb-2">
                    <div>
                        <div class="my-1 text-center">
                            <span><em>There is no Validity and Reliability Data Found</em></span><br /><br />
                            <a href="{{ route('user.validandreliable.data.index') }}" class="btn btn-success d-flex align-items-center justify-content-center"><i class="mdi mdi-database icon-sm mt-1 me-2"></i>Upload the questionaire data</a>
                        </div>
                    </div>
                </div>
            @else
                @include('pages.research.validity-reliability.data-validation')
                <hr>
                @include('pages.research.validity-reliability.data-reliable')
            @endif
        </div>
    </div>
@endsection
