@extends('layouts.app')

@section('title', 'Minimal Test')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Minimal Test Form</h1>
        
        @if(auth()->check())
            <p class="text-green-600">User: {{ auth()->user()->name }}</p>
        @else
            <p class="text-red-600">Guest User</p>
        @endif
        
        <form action="{{ route('time-records.store') }}" method="POST">
            @csrf
            <button type="submit" name="action" value="morning_time_in" class="px-4 py-2 bg-green-600 text-white rounded">
                Morning Time In
            </button>
        </form>
    </div>
</div>
@endsection
