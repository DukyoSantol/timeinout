@extends('layouts.app')

@section('title', 'MGB-XI Online Time In/Out Form')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-4 lg:gap-6">
        <!-- Left Panel - Main Form -->
        <div class="xl:col-span-2">
            <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6">
        <!-- System Time Display -->
        <div class="mb-4 sm:mb-6 bg-gradient-to-r from-blue-500 to-blue-600 border-l-4 border-blue-400 p-3 sm:p-4 rounded-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-blue-100">Current System Time</p>
                    <p id="systemTime" class="text-lg sm:text-2xl font-bold text-white">
                        {{ \Carbon\Carbon::now('Asia/Manila')->format('l, F j, Y h:i:s A') }}
                    </p>
                </div>
                <div class="text-2xl sm:text-4xl">🕐</div>
            </div>
        </div>

        @if(auth()->check())
        <div class="mb-4 sm:mb-6 bg-green-50 border-l-4 border-green-500 p-3 sm:p-4 rounded-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold">👤</span>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-xs sm:text-sm text-gray-600">Welcome!</p>
                    <p class="text-base sm:text-lg font-bold text-gray-800">{{ auth()->user()->name }}</p>
                    <p class="text-xs sm:text-sm text-gray-500">{{ auth()->user()->position }} - {{ auth()->user()->division }}</p>
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

                        <!-- Notes Display -->
                        @if($latestRecord->notes)
                            <div class="mt-4 bg-yellow-50 p-3 rounded-lg border border-yellow-300">
                                <div class="flex items-start">
                                    <span class="text-lg mr-2">📝</span>
                                    <div>
                                        <span class="text-sm font-semibold text-yellow-800">Notes:</span>
                                        <p class="text-sm text-yellow-700 mt-1">{{ $latestRecord->notes }}</p>
                                    </div>
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
                    <div class="mb-4 sm:mb-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                            <h3 class="text-lg sm:text-xl font-bold text-gray-800 flex items-center mb-2 sm:mb-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Time Tracking
                            </h3>
                            <a href="{{ route('user.time-records') }}" class="btn-elegant flex items-center justify-center space-x-2 px-3 sm:px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 font-semibold rounded-lg text-xs sm:text-sm transition-all duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span>My Records</span>
                            </a>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <!-- Morning Session -->
                            <div class="bg-gradient-to-br from-green-50 to-green-100 p-4 sm:p-6 rounded-xl border border-green-200 shadow-sm hover:shadow-lg transition-all duration-300">
                                <h4 class="text-base sm:text-lg font-bold text-green-800 mb-3 sm:mb-4 flex items-center">
                                    <span class="text-xl sm:text-2xl mr-2">🌅</span> Morning Session
                                </h4>
                                <div class="grid grid-cols-2 gap-2 sm:gap-3">
                                    <button 
                                        type="button"
                                        onclick="openTargetModal()"
                                        {{ !$canMorningTimeIn ? 'disabled' : '' }}
                                        class="btn-elegant btn-glow-green flex items-center justify-center px-3 sm:px-4 py-3 sm:py-4 {{ $canMorningTimeIn ? 'bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700' : 'bg-gray-400 cursor-not-allowed' }} text-white font-bold rounded-lg transition-all duration-300 text-sm sm:text-base"
                                    >
                                        <span class="mr-1 sm:mr-2">🕐</span> <span class="hidden xs:inline">Morning </span>Time In
                                    </button>
                                    <button 
                                        type="submit" 
                                        name="action" 
                                        value="morning_time_out"
                                        {{ !$canMorningTimeOut ? 'disabled' : '' }}
                                        class="btn-elegant btn-glow-orange flex items-center justify-center px-3 sm:px-4 py-3 sm:py-4 {{ $canMorningTimeOut ? 'bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700' : 'bg-gray-400 cursor-not-allowed' }} text-white font-bold rounded-lg transition-all duration-300 text-sm sm:text-base"
                                    >
                                        <span class="mr-1 sm:mr-2">🕕</span> <span class="hidden xs:inline">Morning </span>Time Out
                                    </button>
                                </div>
                            </div>

                            <!-- Afternoon Session -->
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 sm:p-6 rounded-xl border border-blue-200 shadow-sm hover:shadow-lg transition-all duration-300">
                                <h4 class="text-base sm:text-lg font-bold text-blue-800 mb-3 sm:mb-4 flex items-center">
                                    <span class="text-xl sm:text-2xl mr-2">🌆</span> Afternoon Session
                                </h4>
                                <div class="grid grid-cols-2 gap-2 sm:gap-3">
                                    <button 
                                        type="submit" 
                                        name="action" 
                                        value="afternoon_time_in"
                                        {{ !$canAfternoonTimeIn ? 'disabled' : '' }}
                                        class="btn-elegant btn-glow-blue flex items-center justify-center px-3 sm:px-4 py-3 sm:py-4 {{ $canAfternoonTimeIn ? 'bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700' : 'bg-gray-400 cursor-not-allowed' }} text-white font-bold rounded-lg transition-all duration-300 text-sm sm:text-base"
                                    >
                                        <span class="mr-1 sm:mr-2">🕐</span> <span class="hidden xs:inline">Afternoon </span>Time In
                                    </button>
                                    <button 
                                        type="button"
                                        onclick="openAccomplishmentModal()"
                                        {{ !$canAfternoonTimeOut ? 'disabled' : '' }}
                                        class="btn-elegant btn-glow-purple flex items-center justify-center px-3 sm:px-4 py-3 sm:py-4 {{ $canAfternoonTimeOut ? 'bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700' : 'bg-gray-400 cursor-not-allowed' }} text-white font-bold rounded-lg transition-all duration-300 text-sm sm:text-base"
                                    >
                                        <span class="mr-1 sm:mr-2">🕕</span> <span class="hidden xs:inline">Afternoon </span>Time Out
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

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
</div>

