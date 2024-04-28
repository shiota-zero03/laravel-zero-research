@php
    auth()->user()->role == 3 ? $role = 'user' : $role = 'admin';
    $sus = \App\Models\MenuAccess::where('menu_name','SUS')->first();
    $ueq = \App\Models\MenuAccess::where('menu_name','UEQ')->first();
    $nb = \App\Models\MenuAccess::where('menu_name','NAIVE BAYES')->first();
    $ques = \App\Models\MenuAccess::where('menu_name','VALIDITY AND RELIABILITY')->first();
@endphp
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="index.html"><img src="{{ $set->maks_logo ? asset('storage'.$set->maks_logo) : asset('assets/images/logo.svg') }}" alt="logo" style="width: auto; max-width: 100%" /></a>
        <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="{{ $set->min_logo ? asset('storage'.$set->min_logo) : asset('assets/images/logo-mini.svg') }}" alt="logo" style="width: auto" /></a>
    </div>
    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                        <img class="img-xs rounded-circle " src="{{ auth()->user()->profile_picture ? asset('storage'.auth()->user()->profile_picture) : asset('assets/images/faces/face15.jpg') }}" alt="">
                        <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal">{{ auth()->user()->name }}</h5>
                        <span>{{ auth()->user()->user_code }}</span>
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
        </li>
        <li class="nav-item menu-items" id="home-menu">
            <a class="nav-link" href="{{ route($role.'.home') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-home"></i>
                </span>
                <span class="menu-title">Home</span>
            </a>
        </li>
        @if ($role == 'admin')
            <li class="nav-item menu-items" id="users-menu">
                <a class="nav-link" data-bs-toggle="collapse" href="#user" aria-expanded="false" aria-controls="user">
                    <span class="menu-icon">
                        <i class="mdi mdi-account"></i>
                    </span>
                    <span class="menu-title">User</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="user">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('admin.user.index', 'admin-data') }}">Admin</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('admin.user.index', 'user-data') }}">User</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ route('admin.menu-access.menu-access.index') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-access-point"></i>
                    </span>
                    <span class="menu-title">Menu Access</span>
                </a>
            </li>
        @endif

        @if ($role == 'user')
            @if ($sus && $sus->status == 'Active')
                <li class="nav-item menu-items">
                    <a class="nav-link" data-bs-toggle="collapse" href="#sus-menu" aria-expanded="false" aria-controls="sus-menu">
                        <span class="menu-icon">
                            <i class="mdi mdi-playlist-play"></i>
                        </span>
                        <span class="menu-title">SUS Menu</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="sus-menu">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('user.sus.data.index') }}">Questionnaire Data</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('user.sus.documentation.index') }}">Documentation</a></li>
                        </ul>
                    </div>
                </li>
            @endif

            @if ($ueq && $ueq->status == 'Active')
                <li class="nav-item menu-items">
                    <a class="nav-link" data-bs-toggle="collapse" href="#ueq-menu" aria-expanded="false" aria-controls="ueq-menu">
                        <span class="menu-icon">
                            <i class="mdi mdi-playlist-play"></i>
                        </span>
                        <span class="menu-title">UEQ Menu</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ueq-menu">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('user.ueq.data.index') }}">Questionnaire Data</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('user.ueq.result.index') }}">UEQ Result</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('user.ueq.documentation.index') }}">Documentation</a></li>
                        </ul>
                    </div>
                </li>
            @endif

            @if ($nb && $nb->status == 'Active')
                <li class="nav-item menu-items">
                    <a class="nav-link" data-bs-toggle="collapse" href="#naive-bayes-menu" aria-expanded="false" aria-controls="naive-bayes-menu">
                        <span class="menu-icon">
                            <i class="mdi mdi-playlist-play"></i>
                        </span>
                        <span class="menu-title">Naive Bayes Menu</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="naive-bayes-menu">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Training Data</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Testing Data</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Probability</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Classification Result</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Perform</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('user.naive-bayes.documentation.index') }}">Documentation</a></li>
                        </ul>
                    </div>
                </li>
            @endif

            @if ($ques && $ques->status == 'Active')
                <li class="nav-item menu-items">
                    <a class="nav-link" data-bs-toggle="collapse" href="#kuesioner-menu" aria-expanded="false" aria-controls="kuesioner-menu">
                        <span class="menu-icon">
                            <i class="mdi mdi-playlist-play"></i>
                        </span>
                        <span class="menu-title">Validity and Realibility Menu</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="kuesioner-menu">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('user.validity-and-reliability-item.index') }}">Insert Item</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('user.validandreliable.data.index') }}">Questionnaire Data</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Validity Test</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Reliability Test</a></li>
                        </ul>
                    </div>
                </li>
            @endif
        @endif

        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route($role.'.profile.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-contacts"></i>
                </span>
                <span class="menu-title">Profile</span>
            </a>
        </li>

        @if(auth()->user()->role == 1)
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ route('admin.setting.index') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-settings"></i>
                    </span>
                    <span class="menu-title">Web Setting</span>
                </a>
            </li>
        @endif
        <li class="nav-item menu-items d-none">
            <a class="nav-link" href="http://www.bootstrapdash.com/demo/corona-free/jquery/documentation/documentation.html">
                <span class="menu-icon">
                    <i class="mdi mdi-file-document-box"></i>
                </span>
                <span class="menu-title">Documentation</span>
            </a>
        </li>
    </ul>
</nav>
