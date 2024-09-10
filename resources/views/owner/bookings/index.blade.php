@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-bold mb-4">{{ __('Bookings') }}</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if($bookings->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg">
                    <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4">{{ __('Field Name') }}</th>
                        <th class="py-2 px-4">{{ __('Customer') }}</th>
                        <th class="py-2 px-4">{{ __('Start Time') }}</th>
                        <th class="py-2 px-4">{{ __('End Time') }}</th>
                        <th class="py-2 px-4">{{ __('Total Price') }}</th>
                        <th class="py-2 px-4">{{ __('Status') }}</th>
                        <th class="py-2 px-4">{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bookings as $booking)
                        <tr class="border-b">
                            <td class="py-2 px-4">{{ $booking->field->name }}</td>
                            <td class="py-2 px-4">{{ $booking->user->name }}</td>
                            <td class="py-2 px-4">{{ $booking->start_time }}</td>
                            <td class="py-2 px-4">{{ $booking->end_time }}</td>
                            <td class="py-2 px-4">${{ $booking->total_price }}</td>
                            <td class="py-2 px-4">{{ ucfirst($booking->status) }}</td>
                            <td class="py-2 px-4">
                                <a href="{{ route('owner.bookings.show', $booking) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded text-sm">{{ __('View Details') }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-blue-100 text-blue-800 p-4 rounded">
                {{ __('No bookings found.') }}
            </div>
        @endif
    </div>
@endsection
