@extends('layouts.app')

@section('title', 'Simple Test Form')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Simple Test Form</h1>
        
        <form action="{{ route('time-records.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Test Time Tracking</h3>
                
                <!-- DEBUG INFO -->
                <div class="bg-yellow-100 border border-yellow-400 rounded p-3 mb-4">
                    <h4 class="text-sm font-bold text-yellow-800">🔍 User Information</h4>
                    @if(auth()->check())
                        @php
                            $todayRecords = auth()->user()->timeRecords()->whereDate('created_at', now()->format('Y-m-d'))->get();
                            $hasMorningTimeIn = $todayRecords->whereNotNull('morning_time_in')->isNotEmpty();
                            $hasMorningTimeOut = $todayRecords->whereNotNull('morning_time_out')->isNotEmpty();
                            $hasAfternoonTimeIn = $todayRecords->whereNotNull('afternoon_time_in')->isNotEmpty();
                            $hasAfternoonTimeOut = $todayRecords->whereNotNull('afternoon_time_out')->isNotEmpty();
                            $hasCompleteRecord = $hasMorningTimeIn && $hasMorningTimeOut && $hasAfternoonTimeIn && $hasAfternoonTimeOut;
                        @endphp
                        <div class="text-xs text-yellow-700">
                            <p><strong>Today's Records:</strong> {{ $todayRecords->count() }}</p>
                            <p><strong>Morning Time In:</strong> {{ $hasMorningTimeIn ? 'YES' : 'NO' }}</p>
                            <p><strong>Morning Time Out:</strong> {{ $hasMorningTimeOut ? 'YES' : 'NO' }}</p>
                            <p><strong>Afternoon Time In:</strong> {{ $hasAfternoonTimeIn ? 'YES' : 'NO' }}</p>
                            <p><strong>Afternoon Time Out:</strong> {{ $hasAfternoonTimeOut ? 'YES' : 'NO' }}</p>
                            <p><strong>Complete Record:</strong> {{ $hasCompleteRecord ? 'YES' : 'NO' }}</p>
                            <p><strong>User ID:</strong> {{ auth()->id() }}</p>
                        </div>
                    @else
                        <div class="text-xs text-yellow-700">
                            <p><strong>Guest User:</strong> No authentication</p>
                        </div>
                    @endif
                </div>
                
                @if(auth()->check())
                    <!-- SIMPLE BUTTONS - NO DISABLED ATTRIBUTES -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-3">
                            <h4 class="text-md font-medium">Morning Session</h4>
                            <div class="flex space-x-2">
                                <button type="submit" name="action" value="morning_time_in" class="px-4 py-2 bg-green-600 text-white rounded">
                                    🌅 Morning Time In
                                </button>
                                <button type="submit" name="action" value="morning_time_out" class="px-4 py-2 bg-orange-600 text-white rounded">
                                    🌇 Morning Time Out
                                </button>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <h4 class="text-md font-medium">Afternoon Session</h4>
                            <div class="flex space-x-2">
                                <button type="submit" name="action" value="afternoon_time_in" class="px-4 py-2 bg-blue-600 text-white rounded">
                                    🌆 Afternoon Time In
                                </button>
                                <button type="submit" name="action" value="afternoon_time_out" class="px-4 py-2 bg-purple-600 text-white rounded">
                                    🌇 Afternoon Time Out
                                </button>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-md font-medium">Guest Time Tracking</h4>
                        <div class="flex space-x-2">
                            <button type="submit" name="action" value="time_in" class="px-4 py-2 bg-green-600 text-white rounded">
                                🕐 Time In
                            </button>
                            <button type="submit" name="action" value="time_out" class="px-4 py-2 bg-red-600 text-white rounded">
                                🕑 Time Out
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection
