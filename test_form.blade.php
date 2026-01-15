@extends('layouts.app')

@section('title', 'Test Form')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Test Time Tracking Form</h1>
        
        <form action="{{ route('time-records.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Time Tracking</h3>
                
                @if(auth()->check())
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
                            <button type="submit" name="action" value="afternoon_time_out" class="px-4 py-2 bg-red-600 text-white rounded">
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
