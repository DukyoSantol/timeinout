@extends('layouts.app')

@section('title', 'MGB-XI Time Tracking - Simple')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <div class="bg-white shadow-lg rounded-lg">
        <div class="p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">MGB-XI Time Tracking System</h1>
            
            @if(auth()->check())
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-2xl font-bold">👤</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ auth()->user()->name }}</h2>
                        <p class="text-gray-600">{{ auth()->user()->position }} - {{ auth()->user()->division }}</p>
                    </div>
                </div>

                <!-- Time Tracking Buttons -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6 text-center">Time Tracking</h3>
                    
                    @php
                        $todayRecords = auth()->user()->timeRecords()->whereDate('created_at', now()->format('Y-m-d'))->get();
                        $hasAnyMorningTimeIn = $todayRecords->whereNotNull('morning_time_in')->isNotEmpty();
                        $hasAnyMorningTimeOut = $todayRecords->whereNotNull('morning_time_out')->isNotEmpty();
                        
                        $canMorningTimeIn = true; // Always allow morning time in
                        $canMorningTimeOut = $hasAnyMorningTimeIn; // Can time out if there's time in
                    @endphp
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl mx-auto">
                        <!-- Morning Time In -->
                        <div class="bg-green-100 p-6 rounded-lg border-2 border-green-300">
                            <h4 class="text-lg font-medium text-green-800 mb-4 text-center">🌅 Morning Time In</h4>
                            <form action="{{ route('time-records.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <button 
                                    type="submit" 
                                    name="action" 
                                    value="morning_time_in"
                                    class="w-full px-6 py-4 bg-green-600 text-white text-lg font-semibold rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors {{ $canMorningTimeIn ? 'opacity-50 cursor-not-allowed' : '' }}"
                                    {{ $canMorningTimeIn ? 'disabled' : '' }}
                                >
                                    🕐 Morning Time In
                                </button>
                            </form>
                        </div>

                        <!-- Morning Time Out -->
                        <div class="bg-orange-100 p-6 rounded-lg border-2 border-orange-300">
                            <h4 class="text-lg font-medium text-orange-800 mb-4 text-center">🌇 Morning Time Out</h4>
                            <form action="{{ route('time-records.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <button 
                                    type="submit" 
                                    name="action" 
                                    value="morning_time_out"
                                    class="w-full px-6 py-4 bg-orange-600 text-white text-lg font-semibold rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors {{ $canMorningTimeOut ? 'opacity-50 cursor-not-allowed' : '' }}"
                                    {{ $canMorningTimeOut ? 'disabled' : '' }}
                                >
                                    🕕 Morning Time Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Guest Message -->
                <div class="text-center py-8">
                    <div class="text-6xl mb-4">🔒</div>
                    <h3 class="text-xl font-semibold text-gray-600">Authentication Required</h3>
                    <p class="text-gray-500 mb-4">Please log in to access the time tracking system.</p>
                    <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        Log In
                    </a>
                </div>
            @else
                <div class="text-center py-8">
                    <div class="text-6xl mb-4">🔒</div>
                    <h3 class="text-xl font-semibold text-gray-600">Authentication Required</h3>
                    <p class="text-gray-500 mb-4">Please log in to access the time tracking system.</p>
                    <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        Log In
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
