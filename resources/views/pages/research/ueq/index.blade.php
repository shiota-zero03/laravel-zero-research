@extends('pages.template.theme')
@section('title', 'UEQ')
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
                        <div class="my-1">
                            <a href="{{ route('user.ueq.result.index') }}" class="btn btn-success d-flex align-items-center justify-content-center"><i class="mdi mdi-calculator icon-sm mt-1 me-2"></i>See Result</a>
                        </div>
                    </div>
                @endif
                <div class="mt-3 text-white">
                    <table class="text-white table table-bordered table-hovered border" id="datatable">
                        <thead>
                            <tr>
                                <th rowspan="2">No</th>
                                <th colspan="26">Items</th>
                                <th colspan="6">Scale means per person</th>
                            </tr>
                            <tr>
                                <th>ATT1</th>
                                <th>PER1</th>
                                <th>NOV1</th>
                                <th>PER2</th>
                                <th>STI1</th>
                                <th>STI2</th>
                                <th>STI3</th>
                                <th>DEP1</th>
                                <th>EFF1</th>
                                <th>NOV2</th>
                                <th>DEP2</th>
                                <th>ATT2</th>
                                <th>PER3</th>
                                <th>ATT3</th>
                                <th>NOV3</th>
                                <th>ATT4</th>
                                <th>DEP3</th>
                                <th>STI3</th>
                                <th>DEP4</th>
                                <th>EFF2</th>
                                <th>PER4</th>
                                <th>EFF3</th>
                                <th>EFF4</th>
                                <th>ATT5</th>
                                <th>ATT6</th>
                                <th>NOV4</th>
                                <th>Attractiveness</th>
                                <th>Perspicuity</th>
                                <th>Efficiency</th>
                                <th>Dependability</th>
                                <th>Stimulation</th>
                                <th>Novelty</th>
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
                                @if ($get_ueq && $get_ueq->status == 'Active')
                                    @if ($get_ueq->document)
                                        <a class="text-success" target="__blank" href="{{ asset('storage'.$get_ueq->document) }}" download="" style="text-decoration: none">
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
            ajax: "{{ route('user.ueq.data.json') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'q1' },
                { data: 'q2' },
                { data: 'q3' },
                { data: 'q4' },
                { data: 'q5' },
                { data: 'q6' },
                { data: 'q7' },
                { data: 'q8' },
                { data: 'q9' },
                { data: 'q10' },
                { data: 'q11' },
                { data: 'q12' },
                { data: 'q13' },
                { data: 'q14' },
                { data: 'q15' },
                { data: 'q16' },
                { data: 'q17' },
                { data: 'q18' },
                { data: 'q19' },
                { data: 'q20' },
                { data: 'q21' },
                { data: 'q22' },
                { data: 'q23' },
                { data: 'q24' },
                { data: 'q25' },
                { data: 'q26' },
                { data: 'att' },
                { data: 'per' },
                { data: 'eff' },
                { data: 'dep' },
                { data: 'sti' },
                { data: 'nov' },
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
                    document.location.href="{{ route('user.ueq.data.delete') }}";
                }
            })
        }
    </script>
@endsection
