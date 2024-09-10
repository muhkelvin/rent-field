@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-light text-gray-900 mb-8">{{ $field->name }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div>
                <img src="{{ asset('storage/' . $field->image) }}" class="w-full h-auto rounded-lg shadow-sm" alt="{{ $field->name }}">
            </div>
            <div class="space-y-8">
                <section>
                    <h2 class="text-xl font-medium text-gray-900 mb-2">{{ __('Description') }}</h2>
                    <p class="text-gray-600">{{ $field->description }}</p>
                </section>

                <section class="flex items-baseline justify-between">
                    <h2 class="text-xl font-medium text-gray-900">{{ __('Price') }}</h2>
                    <span class="text-2xl font-semibold text-indigo-600">${{ $field->price }}</span>
                </section>

                <section>
                    <h2 class="text-xl font-medium text-gray-900 mb-2">{{ __('Location') }}</h2>
                    <p class="text-gray-600">{{ $field->address }}</p>
                </section>

                <section>
                    <h2 class="text-xl font-medium text-gray-900 mb-2">{{ __('Availability') }}</h2>
                    @if($field->availabilities->isNotEmpty())
                        <ul class="space-y-1">
                            @foreach ($field->availabilities as $availability)
                                <li class="text-gray-600">
                                    <span class="font-medium">{{ \Illuminate\Support\Str::ucfirst($availability->day_of_week) }}:</span>
                                    {{ $availability->available_from }} - {{ $availability->available_until }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-600">{{ __('No availability information provided.') }}</p>
                    @endif
                </section>

                <form action="{{ route('cart.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="field_id" value="{{ $field->id }}">

                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Date') }}</label>
                        <input type="date" name="date" id="date" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label for="time" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Time') }}</label>
                        <input type="time" name="time" id="time" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                        {{ __('Book Now') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
