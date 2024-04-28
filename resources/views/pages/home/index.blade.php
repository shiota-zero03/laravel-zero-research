@extends('pages.template.theme')
@section('title', 'Home')
@section('content')
    @php
        $set = \App\Models\Setting::get()->first();
    @endphp

    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="container py-2 py-md-4">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="card bg-dark border border-dark p-3">
                                <h4 class="text-center mb-0">Application for calculating quantitative research data</h4>
                            </div>
                        </div>
                        <div class="col-md-9 mb-md-4 mb-4">
                            <div class="card bg-dark border border-dark" style="height: 100%">
                                <div class="d-flex align-items-center row" style="height: 100%">
                                    <div class="col-lg-7 col-md-8">
                                        <div class="card-body" style="text-align: justify">
                                            <h4 class="card-title text-primary">Welcome {{ auth()->user()->name }}! 🎉</h4>
                                            <p class="mb-4">
                                                This website is a quantitative data processor as a tool to help carry out research
                                            </p>
                                            @if(auth()->user()->role == 3)
                                                <p class="mb-4">
                                                    The research data you enter will not be able to be seen by other people and if you delete the research data, the data will be permanently deleted from the database.
                                                </p>
                                            @endif
                                            <a href="{{ auth()->user()->role == 3 ? route('user.profile.index') : route('admin.profile.index')  }}" class="btn btn-sm btn-outline-primary">View Profiles</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-4 text-center text-sm-left">
                                        <div class="card-body pb-0 px-0 px-lg-4">
                                            <img
                                                src="{{ asset('') }}assets/images/illustrations/man-with-laptop-light.png"
                                                width="80%"
                                                alt="View Badge User"
                                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                                data-app-light-img="illustrations/man-with-laptop-light.png"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-md-4 mb-4">
                            <div class="card bg-dark border border-dark" style="height: 100%">
                                <div class="d-flex align-items-center justify-content-center" style="height: 100%">
                                    <div class="col-12">
                                        <div class="card-body text-center">
                                            <img src="{{ asset('storage'.$set->shortcut) }}" alt="" width="100%"><br /><br />
                                            <strong>{{ $set->app_name }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(auth()->user()->role != 3)
                            <div class="col-md-4">
                                <div class="card bg-dark border border-dark py-1">
                                    <div class="d-flex align-items-center justify-content-between w-100 px-md-4 px-3 ">
                                        <div class="text-start">
                                            <h4 class="my-0">User Total</h4>
                                            <h2 class="my-0">{{ \App\Models\User::where('role', 3)->get()->count() }}</h2>
                                        </div>
                                        <div>
                                            <i class="mdi mdi-account icon-lg my-0"></i>
                                        </div>
                                    </div>
                                    <a href="{{ route('admin.user.index', 'user-data') }}" class="d-flex align-items-center justify-content-center pt-1 w-100 text-decoration-none text-center px-2 text-white" style="border-top: 1px solid black">See all <i class="ms-2 mdi mdi-arrow-right-bold-circle-outline"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-dark border border-dark py-1">
                                    <div class="d-flex align-items-center justify-content-between w-100 px-md-4 px-3 ">
                                        <div class="text-start">
                                            <h4 class="my-0">Admin Total</h4>
                                            <h2 class="my-0">{{ \App\Models\User::where('role', 2)->get()->count() }}</h2>
                                        </div>
                                        <div>
                                            <i class="mdi mdi-account-key icon-lg my-0"></i>
                                        </div>
                                    </div>
                                    <a href="{{ route('admin.user.index', 'admin-data') }}" class="d-flex align-items-center justify-content-center pt-1 w-100 text-decoration-none text-center px-2 text-white" style="border-top: 1px solid black">See all <i class="ms-2 mdi mdi-arrow-right-bold-circle-outline"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-dark border border-dark py-1">
                                    <div class="d-flex align-items-center justify-content-between w-100 px-md-4 px-3 ">
                                        <div class="text-start">
                                            <h4 class="my-0">Menu Access</h4>
                                            <h2 class="my-0">{{ \App\Models\MenuAccess::all()->count() }}</h2>
                                        </div>
                                        <div>
                                            <i class="mdi mdi-access-point icon-lg my-0"></i>
                                        </div>
                                    </div>
                                    <a href="{{ route('admin.menu-access.menu-access.index') }}" class="d-flex align-items-center justify-content-center pt-1 w-100 text-decoration-none text-center px-2 text-white" style="border-top: 1px solid black">See all <i class="ms-2 mdi mdi-arrow-right-bold-circle-outline"></i></a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')

@endsection
