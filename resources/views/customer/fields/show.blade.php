@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">{{ $field->name }}</h1>

        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $field->image) }}" class="img-fluid" alt="{{ $field->name }}">
            </div>
            <div class="col-md-6">
                <h3>{{ __('Description') }}</h3>
                <p>{{ $field->description }}</p>

                <h3>{{ __('Price') }}</h3>
                <p>${{ $field->price }}</p>

                <h3>{{ __('Location') }}</h3>
                <p>{{ $field->address }}</p>

                <h3>{{ __('Availability') }}</h3>
                @if($field->availabilities->isNotEmpty())
                    <ul>
                        @foreach ($field->availabilities as $availability)
                            <li>
                                <strong>{{ \Illuminate\Support\Str::ucfirst($availability->day_of_week) }}:</strong>
                                {{ $availability->available_from }} - {{ $availability->available_until }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>{{ __('No availability information provided.') }}</p>
                @endif

                <form action="{{ route('cart.store') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="field_id" value="{{ $field->id }}">

                    <div class="form-group mt-3">
                        <label for="date">{{ __('Date') }}</label>
                        <input type="date" name="date" id="date" class="form-control" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="time">{{ __('Time') }}</label>
                        <input type="time" name="time" id="time" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">{{ __('Book Now') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
