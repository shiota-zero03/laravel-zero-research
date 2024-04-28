@php
    $set = \App\Models\Setting::get()->first();
@endphp
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ $set->app_name }}</title>
        @include('pages.template.head')
        <style>
            .header-section{
                background-color: rgb(113, 226, 243);
                padding-top: 70px
            }
            a.top-menu-landing{
                color: rgb(1, 57, 104);
                font-weight: 500;
                transition: .3s ease;
            }
            a.top-menu-landing:hover{
                color: rgb(0, 0, 0);
                font-weight: 500;
                transition: .3s ease;
            }
            .btn-login{
                background: rgb(1, 57, 104);
                transition: .5s ease;
            }
            .btn-login:hover{
                background: rgb(0, 0, 0);
                transition: .5s ease;
            }
            .text-blue{
                color: rgb(1, 57, 104);
            }
            @media screen and (max-width: 767px){
                .w-md-100{
                    width: 100%
                }
            }
        </style>
    </head>
    <body>

        <header class="position-fixed w-100">
            <div class="container my-2">
                <nav class="d-md-flex align-items-center justify-content-between">
                    <div>
                        <div class="d-md-flex align-items-center">
                            <div class="me-md-3 d-flex align-items-center justify-content-between w-md-100">
                                <img class="d-md-block d-none" src="{{ asset('storage'.$set->maks_logo) }}" alt="" height="50">
                                <img class="d-md-none" src="{{ asset('storage'.$set->min_logo) }}" alt="" height="50">
                                <button class="btn d-md-none" id="menu-button">
                                    <h2 class="my-0 text-blue"><i class="mdi mdi-menu"></i></h2>
                                </button>
                            </div>
                            <div class="e" id="menu-show">
                                <div class="d-md-flex align-items-center" style="height: 100%">
                                    <div class="w-md-100 text-center"><a class="d-block top-menu-landing px-md-3 px-5 py-2 text-decoration-none w-100" href="#home">Home</a></div>
                                    <div class="w-md-100 text-center"><a class="d-block top-menu-landing px-md-3 px-5 py-2 text-decoration-none w-100" href="#about">About</a></div>
                                    <div class="w-md-100 text-center"><a class="d-block top-menu-landing px-md-3 px-5 py-2 text-decoration-none w-100" href="#contact">Contact</a></div>
                                    <div class="w-md-100 text-center d-md-none">
                                        <a href="{{ route('login') }}" class="btn btn-login py-2 px-md-4 w-100 rounded-pill">Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('login') }}" class="btn btn-login py-2 px-md-4 rounded-pill d-md-block d-none">Login</a>
                    </div>
                </nav>
            </div>
        </header>

        <div class="header-section">
            <div class="container">
                <div class="d-md-flex align-items-center">
                    <div class="col-md-4 col-12 text-blue">
                        <h1>Efficient Quantitative Data Analysis</h1>
                        <p class="mb-0">This website will give you an exciting experience in carrying out quantitative data analysis</p><br />
                        <p class="mb-1">let's explore this system by logging into it</p>
                        <a href="{{ route('login') }}" class="btn btn-login">Click here to login</a>
                        <br /><br />
                        <p class="mb-1">Do you have any questions?</p>
                        <a href="#contact" class="btn btn-login">Click here to contact us</a><br />
                    </div>
                    <div class="col-md-8 col-12 text-end">
                        <img src="{{ asset('assets/images/background-landing-page.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        @include('pages.template.script')

        <script>
            $(document).ready(function(){
                $('#menu-button').click(function(){
                    $('#menu-show').slideToggle();
                });

                function toggleMenu() {
                    if ($(window).width() < 768) {
                        $('#menu-show').slideUp();
                        $('#menu-button').show();
                    } else {
                        $('#menu-button').hide();
                        $('#menu-show').show(); // Show menu if width is greater than 768px
                    }
                }
                toggleMenu();
                $(window).resize(function() {
                    toggleMenu();
                });
            });
        </script>

    </body>
</html>
