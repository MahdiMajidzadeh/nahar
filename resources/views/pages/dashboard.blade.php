@extends('master-dashboard')

@section('title', 'داشبورد')

@section('inner-content')
    <div class="card my-4">
        <div class="card-body p-3">
            <a href="{{ url('dashboard/reserve') }}" class="btn btn-secondary">رزرو</a>
            <a href="{{ url('dashboard/history') }}" class="btn btn-secondary">تاریخچه</a>
            <a href="{{ url('dashboard/password-reset') }}" class="btn btn-secondary">تغییر رمز</a>
        </div>
    </div>
@endsection