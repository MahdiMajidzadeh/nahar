@extends('template.master-dashboard')

@section('title', 'ویرایش کاربر')

@section('inner-content')
    <div class="row">
        <div class="col-12">
            @include('template.messages')
            @if(!is_null($user->deactivated_at))
                <div class="alert alert-warning" role="alert">
                    این کارمند، رو دیگه بین خودمون نداریم!
                </div>
            @endif
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ url('admin/users/edit') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label>اسم</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>موبایل</label>
                            <input type="text" class="form-control" value="{{ $user->mobile }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>شماره پرسنلی</label>
                            <input type="text" class="form-control" name="employee_id"
                                   value="{{ $user->employee_id }}">
                        </div>
                        <div class="form-group">
                            <label>تیم</label>
                            <select class="form-control" name="team">
                                <option>--</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}"
                                            @if($user->team_id == $team->id) selected @endif
                                    >{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>چپتر</label>
                            <select class="form-control" name="chapter">
                                <option>--</option>
                                @foreach($chapters as $chapter)
                                    <option value="{{ $chapter->id }}"
                                            @if($user->chapter_id == $chapter->id) selected @endif
                                    >{{ $chapter->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>ایمیل</label>
                            <input type="text" class="form-control" name="email"
                                   value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label>ایمیل باسلامی</label>
                            <input type="text" class="form-control" name="email_basalam"
                                   value="{{ $user->email_basalam }}">
                        </div>
                        <div class="form-group">
                            <label>تاریخ ورود</label>
                            <input type="text" class="form-control" name="date" id="date"
                                   value="{{ $user->started_at }}">
                            <input type="hidden" class="form-control" name="date_alt" id="date_alt">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="is_inter"
                                       id="is_inter"
                                       @if($user->is_inter) checked="checked" @endif
                                >
                                <label class="custom-control-label" for="is_inter">کارآموز</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">ثبت</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ url('admin/users/edit/avatar') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="form-group">
                            @if(!is_null($user->avatar))
                                <img src="{{ asset(Illuminate\Support\Facades\Storage::url($user->avatar)) }}"
                                     class="img-fluid mb-3">
                            @endif
                            <label>آواتار</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="avatar">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">ثبت</button>
                    </form>
                </div>
            </div>
            <div class="card my-4">
                <div class="card-body">
                    <form method="post" action="{{ url('admin/users/edit/deactivate') }}"
                          id="deactivate">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label>تاریخ خروج</label>
                            <input type="text" class="form-control" name="date" id="date_e"
                                   value="{{ $user->deactivated_at }}">
                            <input type="hidden" class="form-control" name="date_alt" id="date_alt_e">
                        </div>
                        <a href="#" class="btn btn-primary" id="deactivate-btn">غیرفعال سازی</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="{{ mix('css/persian-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ mix('css/sweetalert2.min.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ mix('js/persian-date.min.js') }}"></script>
    <script src="{{ mix('js/persian-datepicker.min.js') }}"></script>
    <script src="{{ mix('js/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#date").pDatepicker({
                altField: '#date_alt',
                altFormat: 'X',
                format: 'YYYY/MM/DD',
                observer: true
            });
            $("#date_e").pDatepicker({
                altField: '#date_alt_e',
                altFormat: 'X',
                format: 'YYYY/MM/DD',
                observer: true
            });
            $('#deactivate-btn').on('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'خداحافظی!',
                    text: 'از غیر فعال کردن این کارمند مطمئن هستید؟',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'بای‌بای',
                    cancelButtonText: 'نه',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#deactivate').submit();
                    }
                });
            });
        });
    </script>
@endpush
