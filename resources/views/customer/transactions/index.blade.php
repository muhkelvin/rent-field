@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-semibold mb-6">{{ __('Transaction History') }}</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 border-l-4 border-green-500 p-4 mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(count($transactions) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                    <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-4 py-2">{{ __('Field Name') }}</th>
                        <th class="px-4 py-2">{{ __('Start Time') }}</th>
                        <th class="px-4 py-2">{{ __('End Time') }}</th>
                        <th class="px-4 py-2">{{ __('Total Price') }}</th>
                        <th class="px-4 py-2">{{ __('Payment Method') }}</th>
                        <th class="px-4 py-2">{{ __('Payment Status') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $transaction->booking->field->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $transaction->booking->start_time ? \Carbon\Carbon::parse($transaction->booking->start_time)->format('Y-m-d H:i') : 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $transaction->booking->end_time ? \Carbon\Carbon::parse($transaction->booking->end_time)->format('Y-m-d H:i') : 'N/A' }}</td>
                            <td class="px-4 py-2">${{ $transaction->amount }}</td>
                            <td class="px-4 py-2">{{ ucfirst($transaction->payment_method) }}</td>
                            <td class="px-4 py-2">
                                    <span class="px-2 py-1 rounded {{ $transaction->status == 'completed' ? 'bg-green-100 text-green-600' : ($transaction->status == 'failed' ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-600') }}">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-blue-100 text-blue-700 border-l-4 border-blue-500 p-4">
                {{ __('You have no transactions yet.') }}
            </div>
        @endif
    </div>
@endsection
