@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold my-4">{{ __('Edit Field') }}</h1>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('owner.fields.update', $field) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700">{{ __('Field Name') }}</label>
                <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2" value="{{ old('name', $field->name) }}" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700">{{ __('Description') }}</label>
                <textarea name="description" id="description" class="w-full border rounded px-3 py-2" rows="5" required>{{ old('description', $field->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-700">{{ __('Price') }}</label>
                <input type="number" name="price" id="price" class="w-full border rounded px-3 py-2" value="{{ old('price', $field->price) }}" required>
            </div>

            <div class="mb-4">
                <label for="address" class="block text-gray-700">{{ __('Address') }}</label>
                <input type="text" name="address" id="address" class="w-full border rounded px-3 py-2" value="{{ old('address', $field->address) }}" required>
            </div>

            <div class="mb-4">
                <label for="field_category_id" class="block text-gray-700">{{ __('Category') }}</label>
                <select name="field_category_id" id="field_category_id" class="w-full border rounded px-3 py-2" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('field_category_id', $field->field_category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">{{ __('Update Field') }}</button>
        </form>
    </div>
@endsection
