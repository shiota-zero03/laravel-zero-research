@extends('pages.template.theme')
@section('title', 'Menu Access')
@section('content')

    <div class="row mb-3">
        <div class="col-12">Menu Access</div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card p-md-3 p-2">

                @if (auth()->user()->role == 1)
                    <div class="d-md-flex align-items-center justify-content-between">
                        <div class="my-1">
                            <a onclick="openModal(0)" href="#" class="btn btn-primary me-2 border"><i class="mdi mdi-database-plus me-2"></i>Add Menu</a>
                        </div>
                    </div>
                @endif

                <div class="mt-3">
                    <table class="text-white table table-bordered table-hovered border" id="datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Menu Name</th>
                                <th>Document Template</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="menuModal" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Menu Access Form</h5>
                    <button type="button" class="text-white mb-1 mt-0 border-0" style="background: transparent" data-bs-dismiss="modal"><i class="mdi mdi-window-close m-0 p-0"></i></button>
                </div>
                <form enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-12 mb-2">
                                <input type="hidden" class="form-control text-white" id="action-name">
                                <input type="hidden" class="form-control text-white" id="method-name">
                                <div class="form-group">
                                    <label for="menu-name">Menu Name *</label>
                                    <input type="text" class="form-control text-white" id="menu-name">
                                    <small class="fst-italic text-danger" id="menu-name-error"></small>
                                </div>
                                <div>
                                    <label class="document_template">Document Template *</label>
                                    <br />
                                    <label for="document_template" class="w-100">
                                        <div class="border px-2 py-5 text-center w-100 rounded" style="cursor: pointer">
                                            <i class="fas fa-cloud-arrow-up"></i><br />
                                            <span id="text-template">Upload your excel file here</span>
                                        </div>
                                    </label>
                                    <input type="file" class="form-control mt-2 text-white" id="document_template" name="excel_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                    <small class="fst-italic text-danger" id="document-template-error"></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="status">Status *</label>
                                    <select name="status" id="status" class="form-control text-white">
                                        <option value="Active">Active</option>
                                        <option value="Nonactive">Nonactive</option>
                                    </select>
                                    <small class="fst-italic text-danger" id="status-error"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="saveData" type="button" name="excel" class="btn btn-primary">Save</button>
                        <div class="spinner-border text-primary ms-2 d-none" role="status" id="loading-save">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        var db_table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.menu-access.menu-access.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'menu_name', name: 'menu_name' },
                { data: 'template', name: 'template' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action' },
            ]
        })

        function emptyError(){
            $('#menu-name-error').html('')
            $('#document-template-error').html('')
            $('#status-error').html('')
        }

        function openModal(id){
            emptyError()
            $('#text-template').html('Upload your excel file here')
            $('#loading-save').addClass('d-none')

            let action = $('input[id=action-name]');
            let method = $('input[id=method-name]');
            let menu = $('input[id=menu-name]');
            let document = $('input[id=document_template]');
            let status = $('select[id=status]');

            if(id === 0){
                $.ajax({
                    url: "{{ route('admin.menu-access.menu-access.create') }}",
                    method: "GET",
                    success: function(res){
                        action.val(res.data.action);
                        method.val(res.data.method);
                        menu.val('');
                        document.val('');
                        status.val('Active')
                        $('#menuModal').modal('show');
                    },
                    error: function(err){
                        console.error(err)
                    }
                })
            } else {
                $.ajax({
                    url: "/administrator/menu-access/"+id+"/edit",
                    method: "GET",
                    success: function(res){
                        action.val(res.data.action);
                        method.val(res.data.method);
                        menu.val(res.data.menu_name);
                        document.val('');
                        $('#text-template').html(res.data.document)
                        status.val(res.data.status)
                        $('#menuModal').modal('show');
                    },
                    error: function(err){
                        console.error(err)
                    }
                })
            }
        }

        $('button[id=saveData]').on('click', function(){
            emptyError();
            $('#loading-save').removeClass('d-none')

            let action = $('input[id=action-name]').val();
            let meth = $('input[id=method-name]').val();
            let menu = $('input[id=menu-name]').val();
            let document = $('input[id=document_template]').prop('files')[0]
            let status = $('select[id=status]').val();

            const formData = new FormData();
            formData.append('_method', meth);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('menu_name', menu);
            formData.append('document_template', document);
            formData.append('status', status);

            $.ajax({
                url: action,
                method: 'POST',
                data: formData,
                contentType: false,
                processData:false,
                success: function(res){
                    $('#loading-save').addClass('d-none')
                    Swal.fire({
                        text: res.message,
                        icon: 'success'
                    }).then(() => {
                        $('#menuModal').modal('hide');
                        db_table.ajax.reload()
                    })
                },
                error: function(err){
                    if(err.status === 422){
                        const errorData = err.responseJSON.errors;
                        errorData.menu_name ? $('#menu-name-error').html(errorData.menu_name[0]) : $('#menu-name-error').html('')
                        errorData.document_template ? $('#document-template-error').html(errorData.document_template[0]) : $('#document-template-error').html('')
                        errorData.status ? $('#status-error').html(errorData.status[0]) : $('#status-error').html('')
                    } else {
                        Swal.fire({
                            text: err.responseJSON.message,
                            icon: 'error'
                        })
                    }
                    $('#loading-save').addClass('d-none')
                }
            })
        })

        $('input[id=document_template]').on('change', function(){
            if ($(this)[0].files && $(this)[0].files[0]) {
                $('#text-template').html($(this)[0].files[0]['name'])
            } else {
                $('#text-template').html('Upload your excel file here')
            }
        })

        function deleteData(id){
            Swal.fire({
                text: "Are you sure to delete this menu ?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/administrator/menu-access/"+id,
                        method: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function(res) {
                            Swal.fire({
                                text: res.message,
                                icon: 'success'
                            }).then(() => {
                                db_table.ajax.reload()
                            })
                        },
                        error: function(err) {
                            Swal.fire({
                                text: err.responseJSON.message,
                                icon: 'error'
                            })
                        }
                    })
                }
            });
        }
    </script>

@endsection
