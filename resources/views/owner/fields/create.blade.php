@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-bold mb-4">{{ __('Create New Field') }}</h1>

        @if($errors->any())
            <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('owner.fields.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf

            <div class="mb-4">
                <label for="name" class="block font-medium text-sm text-gray-700">{{ __('Field Name') }}</label>
                <input type="text" name="name" id="name" class="form-input mt-1 block w-full" value="{{ old('name') }}" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block font-medium text-sm text-gray-700">{{ __('Description') }}</label>
                <textarea name="description" id="description" class="form-input mt-1 block w-full" rows="5" required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="price" class="block font-medium text-sm text-gray-700">{{ __('Price') }}</label>
                <input type="number" name="price" id="price" class="form-input mt-1 block w-full" value="{{ old('price') }}" required>
            </div>

            <div class="mb-4">
                <label for="address" class="block font-medium text-sm text-gray-700">{{ __('Address') }}</label>
                <input type="text" name="address" id="address" class="form-input mt-1 block w-full" value="{{ old('address') }}" required>
            </div>

            <div class="mb-4">
                <label for="field_category_id" class="block font-medium text-sm text-gray-700">{{ __('Category') }}</label>
                <select name="field_category_id" id="field_category_id" class="form-select mt-1 block w-full" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('field_category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">{{ __('Create Field') }}</button>
        </form>
    </div>
@endsection
