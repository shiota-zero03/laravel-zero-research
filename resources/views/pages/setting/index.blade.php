@extends('pages.template.theme')
@section('title', 'Setting')
@section('content')

    <div class="row">
        <div class="col-12">Setting</div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="container py-2 py-md-4">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex align-items-center justify-content-center flex-wrap">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="app_name">APP Name</label>
                                    <input type="text" value="{{ $data->app_name }}" class="form-control text-white" name="app_name">
                                    @error('app_name')<small><em class="text-danger">{{ $message }}</em></small>@enderror
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mb-3">
                                <div class="form-group mx-md-2 border border-white p-2 rounded">
                                    <label for="maks_logo">Maksimize Logo</label><br />
                                    <img src="@if($data->maks_logo) {{ asset('storage'.$data->maks_logo) }} @else {{ asset('assets/images/logo.svg') }} @endif" alt="" height="50px" style="max-width: 100%; width: auto" class="rounded" id="profile_show">
                                    <input id="maks_logo" type="file" accept=".png, .jpeg, .jpg" class="form-control text-white mt-2" name="maks_logo">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mb-3">
                                <div class="form-group mx-md-2 border border-white p-2 rounded">
                                    <label for="min_logo">Minimize Logo</label><br />
                                    <img src="@if($data->min_logo) {{ asset('storage'.$data->min_logo) }} @else {{ asset('assets/images/logo-mini.svg') }} @endif" alt="" height="50px" class="rounded" id="profile_show">
                                    <input id="min_logo" type="file" accept=".png, .jpeg, .jpg" class="form-control text-white mt-2" name="min_logo">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mb-3">
                                <div class="form-group mx-md-2 border border-white p-2 rounded">
                                    <label for="shortcut">Shortcut Icon</label><br />
                                    <img src="@if($data->shortcut) {{ asset('storage'.$data->shortcut) }} @else {{ asset('assets/images/favicon.png') }} @endif" alt="" height="50px" class="rounded" id="profile_show">
                                    <input id="shortcut" type="file" accept=".png, .jpeg, .jpg" class="form-control text-white mt-2" name="shortcut">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100">Save Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

@endsection
