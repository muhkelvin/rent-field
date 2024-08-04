@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">{{ __('My Fields') }}</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('owner.fields.create') }}" class="btn btn-primary mb-3">{{ __('Add New Field') }}</a>

        @if(count($fields) > 0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Category') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Address') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fields as $field)
                        <tr>
                            <td>{{ $field->name }}</td>
                            <td>{{ $field->category->name }}</td>
                            <td>${{ $field->price }}</td>
                            <td>{{ $field->address }}</td>
                            <td>
                                <a href="{{ route('owner.fields.edit', $field) }}" class="btn btn-warning btn-sm">{{ __('Edit') }}</a>

                                <form action="{{ route('owner.fields.destroy', $field) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('Are you sure you want to delete this field?') }}')">{{ __('Delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                {{ __('You have no fields yet.') }}
            </div>
        @endif
    </div>
@endsection
