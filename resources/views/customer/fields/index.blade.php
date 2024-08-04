@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">{{ __('Field Listings') }}</h1>

        <form method="GET" action="{{ route('fields.index') }}" class="mb-4">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="category">{{ __('Category') }}</label>
                    <select id="category" name="category" class="form-control">
                        <option value="">{{ __('All Categories') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="location">{{ __('Location') }}</label>
                    <input type="text" id="location" name="location" class="form-control" placeholder="{{ __('Enter location') }}" value="{{ request('location') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="price">{{ __('Price Order') }}</label>
                    <select id="price" name="price" class="form-control">
                        <option value="">{{ __('No Order') }}</option>
                        <option value="asc" {{ request('price') == 'asc' ? 'selected' : '' }}>{{ __('Low to High') }}</option>
                        <option value="desc" {{ request('price') == 'desc' ? 'selected' : '' }}>{{ __('High to Low') }}</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Filter') }}</button>
        </form>

        <div class="row">
            @forelse ($fields as $field)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $field->image }}" class="card-img-top" alt="{{ $field->name }}" style="max-height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $field->name }}</h5>
                            <p class="card-text">{{ Str::limit($field->description, 100) }}</p>
                            <p class="card-text"><strong>{{ __('Price') }}:</strong> ${{ $field->price }}</p>
                            <p class="card-text"><strong>{{ __('Location') }}:</strong> {{ $field->address }}</p>
                            <a href="{{ route('fields.show', $field) }}" class="btn btn-primary">{{ __('View Details') }}</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>{{ __('No fields available.') }}</p>
            @endforelse
        </div>
    </div>
@endsection
