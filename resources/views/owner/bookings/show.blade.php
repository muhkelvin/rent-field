@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-bold mb-4">{{ __('Booking Details') }}</h1>

        @if(session('error'))
            <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4">{{ __('Booking Information') }}</h3>
            <p><strong>{{ __('Field Name:') }}</strong> {{ $booking->field->name }}</p>
            <p><strong>{{ __('Customer Name:') }}</strong> {{ $booking->user->name }}</p>
            <p><strong>{{ __('Start Time:') }}</strong> {{ $booking->start_time }}</p>
            <p><strong>{{ __('End Time:') }}</strong> {{ $booking->end_time }}</p>
            <p><strong>{{ __('Total Price:') }}</strong> ${{ $booking->total_price }}</p>
            <p><strong>{{ __('Status:') }}</strong> {{ ucfirst($booking->status) }}</p>
        </div>

        <div class="mt-4">
            <a href="{{ route('owner.bookings.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">{{ __('Back to Bookings') }}</a>
        </div>
    </div>
@endsection
