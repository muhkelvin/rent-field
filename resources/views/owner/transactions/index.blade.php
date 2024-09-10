@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">{{ __('Transactions') }}</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if(count($payments) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg">
                    <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-4 border-b">{{ __('Booking ID') }}</th>
                        <th class="py-3 px-4 border-b">{{ __('Payment Method') }}</th>
                        <th class="py-3 px-4 border-b">{{ __('Amount') }}</th>
                        <th class="py-3 px-4 border-b">{{ __('Transaction ID') }}</th>
                        <th class="py-3 px-4 border-b">{{ __('Status') }}</th>
                        <th class="py-3 px-4 border-b">{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($payments as $payment)
                        <tr>
                            <td class="py-3 px-4 border-b">{{ $payment->booking_id }}</td>
                            <td class="py-3 px-4 border-b">{{ $payment->payment_method }}</td>
                            <td class="py-3 px-4 border-b">${{ $payment->amount }}</td>
                            <td class="py-3 px-4 border-b">{{ $payment->transaction_id }}</td>
                            <td class="py-3 px-4 border-b">{{ ucfirst($payment->status) }}</td>
                            <td class="py-3 px-4 border-b">
                                @if($payment->status == 'pending')
                                    <form action="{{ route('owner.transactions.update', $payment) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">{{ __('Mark as Completed') }}</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-yellow-500 text-white p-4 rounded">
                {{ __('No transactions found.') }}
            </div>
        @endif
    </div>
@endsection
