@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 my-8">{{ __('Field Listings') }}</h1>

        <form method="GET" action="{{ route('fields.index') }}" class="mb-8 bg-white shadow-md rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Category') }}</label>
                    <select id="category" name="category" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="">{{ __('All Categories') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Location') }}</label>
                    <input type="text" id="location" name="location" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="{{ __('Enter location') }}" value="{{ request('location') }}">
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Price Order') }}</label>
                    <select id="price" name="price" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="">{{ __('No Order') }}</option>
                        <option value="asc" {{ request('price') == 'asc' ? 'selected' : '' }}>{{ __('Low to High') }}</option>
                        <option value="desc" {{ request('price') == 'desc' ? 'selected' : '' }}>{{ __('High to Low') }}</option>
                    </select>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full md:w-auto inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Filter') }}
                </button>
            </div>
        </form>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($fields as $field)
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <img src="{{ $field->image }}" alt="{{ $field->name }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $field->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($field->description, 100) }}</p>
                        <p class="text-gray-800 font-bold mb-2">${{ $field->price }}</p>
                        <p class="text-gray-600 mb-4"><i class="fas fa-map-marker-alt mr-2"></i>{{ $field->address }}</p>
                        <a href="{{ route('fields.show', $field) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('View Details') }}
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-gray-600 col-span-full text-center py-8">{{ __('No fields available.') }}</p>
            @endforelse
        </div>
    </div>
@endsection
