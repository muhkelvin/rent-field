@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">{{ __('Bookings') }}</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($bookings->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>{{ __('Field Name') }}</th>
                        <th>{{ __('Customer') }}</th>
                        <th>{{ __('Start Time') }}</th>
                        <th>{{ __('End Time') }}</th>
                        <th>{{ __('Total Price') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->field->name }}</td>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ $booking->start_time }}</td>
                            <td>{{ $booking->end_time }}</td>
                            <td>${{ $booking->total_price }}</td>
                            <td>{{ ucfirst($booking->status) }}</td>
                            <td>
                                <a href="{{ route('owner.bookings.show', $booking) }}" class="btn btn-primary btn-sm">{{ __('View Details') }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                {{ __('No bookings found.') }}
            </div>
        @endif
    </div>
@endsection
