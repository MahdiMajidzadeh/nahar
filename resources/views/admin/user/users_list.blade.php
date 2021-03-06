@extends('template.master-dashboard')

@section('title', 'لیست کاربران')

@section('inner-content')
    <div class="card  d-print-none my-4">
        <div class="card-body">
            <form class="form-inline">
                <div class="form-group ml-3">
                    <label for="name">نام : </label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group ml-3">
                    <label for="mobile">موبایل : </label>
                    <input type="text" class="form-control" id="mobile" name="mobile">
                </div>
                <button type="submit" class="btn btn-primary ml-3">جستجو</button>
                <a href="{{ url('admin/users') }}" class="btn btn-secondary ml-3">پاک کردن فیلتر</a>
            </form>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">کد پرسنلی</th>
            <th scope="col">اسم</th>
            <th scope="col">موبایل</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="@if(!is_null($user->deactivated_at)) text-muted @endif">
                <td>{{ $user->employee_id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->mobile }}</td>
                <td><a href="{{ url('admin/users/'.$user->id) }}" class="btn btn-primary">ویرایش</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$users->links()}}
@endsection
