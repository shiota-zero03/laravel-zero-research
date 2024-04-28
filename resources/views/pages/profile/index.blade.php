@extends('pages.template.theme')
@section('title', 'Profile')
@section('content')

    <div class="row">
        <div class="col-12">Profile</div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="container py-2 py-md-4">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <img src="@if(auth()->user()->profile_picture) {{ asset('storage'.auth()->user()->profile_picture) }} @else {{ asset('assets/images/empty.png') }} @endif" alt="" class="w-100 rounded" id="profile_show">
                                <input type="file" accept=".png, .jpeg, .jpg" class="form-control text-white mt-2" name="profile_picture">
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group mb-3">
                                    <label for="user_code">User Code</label>
                                    <input type="text" value="{{ auth()->user()->user_code }}" class="form-control text-dark" id="user_code" disabled readonly>
                                    @error('user_code')<small><em class="text-danger">{{ $message }}</em></small>@enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" value="{{ auth()->user()->name }}" class="form-control text-white" name="name">
                                    @error('name')<small><em class="text-danger">{{ $message }}</em></small>@enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" value="{{ auth()->user()->username }}" class="form-control text-white" name="username">
                                    @error('username')<small><em class="text-danger">{{ $message }}</em></small>@enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" value="{{ auth()->user()->email }}" class="form-control text-white" name="email">
                                    @error('email')<small><em class="text-danger">{{ $message }}</em></small>@enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" value="" class="form-control text-white" name="password">
                                    @error('password')<small><em class="text-danger">{{ $message }}</em></small>@enderror
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary w-100" type="submit">Save Profile</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        $('input[name=profile_picture]').on('change', function(){
            if($(this)[0].files && $(this)[0].files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('img#profile_show').attr('src', e.target.result)
                }
                reader.readAsDataURL($(this)[0].files[0]);
            } else {
                $('img#profile_show').attr('src', "@if(auth()->user()->profile_picture) {{ asset('storage'.auth()->user()->profile_picture) }} @else {{ asset('assets/images/empty.png') }} @endif")
            }
        })
    </script>

@endsection
