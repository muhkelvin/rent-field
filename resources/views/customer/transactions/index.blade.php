@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">{{ __('Transaction History') }}</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(count($transactions) > 0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>{{ __('Field Name') }}</th>
                        <th>{{ __('Start Time') }}</th>
                        <th>{{ __('End Time') }}</th>
                        <th>{{ __('Total Price') }}</th>
                        <th>{{ __('Payment Method') }}</th>
                        <th>{{ __('Payment Status') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->booking->field->name ?? 'N/A' }}</td>
                            <td>{{ $transaction->booking->start_time ? \Carbon\Carbon::parse($transaction->booking->start_time)->format('Y-m-d H:i') : 'N/A' }}</td>
                            <td>{{ $transaction->booking->end_time ? \Carbon\Carbon::parse($transaction->booking->end_time)->format('Y-m-d H:i') : 'N/A' }}</td>
                            <td>${{ $transaction->amount }}</td>
                            <td>{{ ucfirst($transaction->payment_method) }}</td>
                            <td>
                                <span class="badge {{ $transaction->status == 'completed' ? 'bg-success' : ($transaction->status == 'failed' ? 'bg-danger' : 'bg-warning') }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                {{ __('You have no transactions yet.') }}
            </div>
        @endif
    </div>
@endsection
