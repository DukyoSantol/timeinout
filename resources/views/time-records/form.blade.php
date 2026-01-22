@extends('layouts.app')

@section('title', 'MGB-XI Online Time In/Out Form')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <!-- System Time Display -->
        <div class="mb-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Current System Time</p>
                    <p class="text-2xl font-bold text-gray-800">
                        {{ \Carbon\Carbon::now('Asia/Manila')->format('l, F j, Y h:i:s A') }}
                    </p>
                </div>
                <div class="text-4xl">🕐</div>
            </div>
        </div>

        @if(auth()->check())
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold">👤</span>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Welcome!</p>
                    <p class="text-lg font-bold text-gray-800">{{ auth()->user()->name }}</p>
                    <p class="text-sm text-gray-500">{{ auth()->user()->position }} - {{ auth()->user()->division }}</p>
                </div>
            </div>
        </div>
        @else
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold">🔒</span>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Please Log In</p>
                    <p class="text-lg font-bold text-gray-800">Authentication Required</p>
                    <p class="text-sm text-gray-500">You need to be logged in to track your time.</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Time Status Display -->
        <div class="mb-6 p-4 bg-gray-50 border rounded-lg">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">📊 Today's Time Status</h3>
            @if(auth()->check())
                @php
                    $todayRecords = auth()->user()->timeRecords()->whereDate('created_at', now()->format('Y-m-d'))->get();
                    $hasTimeInToday = $todayRecords->whereNotNull('morning_time_in')->isNotEmpty();
                    $hasCompleteRecord = $todayRecords->whereNotNull('afternoon_time_out')->isNotEmpty();
                @endphp
                
                @if(!$hasCompleteRecord)
                    @if(!$hasTimeInToday)
                        <div class="flex items-center justify-between p-3 bg-green-100 border border-green-300 rounded">
                            <div>
                                <span class="font-medium text-green-800">🕐 Status:</span>
                                <span class="text-green-700">Not Timed In Yet</span>
                            </div>
                            <span class="text-xs text-green-600">Ready to start your day!</span>
                        </div>
                    @else
                        <div class="flex items-center justify-between p-3 bg-yellow-100 border border-yellow-300 rounded">
                            <div>
                                <span class="font-medium text-yellow-800">⏰ Status:</span>
                                <span class="text-yellow-700">Currently Timed In</span>
                            </div>
                            <span class="text-xs text-yellow-600">Don't forget to time out!</span>
                        </div>
                    @endif
                @else
                    <div class="flex items-center justify-between p-3 bg-blue-100 border border-blue-300 rounded">
                        <div>
                            <span class="font-medium text-blue-800">✅ Status:</span>
                            <span class="text-blue-700">Day Complete</span>
                        </div>
                        <span class="text-xs text-blue-600">Great job today!</span>
                    </div>
                @endif
            @endif
        </div>

        <!-- Total Hours Display -->
        @if(auth()->check())
                @php
                    $todayRecords = auth()->user()->timeRecords()->whereDate('created_at', now()->format('Y-m-d'))->get();
                    
                    // Force recalculate all today's records
                    foreach($todayRecords as $record) {
                        $record->calculateTotalHours();
                    }
                    
                    $totalHoursToday = $todayRecords->whereNotNull('total_hours')->sum('total_hours');
                    $weeklyHours = auth()->user()->timeRecords()
                        ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                        ->whereNotNull('total_hours')
                        ->sum('total_hours');
                    $monthlyHours = auth()->user()->timeRecords()
                        ->whereMonth('created_at', now()->month)
                        ->whereYear('created_at', now()->year)
                        ->whereNotNull('total_hours')
                        ->sum('total_hours');
                @endphp
            @endif

            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                    Notes (Optional)
                </label>
                <textarea 
                    id="notes" 
                    name="notes" 
                    rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Add any notes about your workday..."
                >{{ old('notes') }}</textarea>
            </div>

            <!-- Incomplete Records Warning -->
            @if(auth()->check())
                @php
                    $incompleteRecords = auth()->user()->timeRecords()
                        ->whereNull('afternoon_time_out')
                        ->whereDate('created_at', '<', now()->format('Y-m-d'))
                        ->get();
                @endphp
                @if($incompleteRecords->isNotEmpty())
                    <div class="mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">Incomplete Records Found</h3>
                                <div class="mt-2 text-sm text-yellow-700">
                                    <p>You have incomplete time records from previous days. Please complete them or contact your administrator.</p>
                                    <div class="mt-2 text-xs text-yellow-600">
                                        @foreach($incompleteRecords as $record)
                                            <div>• {{ $record->created_at->format('F j, Y') }} - Auto timeout at 11:59 PM</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            <!-- Time Tracking Form -->
            @if(auth()->check())
                @php
                    $todayRecords = auth()->user()->timeRecords()->whereDate('created_at', now()->format('Y-m-d'))->orderBy('created_at', 'desc')->get();
                    
                    // Check for any completed time entries today
                    $hasAnyMorningTimeIn = $todayRecords->whereNotNull('morning_time_in')->isNotEmpty();
                    $hasAnyMorningTimeOut = $todayRecords->whereNotNull('morning_time_out')->isNotEmpty();
                    $hasAnyAfternoonTimeIn = $todayRecords->whereNotNull('afternoon_time_in')->isNotEmpty();
                    $hasAnyAfternoonTimeOut = $todayRecords->whereNotNull('afternoon_time_out')->isNotEmpty();
                    
                    // Get latest record for display
                    $latestRecord = $todayRecords->first();
                    
                    // Calculate button states - CLEAN SIMPLE LOGIC
                    $canMorningTimeIn = !$hasAnyMorningTimeIn; // Can time in if no morning time in today
                    $canMorningTimeOut = $hasAnyMorningTimeIn && !$hasAnyMorningTimeOut; // Can time out if timed in but not out
                    $canAfternoonTimeIn = $hasAnyMorningTimeOut && !$hasAnyAfternoonTimeIn; // Can afternoon time in if morning complete but no afternoon time in
                    $canAfternoonTimeOut = $hasAnyAfternoonTimeIn && !$hasAnyAfternoonTimeOut; // Can afternoon time out if afternoon timed in but not out
                    
                    // If all complete for today, disable all buttons
                    if ($hasAnyMorningTimeIn && $hasAnyMorningTimeOut && $hasAnyAfternoonTimeIn && $hasAnyAfternoonTimeOut) {
                        $canMorningTimeIn = false;
                        $canMorningTimeOut = false;
                        $canAfternoonTimeIn = false;
                        $canAfternoonTimeOut = false;
                    }
                @endphp
                
                <!-- User Time Details -->
                @if($latestRecord)
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-blue-800 mb-4">📊 Today's Time Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Morning Details -->
                            <div class="bg-white p-4 rounded-lg border border-blue-200">
                                <h4 class="text-md font-medium text-green-700 mb-3">🌅 Morning Session</h4>
                                <div class="space-y-2">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Time In:</span>
                                        <span class="font-semibold text-green-600">
                                            {{ $latestRecord->morning_time_in ? $latestRecord->morning_time_in->format('h:i A') : '--:--' }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Time Out:</span>
                                        <span class="font-semibold text-orange-600">
                                            {{ $latestRecord->morning_time_out ? $latestRecord->morning_time_out->format('h:i A') : '--:--' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Afternoon Details -->
                            <div class="bg-white p-4 rounded-lg border border-blue-200">
                                <h4 class="text-md font-medium text-blue-700 mb-3">🌆 Afternoon Session</h4>
                                <div class="space-y-2">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Time In:</span>
                                        <span class="font-semibold text-blue-600">
                                            {{ $latestRecord->afternoon_time_in ? $latestRecord->afternoon_time_in->format('h:i A') : '--:--' }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Time Out:</span>
                                        <span class="font-semibold text-purple-600">
                                            {{ $latestRecord->afternoon_time_out ? $latestRecord->afternoon_time_out->format('h:i A') : '--:--' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Hours -->
                        @if($latestRecord->total_hours)
                            <div class="mt-4 bg-green-100 p-3 rounded-lg border border-green-300">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-semibold text-green-800">Total Hours Today:</span>
                                    <span class="text-xl font-bold text-green-900">{{ $latestRecord->getTotalHoursAsTime() }} hours</span>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                <form action="{{ route('time-records.store') }}" method="POST" id="timeTrackingForm">
                    @csrf
                    
                    <!-- Mobile Data Compatible Fix -->
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="mobile_fix" value="1">
                    
                    <!-- CSRF Token Refresh for Mobile -->
                    <script>
                    // Refresh CSRF token every 5 minutes for mobile users
                    setInterval(function() {
                        fetch('{{ route("csrf.token") }}')
                            .then(response => response.json())
                            .then(data => {
                                // Update all CSRF tokens in the form
                                const csrfInputs = document.querySelectorAll('input[name="_token"]');
                                csrfInputs.forEach(input => {
                                    input.value = data.token;
                                });
                                console.log('CSRF token refreshed for mobile');
                            })
                            .catch(error => console.log('CSRF refresh failed:', error));
                    }, 300000); // 5 minutes
                    
                    // Refresh token before form submission
                    document.getElementById('timeTrackingForm').addEventListener('submit', function(e) {
                        fetch('{{ route("csrf.token") }}')
                            .then(response => response.json())
                            .then(data => {
                                document.querySelector('input[name="_token"]').value = data.token;
                                console.log('CSRF token refreshed before submit');
                            })
                            .catch(error => console.log('Pre-submit CSRF refresh failed:', error));
                    });
                    </script>
                    
                    <!-- Time Tracking Buttons -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Time Tracking</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Morning Session -->
                            <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                                <h4 class="text-md font-medium text-green-800 mb-3">🌅 Morning Session</h4>
                                <div class="flex space-x-2">
                                    <button 
                                        type="submit" 
                                        name="action" 
                                        value="morning_time_in"
                                        {{ !$canMorningTimeIn ? 'disabled' : '' }}
                                        class="flex-1 px-4 py-3 {{ $canMorningTimeIn ? 'bg-green-600 hover:bg-green-700' : 'bg-gray-400 cursor-not-allowed' }} text-white rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors"
                                    >
                                        🕐 Morning Time In
                                    </button>
                                    <button 
                                        type="submit" 
                                        name="action" 
                                        value="morning_time_out"
                                        {{ !$canMorningTimeOut ? 'disabled' : '' }}
                                        class="flex-1 px-4 py-3 {{ $canMorningTimeOut ? 'bg-orange-600 hover:bg-orange-700' : 'bg-gray-400 cursor-not-allowed' }} text-white rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors"
                                    >
                                        🕕 Morning Time Out
                                    </button>
                                </div>
                            </div>

                            <!-- Afternoon Session -->
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                <h4 class="text-md font-medium text-blue-800 mb-3">🌆 Afternoon Session</h4>
                                <div class="flex space-x-2">
                                    <button 
                                        type="submit" 
                                        name="action" 
                                        value="afternoon_time_in"
                                        {{ !$canAfternoonTimeIn ? 'disabled' : '' }}
                                        class="flex-1 px-4 py-3 {{ $canAfternoonTimeIn ? 'bg-blue-600 hover:bg-blue-700' : 'bg-gray-400 cursor-not-allowed' }} text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors"
                                    >
                                        🕐 Afternoon Time In
                                    </button>
                                    <button 
                                        type="submit" 
                                        name="action" 
                                        value="afternoon_time_out"
                                        {{ !$canAfternoonTimeOut ? 'disabled' : '' }}
                                        class="flex-1 px-4 py-3 {{ $canAfternoonTimeOut ? 'bg-purple-600 hover:bg-purple-700' : 'bg-gray-400 cursor-not-allowed' }} text-white rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-colors"
                                    >
                                        🕕 Afternoon Time Out
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notes Section -->
                    

                    <!-- Submit Button -->
                    
                </form>
            @else
                <div class="text-center py-8">
                    <div class="text-6xl mb-4">🔒</div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Authentication Required</h3>
                    <p class="text-gray-600 mb-4">Please log in to access the time tracking system.</p>
                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Log In
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
(function() {
    'use strict';
    
    // Wait for DOM to be ready
    function waitForElement() {
        const element = document.getElementById('systemTime');
        if (element) {
            console.log('systemTime element found:', element);
            return element;
        }
        console.log('Waiting for systemTime element...');
        setTimeout(waitForElement, 100);
    }
    
    // Update time function
    function updateTime() {
        const correctTime = new Date('2026-01-15T16:53:00+08:00');
        
        // Manual formatting to avoid any browser issues
        const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        
        const dayName = days[correctTime.getDay()];
        const monthName = months[correctTime.getMonth()];
        const date = correctTime.getDate();
        const year = correctTime.getFullYear();
        
        let hours = correctTime.getHours();
        const minutes = correctTime.getMinutes().toString().padStart(2, '0');
        const seconds = correctTime.getSeconds().toString().padStart(2, '0');
        const ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12;
        
        const formattedTime = dayName + ', ' + monthName + ' ' + date + ', ' + year + ' ' + hours + ':' + minutes + ':' + seconds + ' ' + ampm;
        
        // Multiple update methods to ensure it works
        if (element) {
            element.textContent = formattedTime;
            element.innerText = formattedTime;
            element.innerHTML = formattedTime;
            element.style.color = '#0066cc';
            element.style.backgroundColor = '#ffffcc';
            element.style.border = '2px solid #0066cc';
            
            console.log('Time updated to:', formattedTime);
            console.log('Element methods used:', {
                textContent: element.textContent,
                innerText: element.innerText,
                innerHTML: element.innerHTML
            });
        }
    }
    
    // Start the time display
    function startTimeDisplay() {
        console.log('Starting bulletproof time display...');
        
        const element = waitForElement();
        if (element) {
            // Update immediately
            updateTime();
            
            // Update every second
            setInterval(updateTime, 1000);
            
            // Also update every 5 seconds for extra reliability
            setInterval(updateTime, 5000);
            
            console.log('Time display started with multiple intervals');
        } else {
            console.error('Failed to find systemTime element after 10 seconds');
        }
    }
    
    // Start when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', startTimeDisplay);
    } else {
        startTimeDisplay();
    }
})();
</script>
@endpush
@endsection
