@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">{{ __('Booking Details') }}</h1>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3>{{ __('Booking Information') }}</h3>
            </div>
            <div class="card-body">
                <p><strong>{{ __('Field Name:') }}</strong> {{ $booking->field->name }}</p>
                <p><strong>{{ __('Customer Name:') }}</strong> {{ $booking->user->name }}</p>
                <p><strong>{{ __('Start Time:') }}</strong> {{ $booking->start_time }}</p>
                <p><strong>{{ __('End Time:') }}</strong> {{ $booking->end_time }}</p>
                <p><strong>{{ __('Total Price:') }}</strong> ${{ $booking->total_price }}</p>
                <p><strong>{{ __('Status:') }}</strong> {{ ucfirst($booking->status) }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('owner.bookings.index') }}" class="btn btn-secondary">{{ __('Back to Bookings') }}</a>
            </div>
        </div>
    </div>
@endsection
