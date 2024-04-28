@extends('pages.template.theme')
@section('title', 'Validity and Reliability')
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
                                <th>No</th>
                                @if($item_data->count() > 0)
                                    @for ($i = 0; $i < $item_data->count(); $i++)
                                        <th>Q{{ $i+1 }}</th>
                                    @endfor
                                @else
                                    <th colspan="6">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span>No Questionnaire Item Found</span>
                                            <a href="{{ route('user.validity-and-reliability-item.index') }}" class="btn btn-success py-1">Insert Item</a>
                                        </div>
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if($item_data->count() > 0)
                                @foreach ($dataByItem[0] as $index => $item)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        @foreach ($item_data as $item_index => $data)
                                            <th>{{ $dataByItem[$item_index][$index]->value }}</th>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @else
                                <tr class="text-center">
                                    <td colspan="7">No data available in table</td>
                                </tr>
                            @endif
                        </tbody>
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
                                @if ($get_validity && $get_validity->status == 'Active')
                                    @if ($get_validity->document)
                                        <a class="text-success" target="__blank" href="{{ asset('storage'.$get_validity->document) }}" download="" style="text-decoration: none">
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
        $('#datatable').DataTable();
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
                    document.location.href="{{ route('user.validandreliable.data.delete') }}";
                }
            })
        }
    </script>
@endsection
