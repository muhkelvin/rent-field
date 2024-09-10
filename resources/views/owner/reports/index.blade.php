@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold my-4">{{ __('Booking Reports') }}</h1>

        <!-- Success and Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded-md mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Filter Form -->
        <form action="{{ route('owner.reports.index') }}" method="GET" class="mb-6 flex space-x-4">
            <div>
                <label for="from" class="block text-sm font-medium text-gray-700">{{ __('From') }}</label>
                <input type="date" name="from" id="from" value="{{ request('from') }}" class="border border-gray-300 rounded-lg p-2 w-full">
            </div>

            <div>
                <label for="to" class="block text-sm font-medium text-gray-700">{{ __('To') }}</label>
                <input type="date" name="to" id="to" value="{{ request('to') }}" class="border border-gray-300 rounded-lg p-2 w-full">
            </div>

            <div class="flex items-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">{{ __('Filter') }}</button>
            </div>
        </form>

        <!-- Fields Table -->
        <h2 class="text-xl font-semibold mb-4">{{ __('Your Fields') }}</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead>
                <tr class="bg-gray-200">
                    <th class="text-left p-4">{{ __('Field Name') }}</th>
                    <th class="text-left p-4">{{ __('Category') }}</th>
                    <th class="text-left p-4">{{ __('Price') }}</th>
                    <th class="text-left p-4">{{ __('Address') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fields as $field)
                    <tr class="border-t">
                        <td class="p-4">{{ $field->name }}</td>
                        <td class="p-4">{{ $field->category->name }}</td>
                        <td class="p-4">${{ $field->price }}</td>
                        <td class="p-4">{{ $field->address }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Bookings Table -->
        <h2 class="text-xl font-semibold mt-8 mb-4">{{ __('Booking History') }}</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead>
                <tr class="bg-gray-200">
                    <th class="text-left p-4">{{ __('Field Name') }}</th>
                    <th class="text-left p-4">{{ __('Customer') }}</th>
                    <th class="text-left p-4">{{ __('Start Time') }}</th>
                    <th class="text-left p-4">{{ __('End Time') }}</th>
                    <th class="text-left p-4">{{ __('Total Price') }}</th>
                    <th class="text-left p-4">{{ __('Created At') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bookings as $booking)
                    <tr class="border-t">
                        <td class="p-4">{{ $booking->field->name }}</td>
                        <td class="p-4">{{ $booking->user->name }}</td>
                        <td class="p-4">{{ $booking->start_time }}</td>
                        <td class="p-4">{{ $booking->end_time }}</td>
                        <td class="p-4">${{ $booking->total_price }}</td>
                        <td class="p-4">{{ $booking->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        @if($bookings->isEmpty())
            <p class="text-center text-gray-500 mt-6">{{ __('No bookings found for the selected date range.') }}</p>
        @endif
    </div>
@endsection
