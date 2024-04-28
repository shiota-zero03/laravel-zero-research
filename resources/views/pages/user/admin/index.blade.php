@extends('pages.template.theme')
@section('title', 'Admin Data')
@section('content')

    <div class="row mb-3">
        <div class="col-12">Admin Data</div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card p-md-3 p-2">
                <div class="d-md-flex align-items-center justify-content-between">
                    <div class="my-1">
                        <button onclick="openModal(0)" class="btn btn-primary d-flex align-items-center justify-content-center"><i class="mdi mdi-account-multiple-plus icon-sm mt-1 me-2"></i>Add Admin Data</button>
                    </div>
                    <div class="my-1 d-none">
                        <button class="btn btn-danger d-flex align-items-center justify-content-center"><i class="mdi mdi mdi-file-excel icon-sm mt-1 me-2"></i>Ekspor Data</button>
                    </div>
                </div>
                <div class="mt-3">
                    <table class="text-white table table-bordered table-hovered" id="datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Profile Picture</th>
                                <th>Nama</th>
                                <th>User Code</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="userModal" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Admin Data Form</h5>
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
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control text-white" id="name">
                                    <small class="fst-italic text-danger" id="name_error"></small>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control text-white" id="email">
                                    <small class="fst-italic text-danger" id="email_error"></small>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control text-white" id="username">
                                    <small class="fst-italic text-danger" id="username_error"></small>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control text-white" id="password">
                                    <small class="fst-italic text-danger" id="password_error"></small>
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
            ajax: "{{ route('admin.user.index', 'admin-data') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'profile', name: 'profile' },
                { data: 'name', name: 'name' },
                { data: 'user_code', name: 'user_code' },
                { data: 'email', name: 'email' },
                { data: 'username', name: 'username' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action' },
            ]

        })

        function emptyError(){
            $('#name_error').html('')
            $('#email_error').html('')
            $('#username_error').html('')
            $('#password_error').html('')
        }

        function openModal(id){
            emptyError()
            $('#loading-save').addClass('d-none')

            let action = $('input[id=action-name]');
            let method = $('input[id=method-name]');
            let name = $('input[id=name]');
            let email = $('input[id=email]');
            let password = $('input[id=password]');
            let username = $('input[id=username]');

            if(id === 0){
                $.ajax({
                    url: "{{ route('admin.user.create', 'admin-data') }}",
                    method: "GET",
                    success: function(res){
                        action.val(res.data.action);
                        method.val(res.data.method);
                        name.val('');
                        email.val('');
                        username.val('');
                        password.val('');
                        $('#userModal').modal('show');
                    },
                    error: function(err){
                        console.error(err)
                    }
                })
            } else {
                $.ajax({
                    url: "/administrator/user/admin-data/"+id+"/edit",
                    method: "GET",
                    success: function(res){
                        action.val(res.data.action);
                        method.val(res.data.method);
                        name.val(res.data.name);
                        email.val(res.data.email);
                        username.val(res.data.username);
                        $('#userModal').modal('show');
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
            let name = $('input[id=name]').val();
            let email = $('input[id=email]').val();
            let username = $('input[id=username]').val();
            let password = $('input[id=password]').val();

            const formData = new FormData();
            formData.append('_method', meth);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('name', name);
            formData.append('email', email);
            formData.append('username', username);
            formData.append('password', password);

            $.ajax({
                url: action,
                method: 'POST',
                data: formData,
                contentType: false,
                processData:false,
                success: function(res){
                    console.log(res)
                    $('#loading-save').addClass('d-none')
                    Swal.fire({
                        text: res.message,
                        icon: 'success'
                    }).then(() => {
                        $('#userModal').modal('hide');
                        db_table.ajax.reload()
                    })
                },
                error: function(err){
                    console.log(err)
                    if(err.status === 422){
                        const errorData = err.responseJSON.errors;
                        errorData.name ? $('#name_error').html(errorData.name[0]) : $('#name_error').html('')
                        errorData.email ? $('#email_error').html(errorData.email[0]) : $('#email_error').html('')
                        errorData.username ? $('#username_error').html(errorData.username[0]) : $('#username_error').html('')
                        errorData.password ? $('#password_error').html(errorData.password[0]) : $('#password_error').html('')
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
                text: "Are you sure to delete this admin ?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/administrator/user/admin-data/"+id,
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
