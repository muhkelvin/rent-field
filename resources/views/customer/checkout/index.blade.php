@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">{{ __('Checkout') }}</h1>

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
            <div class="table-responsive mb-4">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>{{ __('Field Name') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Time') }}</th>
                        <th>{{ __('Subtotal') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart as $item)
                        <tr>
                            <td>{{ $item->field->name }}</td>
                            <td>${{ $item->field->price }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->start_time)->format('Y-m-d') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }}</td>
                            <td>${{ $item->total_price }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <h3>{{ __('Payment Details') }}</h3>
            <form action="{{ route('payment.store') }}" method="POST">
                @csrf
                <input type="hidden" name="field_id" value="{{ $cart->first()->field->id }}">
                <input type="hidden" name="total_price" value="{{ $cart->sum('total_price') }}">

                <div class="form-group mb-3">
                    <label for="payment_method">{{ __('Payment Method') }}</label>
                    <select name="payment_method" class="form-control" required>
                        <option value="credit_card">{{ __('Credit Card') }}</option>
                        <option value="bank_transfer">{{ __('Bank Transfer') }}</option>
                        <option value="paypal">{{ __('PayPal') }}</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">{{ __('Complete Payment') }}</button>
            </form>
        @else
            <div class="alert alert-info">
                {{ __('Your cart is empty. Please add items to your cart before proceeding to checkout.') }}
            </div>
        @endif
    </div>
@endsection
