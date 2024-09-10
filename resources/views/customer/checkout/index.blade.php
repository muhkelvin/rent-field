@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-light text-gray-900 mb-8">{{ __('Checkout') }}</h1>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if($cart->isNotEmpty())
            <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Field Name') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Price') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Date') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Time') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Subtotal') }}</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($cart as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->field->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ $item->field->price }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($item->start_time)->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ $item->total_price }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-white shadow sm:rounded-lg p-6">
                <h2 class="text-xl font-medium text-gray-900 mb-6">{{ __('Payment Details') }}</h2>
                <form action="{{ route('payment.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="field_id" value="{{ $cart->first()->field->id }}">
                    <input type="hidden" name="total_price" value="{{ $cart->sum('total_price') }}">

                    <div class="mb-6">
                        <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Payment Method') }}</label>
                        <select name="payment_method" id="payment_method" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                            <option value="credit_card">{{ __('Credit Card') }}</option>
                            <option value="bank_transfer">{{ __('Bank Transfer') }}</option>
                            <option value="paypal">{{ __('PayPal') }}</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-semibold text-gray-900">Total: ${{ $cart->sum('total_price') }}</span>
                        <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Complete Payment') }}
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
                <p>{{ __('Your cart is empty. Please add items to your cart before proceeding to checkout.') }}</p>
            </div>
        @endif
    </div>
@endsection
