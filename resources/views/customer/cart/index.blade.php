@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">{{ __('Your Cart') }}</h1>

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

        @if($cart->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>{{ __('Field Name') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Time') }}</th>
                        <th>{{ __('Subtotal') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart as $booking)
                        <tr>
                            <td>{{ $booking->field->name ?? 'N/A' }}</td>
                            <td>${{ $booking->field->price ?? '0.00' }}</td>
                            <td>{{ $booking->start_time ? \Carbon\Carbon::parse($booking->start_time)->format('Y-m-d') : 'N/A' }}</td>
                            <td>{{ $booking->start_time ? \Carbon\Carbon::parse($booking->start_time)->format('H:i') : 'N/A' }}</td>
                            <td>${{ $booking->total_price ?? '0.00' }}</td>
                            <td>
                                <form action="{{ route('cart.destroy', ['cart' => $booking->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">{{ __('Remove') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">{{ __('Proceed to Checkout') }}</button>
                </form>
            </div>
        @else
            <div class="alert alert-info">
                {{ __('Your cart is empty.') }}
            </div>
        @endif
    </div>
@endsection
