@extends('pages.template.theme')
@section('title', 'SUS')
@section('content')
    <div class="d-md-flex align-items-center justify-content-between">
        <div class="mt-2">Questionnaire Data</div>
        <div class="mt-2">
            @if(!$ticket)<a onclick="openModal()" href="#" class="btn btn-primary me-2 border"><i class="mdi mdi-database-plus me-2"></i>Import Data</a>@endif
            @if($ticket)<a onclick="deleteData()" href="#" class="btn btn-danger me-2 border"><i class="mdi mdi-delete-forever me-2"></i>Delete Data</a>@endif
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-12">
            <div class="card p-md-3 p-2">
                @if($ticket)
                    <div class="d-md-flex align-items-center justify-content-between">
                        <div class="my-1">
                            <button class="btn btn-info d-flex align-items-center justify-content-center"><i class="mdi mdi mdi-file-pdf icon-sm mt-1 me-2"></i>Ekspor Data</button>
                        </div>
                    </div>
                    <div class="d-md-flex mt-2">
                        <div class="col-lg-2 col-md-4 my-1">
                            <div class="card border mx-1 p-2">
                                SUS Score
                                <h2 class="mt-2">{{ $sus_data['sus_score'] }}</h2>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-8 my-1">
                            <div class="card border mx-1 p-2">
                                Acceptability Ranges
                                <h2 class="mt-2">{{ $sus_data['acceptability'] }}</h2>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 my-1">
                            <div class="card border mx-1 p-2">
                                Grade Scale
                                <h2 class="mt-2">{{ $sus_data['grade_scale'] }}</h2>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-8 my-1">
                            <div class="card border mx-1 p-2">
                                Adjective Ratings
                                <h2 class="mt-2">{{ $sus_data['adjective'] }}</h2>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="mt-3 text-white table-responsive">
                    <table class="text-white table table-bordered table-hovered border" id="datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Q1 | SUS Q1</th>
                                <th>Q2 | SUS Q2</th>
                                <th>Q3 | SUS Q3</th>
                                <th>Q4 | SUS Q4</th>
                                <th>Q5 | SUS Q5</th>
                                <th>Q6 | SUS Q6</th>
                                <th>Q7 | SUS Q7</th>
                                <th>Q8 | SUS Q8</th>
                                <th>Q9 | SUS Q9</th>
                                <th>Q10 | SUS Q10</th>
                                <th>Amount</th>
                                <th>Value (Amount * 2.5)</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="importExcel" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Import Questionnaire Data</h5>
                    <button type="button" class="text-white mb-1 mt-0 border-0" style="background: transparent" data-bs-dismiss="modal"><i class="mdi mdi-window-close m-0 p-0"></i></button>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-12 mb-2">
                                @if ($get_sus && $get_sus->status == 'Active')
                                    @if ($get_sus->document)
                                        <a class="text-success" target="__blank" href="{{ asset('storage'.$get_sus->document) }}" download="" style="text-decoration: none">
                                            <div class="border border rounded p-3 mb-3 bg-white shadow text-center">
                                                <strong><i class="mdi mdi-file-excel me-2 text-success"></i> Excel Template Download</strong>
                                            </div>
                                        </a>
                                    @else
                                        <a class="text-danger" style="text-decoration: none">
                                            <div class="border border rounded p-3 mb-3 bg-white shadow text-center">
                                                <strong>Template Not Found</strong>
                                            </div>
                                        </a>
                                    @endif
                                @endif
                                <label class="form-label">Excel File *</label>
                                <br />
                                <label for="file" class="w-100">
                                    <div class="border px-2 py-5 text-center w-100 rounded" style="cursor: pointer">
                                        <i class="fas fa-cloud-arrow-up"></i><br />
                                        <span id="text-excel">Upload your excel file here</span>
                                    </div>
                                </label>
                                <input required type="file" class="form-control mt-2 text-white" id="file" name="excel_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                <small class="fst-italic text-danger" id="file-error"></small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button  id="saveDataExcel" type="submit" name="excel" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.sus.data.json') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'sus1' },
                { data: 'sus2' },
                { data: 'sus3' },
                { data: 'sus4' },
                { data: 'sus5' },
                { data: 'sus6' },
                { data: 'sus7' },
                { data: 'sus8' },
                { data: 'sus9' },
                { data: 'sus10' },
                { data: 'total' },
                { data: 'nilai' },
            ],
        });
        function openModal(){
            $('#loading-save').addClass('d-none')
            $('#importExcel').modal('show')
        }
        function deleteData(){
            Swal.fire({
                text: "Are you sure for delete this data ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href="{{ route('user.sus.data.delete') }}";
                }
            })
        }
    </script>
@endsection
