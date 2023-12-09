<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FK Kiosk Management System</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style">

    <!-- Icons -->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

</head>

@if (auth()->user()->getRoleNames()->first() == 'Admin')
    <body class="loading" data-layout-config='{"leftSideBarTheme":"light","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
@elseif(auth()->user()->getRoleNames()->first() == 'Kiosk Participant')
    <body class="loading" data-layout-config='{"leftSideBarTheme":"default","layoutBoxed":false,"leftSidebarCondensed":false,"leftSidebarScrollable":false,"darkMode":false,"showRightSidebarOnStart":true}'>
@else
    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
@endif

<div class="wrapper">

    <div class="left-side-menu">

        <!-- LOGO -->
        @if (auth()->user()->getRoleNames()->first() == 'Admin')
            <a href="index.html" class="logo text-center logo-dark">
                <span class="logo-lg">
                    <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="16">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('assets/images/logo_sm_dark.png') }}" alt="" height="16">
                </span>
            </a>
        @else
            <a href="index.html" class="logo text-center logo-light">
                <span class="logo-lg">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="" height="16">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('assets/images/logo_sm.png') }}" alt="" height="16">
                </span>
            </a>
        @endif

        <div class="h-100" id="left-side-menu-container" data-simplebar>

            <ul class="metismenu side-nav">

                {{-- Profile and Role --}}
                <div class="side-nav-link">
                    <a href="javascript: void(0);">

                        <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-image" height="35"
                            class="rounded-circle shadow-sm">

                        @if (auth()->user()->getRoleNames()->first() == 'Admin')
                            <div class="user-avatar">
                                <span class="leftbar-user-name text-dark"
                                    style="font-weight: bold">{{ Auth::user()->name }}</span>
                                <p class="text-muted font-14">{{ auth()->user()->getRoleNames()->first() }}</p>
                            </div>
                        @else
                            <div class="user-avatar">
                                <span class="leftbar-user-name text-white"
                                    style="font-weight: bold">{{ Auth::user()->name }}</span>
                                <p class="text-white font-14">{{ auth()->user()->getRoleNames()->first() }}</p>
                            </div>
                        @endif

                    </a>
                </div>

                <li class="side-nav-title side-nav-item">Menu</li>

                @include('navigation-menu')

            </ul>

            <div class="clearfix"></div>

        </div>

    </div>

    <div class="content-page">

        <div class="content">

            {{-- Navigation Bar --}}
            @if (auth()->user()->getRoleNames()->first() == 'Admin')
                <div class="navbar-custom">
            @elseif(auth()->user()->getRoleNames()->first() == 'Kiosk Participant')
                <div class="navbar-custom" style="background-color: #CA3433;">
            @else
                <div class="navbar-custom" style="background-color: #007EA7;">
            @endif

            <ul class="list-unstyled topbar-right-menu float-right mb-0">

                {{-- Notification --}}
                <li class="dropdown notification-list">

                    <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">

                        @if (auth()->user()->getRoleNames()->first() == 'Admin')
                            <i class="dripicons-bell noti-icon text-dark"></i>
                        @else
                            <i class="dripicons-bell noti-icon text-white"></i>
                        @endif

                        <span class="noti-icon-badge"></span>

                    </a>

                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg">

                        <div class="dropdown-item noti-title">
                            <h5 class="m-0">
                                <span class="float-right">
                                    <a href="javascript: void(0);" class="text-dark">
                                        <small>Clear All</small>
                                    </a>
                                </span>
                                Notification
                            </h5>
                        </div>

                        <div style="max-height: 230px;" data-simplebar>
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-primary">
                                    <i class="mdi mdi-comment-account-outline"></i>
                                </div>
                                <p class="notify-details">Caleb Flakelar commented on Admin
                                    <small class="text-muted">1 min ago</small>
                                </p>
                            </a>
                        </div>

                        <a href="javascript:void(0);"
                            class="dropdown-item text-center text-primary notify-item notify-all">
                            View All
                        </a>

                    </div>

                </li>

                {{-- Profile --}}
                <li class="dropdown notification-list">

                    <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown"
                        href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="account-user-avatar">
                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-image"
                                class="rounded-circle">
                        </span>
                    </a>

                    <div
                        class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown">

                        <a href="{{ route('profile.show') }}" class="dropdown-item notify-item">
                            <i class="mdi mdi-account-circle mr-1"></i>
                            {{ __('My Profile') }}
                        </a>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" class="dropdown-item notify-item">
                            @csrf
                            <i class="mdi mdi-logout mr-1"></i>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>

                    </div>

                </li>

            </ul>

            <button class="button-menu-mobile open-left disable-btn text-white">
                <i class="mdi mdi-menu"></i>
            </button>

        </div>

        {{-- Page Content --}}
        <div class="container-fluid">
            {{ $slot }}
        </div>

    </div>

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © FKKMS
                </div>
            </div>
        </div>
    </footer>

</div>

</div>

<!-- bundle -->
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>

<!-- third party js -->
<script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.checkboxes.min.js') }}"></script>

<!-- demo app -->
<script src="{{ asset('assets/js/pages/demo.customers.js') }}"></script>

<!-- Datatables js -->
<script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatable Init js -->
<script src="{{ asset('assets/js/pages/demo.datatable-init.js') }}"></script>

</body>

</html>
