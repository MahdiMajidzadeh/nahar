@extends('template.master-dashboard')

@section('title', 'رزرو')

@section('inner-content')
    @include('template.messages')
    <div class="card d-print-none mb-4">
        <div class="card-body">
            <form class="form-inline">
                <label class="mb-2 mr-sm-2" for="room-list">اتاق: </label>
                <select class="custom-select mb-2 mr-sm-2" name="room" id="room-list">
                    <option value="">---</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary  mb-2 ml-sm-2">انتخاب</button>
            </form>
        </div>
    </div>
    @if($show)
        <div class="row">
            <div class="col-md-7 mx-auto">
                <div class="card d-print-none mb-4">
                    <div class="card-body">
                        <h4 class="font-weight-bold mb-3">اتاق {{ $roomCurrent->name }}</h4>
                        @forelse($reservations as $reservation)
                            <div class="border border-warning p-2 rounded mb-2">
                                <p class="mb-2">
                                    {{ \Morilog\Jalali\Jalalian::fromDateTime($reservation->started_at)->format('%A: %d %B %y') }}
                                </p>
                                <strong>
                                    {{ \Morilog\Jalali\Jalalian::fromDateTime($reservation->started_at)->format('%H:%M') }}
                                    تا {{ \Morilog\Jalali\Jalalian::fromDateTime($reservation->ended_at)->format('%H:%M') }}
                                </strong>
                                <p class="mb-2">
                                    {{ $reservation->user->name }}
                                </p>
                                <p class="mb-2">
                                    یادداشت: {{ $reservation->note ?? '(بدون یادداشت)' }}
                                </p>
                                <button class="btn btn-outline-danger btn-sm delete-btn"
                                        data-id="{{ $reservation->id }}">حذف
                                </button>
                            </div>
                        @empty
                            <p>بدون رزرو</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('css')
    <link href="{{ mix('css/persian-datepicker.min.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ mix('css/sweetalert2.min.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ mix('js/persian-date.min.js') }}"></script>
    <script src="{{ mix('js/persian-datepicker.min.js') }}"></script>
    <script src="{{ mix('js/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.delete-btn').on('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'حذف!',
                    text: 'از حذف این رزرو مطمئن هستین؟',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'بله',
                    cancelButtonText: 'نه',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ url('admin/otagh/delete/') }}" +"/"+ $(e.target).data('id');
                    }
                });
            });
        });
    </script>
@endpush
