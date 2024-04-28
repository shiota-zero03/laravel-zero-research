@extends('pages.template.theme')
@section('title', 'Validity and Reliability')
@section('content')

    <div class="row mb-3">
        <div class="col-12">Insert Item</div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card p-md-3 p-2">
                <div class="d-md-flex align-items-center justify-content-between">
                    <div class="my-1">
                        <a onclick="openModal(0)" href="#" class="btn btn-primary me-2 border"><i class="mdi mdi-database-plus me-2"></i>Add Item</a>
                    </div>
                </div>

                <div class="mt-3">
                    <table class="text-white table table-bordered table-hovered border" id="datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Item Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="itemModal" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Item List</h5>
                    <button type="button" class="text-white mb-1 mt-0 border-0" style="background: transparent" data-bs-dismiss="modal"><i class="mdi mdi-window-close m-0 p-0"></i></button>
                </div>
                <div>
                    @csrf
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-12 mb-2">
                                <input type="hidden" class="form-control text-white" id="action-name">
                                <input type="hidden" class="form-control text-white" id="method-name">
                                <div class="form-group">
                                    <label for="item-name">Item Name *</label>
                                    <input type="text" class="form-control text-white" id="item-name">
                                    <small class="fst-italic text-danger" id="item-name-error"></small>
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
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        var db_table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.validity-and-reliability-item.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'item_name', name: 'item_name' },
                { data: 'action', name: 'action' },
            ]
        })

        function emptyError(){
            $('#item-name-error').html('')
        }

        function openModal(id){
            emptyError()
            $('#loading-save').addClass('d-none')

            let action = $('input[id=action-name]');
            let method = $('input[id=method-name]');
            let item = $('input[id=item-name]');

            if(id === 0){
                $.ajax({
                    url: "{{ route('user.validity-and-reliability-item.create') }}",
                    method: "GET",
                    success: function(res){
                        action.val(res.data.action);
                        method.val(res.data.method);
                        item.val('');
                        $('#itemModal').modal('show');
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
                        item.val(res.data.item_name);
                        document.val('');
                        $('#text-template').html(res.data.document)
                        status.val(res.data.status)
                        $('#itemModal').modal('show');
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
            let item = $('input[id=item-name]').val();

            const formData = new FormData();
            formData.append('_method', meth);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('item_name', item);

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
                        $('#itemModal').modal('hide');
                        db_table.ajax.reload()
                    })
                },
                error: function(err){
                    if(err.status === 422){
                        const errorData = err.responseJSON.errors;
                        errorData.item_name ? $('#item-name-error').html(errorData.item_name[0]) : $('#item-name-error').html('')
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
                        url: "/user/validity-and-reliability-item/"+id,
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
