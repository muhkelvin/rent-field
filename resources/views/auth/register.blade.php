@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-4">{{ __('Register') }}</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">{{ __('Name') }}</label>
                        <input id="name" type="text" class="w-full px-4 py-2 border border-gray-300 rounded @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="w-full px-4 py-2 border border-gray-300 rounded @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required>
                        @error('email')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700">{{ __('Password') }}</label>
                        <input id="password" type="password" class="w-full px-4 py-2 border border-gray-300 rounded @error('password') border-red-500 @enderror" name="password" required>
                        @error('password')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password-confirm" class="block text-gray-700">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="w-full px-4 py-2 border border-gray-300 rounded" name="password_confirmation" required>
                    </div>

                    <div class="mb-4">
                        <label for="role" class="block text-gray-700">{{ __('Role') }}</label>
                        <select id="role" class="w-full px-4 py-2 border border-gray-300 rounded @error('role') border-red-500 @enderror" name="role" required>
                            <option value="customer">{{ __('Customer') }}</option>
                            <option value="owner">{{ __('Owner') }}</option>
                        </select>
                        @error('role')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