<!-- Target Modal -->
<div id="targetModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl p-6 m-4 max-w-md w-full shadow-2xl">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-green-700 flex items-center">
                <span class="text-2xl mr-2">🎯</span> Target/Work for the Day
            </h3>
            <button onclick="closeTargetModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <form action="{{ route('time-records.store') }}" method="POST" id="targetForm">
            @csrf
            <input type="hidden" name="action" value="morning_time_in">
            <div class="mb-4">
                <label for="target" class="block text-sm font-medium text-gray-700 mb-2">
                    What are your targets/work for today?
                </label>
                <textarea 
                    id="target" 
                    name="target" 
                    rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                    placeholder="Enter your targets/work for the day..."
                    required
                ></textarea>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeTargetModal()" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold rounded-lg shadow transition-colors">
                    <span class="mr-2">🕐</span> Time In
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Accomplishment Modal -->
<div id="accomplishmentModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl p-6 m-4 max-w-md w-full shadow-2xl">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-purple-700 flex items-center">
                <span class="text-2xl mr-2">✅</span> Accomplishment of the Day
            </h3>
            <button onclick="closeAccomplishmentModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <form action="{{ route('time-records.store') }}" method="POST" id="accomplishmentForm">
            @csrf
            <input type="hidden" name="action" value="afternoon_time_out">
            <div class="mb-4">
                <label for="accomplishment" class="block text-sm font-medium text-gray-700 mb-2">
                    What did you accomplish today?
                </label>
                <textarea 
                    id="accomplishment" 
                    name="accomplishment" 
                    rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    placeholder="Enter your accomplishments for the day..."
                    required
                ></textarea>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeAccomplishmentModal()" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white font-semibold rounded-lg shadow transition-colors">
                    <span class="mr-2">🕕</span> Time Out
                </button>
            </div>
        </form>
    </div>
</div>

<script>
(function() {
    'use strict';
    
    const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    
    function formatTime(date) {
        const dayName = days[date.getDay()];
        const monthName = months[date.getMonth()];
        const dateNum = date.getDate();
        const year = date.getFullYear();
        
        let hours = date.getHours();
        const minutes = date.getMinutes().toString().padStart(2, '0');
        const seconds = date.getSeconds().toString().padStart(2, '0');
        const ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12;
        
        return dayName + ', ' + monthName + ' ' + dateNum + ', ' + year + ' ' + hours + ':' + minutes + ':' + seconds + ' ' + ampm;
    }
    
    function updateTime() {
        const element = document.getElementById('systemTime');
        if (element) {
            const now = new Date();
            element.textContent = formatTime(now);
        }
    }
    
    updateTime();
    setInterval(updateTime, 1000);
})();

// Modal Functions
let pendingAction = null;

function openTargetModal() {
    fetch('{{ route("csrf.token") }}')
        .then(response => response.json())
        .then(data => {
            document.querySelector('#targetForm input[name="_token"]').value = data.token;
        });
    pendingAction = 'target';
    const modal = document.getElementById('targetModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.classList.add('overflow-hidden');
}

function closeTargetModal() {
    const modal = document.getElementById('targetModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.classList.remove('overflow-hidden');
}

function openAccomplishmentModal() {
    fetch('{{ route("csrf.token") }}')
        .then(response => response.json())
        .then(data => {
            document.querySelector('#accomplishmentForm input[name="_token"]').value = data.token;
        });
    pendingAction = 'accomplishment';
    const modal = document.getElementById('accomplishmentModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.classList.add('overflow-hidden');
}

function closeAccomplishmentModal() {
    const modal = document.getElementById('accomplishmentModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.classList.remove('overflow-hidden');
}

// Close modal on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeTargetModal();
        closeAccomplishmentModal();
    }
});

// Close modal on overlay click
document.getElementById('targetModal').addEventListener('click', function(e) {
    if (e.target === this) closeTargetModal();
});

document.getElementById('accomplishmentModal').addEventListener('click', function(e) {
    if (e.target === this) closeAccomplishmentModal();
});

// Handle form submissions with CSRF refresh
document.getElementById('targetForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    fetch('{{ route("csrf.token") }}')
        .then(response => response.json())
        .then(data => {
            document.querySelector('#targetForm input[name="_token"]').value = data.token;
            document.getElementById('targetForm').submit();
        })
        .catch(error => {
            document.getElementById('targetForm').submit();
        });
});

document.getElementById('accomplishmentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    fetch('{{ route("csrf.token") }}')
        .then(response => response.json())
        .then(data => {
            document.querySelector('#accomplishmentForm input[name="_token"]').value = data.token;
            document.getElementById('accomplishmentForm').submit();
        })
        .catch(error => {
            document.getElementById('accomplishmentForm').submit();
        });
});
</script>
@endsection
