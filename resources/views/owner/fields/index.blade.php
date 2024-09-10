@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold my-4">{{ __('My Fields') }}</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('owner.fields.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">{{ __('Add New Field') }}</a>

        @if(count($fields) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-700">{{ __('Name') }}</th>
                        <th class="px-4 py-2 text-left text-gray-700">{{ __('Category') }}</th>
                        <th class="px-4 py-2 text-left text-gray-700">{{ __('Price') }}</th>
                        <th class="px-4 py-2 text-left text-gray-700">{{ __('Address') }}</th>
                        <th class="px-4 py-2 text-left text-gray-700">{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fields as $field)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $field->name }}</td>
                            <td class="px-4 py-2">{{ $field->category->name }}</td>
                            <td class="px-4 py-2">${{ $field->price }}</td>
                            <td class="px-4 py-2">{{ $field->address }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('owner.fields.edit', $field) }}" class="bg-yellow-500 text-white px-3 py-1 rounded inline-block">{{ __('Edit') }}</a>

                                <form action="{{ route('owner.fields.destroy', $field) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded inline-block" onclick="return confirm('{{ __('Are you sure you want to delete this field?') }}')">{{ __('Delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-blue-100 text-blue-700 px-4 py-2 rounded mt-4">
                {{ __('You have no fields yet.') }}
            </div>
        @endif
    </div>
@endsection
