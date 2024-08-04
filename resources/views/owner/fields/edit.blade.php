@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">{{ __('Edit Field') }}</h1>

        @if($errors->any())
            <div class="alert alert-danger">
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

            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Field Name') }}</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $field->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">{{ __('Description') }}</label>
                <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description', $field->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">{{ __('Price') }}</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $field->price) }}" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">{{ __('Address') }}</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $field->address) }}" required>
            </div>

            <div class="mb-3">
                <label for="field_category_id" class="form-label">{{ __('Category') }}</label>
                <select name="field_category_id" id="field_category_id" class="form-select" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('field_category_id', $field->field_category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">{{ __('Update Field') }}</button>
        </form>
    </div>
@endsection
