@extends('template.master')

@section('content')
    <nav class="navbar fixed-top navbar-expand-lg bg-dark navbar-dark">
        <a class="navbar-brand" href="{{ url('dashboard') }}">سامانه باسلامی‌ها</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/dashboard/change-log') }}">تغییرات</a>
                </li>
                @if(is_admin())
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/admin') }}">مدیریت</a>
                </li>
                @endif
            </ul>
        </div>
    </nav>
    <div class="content">
        @yield('inner-content')
    </div>
@endsection

@push('css')
    <!-- PushAlert -->
    <script type="text/javascript">
        (function(d, t) {
            var g = d.createElement(t),
                s = d.getElementsByTagName(t)[0];
            g.src = "https://cdn.pushalert.co/integrate_771d0f0bfb7ddef5e7fa89c8dcccb521.js";
            s.parentNode.insertBefore(g, s);
        }(document, "script"));
    </script>
    <!-- End PushAlert -->
    <script>
        (pushalertbyiw = window.pushalertbyiw || []).push(['addAttributes', {"user_id": {{ auth()->id() }}}]); //add attributes in form of key-value pair
    </script>
@endpush