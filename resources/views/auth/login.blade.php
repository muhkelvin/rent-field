@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-4">{{ __('Login') }}</h2>

                @if(session('status'))
                    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="w-full px-4 py-2 border border-gray-300 rounded @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autofocus>
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

                    <div class="flex items-center mb-4">
                        <input type="checkbox" name="remember" id="remember" class="mr-2">
                        <label for="remember" class="text-gray-700">{{ __('Remember Me') }}</label>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Login') }}
                        </button>
                        <a class="text-sm text-blue-500 hover:text-blue-700" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
