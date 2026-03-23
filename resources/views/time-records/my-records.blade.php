@extends('layouts.app')

@section('title', 'My Time Records - MGB-XI')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-4 sm:p-6 mb-4 sm:mb-6 shadow-lg">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center">
                <div class="bg-white/20 p-2 sm:p-3 rounded-xl mr-3">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-white">My Time Records</h1>
                    <p class="text-blue-200 text-xs sm:text-sm">Track and monitor your attendance</p>
                </div>
            </div>
            <a href="{{ route('time-records.form') }}" class="btn-elegant flex items-center space-x-2 px-4 py-2 bg-white/20 hover:bg-white/30 border border-white/30 text-white font-bold rounded-lg transition-all duration-300 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Time In/Out</span>
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4 sm:mb-6">
        <div class="bg-white rounded-xl p-4 sm:p-6 shadow-lg border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-xs sm:text-sm">Total Records</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-800">{{ $totalRecords }}</p>
                </div>
                <div class="bg-green-100 p-2 sm:p-3 rounded-xl">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-4 sm:p-6 shadow-lg border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-xs sm:text-sm">Total Hours</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-800">{{ number_format($totalHours, 2) }}</p>
                </div>
                <div class="bg-blue-100 p-2 sm:p-3 rounded-xl">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-4 sm:p-6 shadow-lg border-l-4 border-purple-500 sm:col-span-2 lg:col-span-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-xs sm:text-sm">This Month</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-800">{{ $records->total() }}</p>
                </div>
                <div class="bg-purple-100 p-2 sm:p-3 rounded-xl">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-xl p-4 sm:p-6 shadow-lg mb-4 sm:mb-6">
        <h3 class="text-base sm:text-lg font-bold text-gray-800 mb-3 sm:mb-4 flex items-center">
            <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
            </svg>
            Filter Records
        </h3>
        <form action="{{ route('user.time-records') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Date From</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
            </div>
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Date To</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
            </div>
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Month</label>
                <input type="month" name="month" value="{{ request('month') }}" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="btn-elegant btn-glow-blue flex-1 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 text-sm">
                    Filter
                </button>
                <a href="{{ route('user.time-records') }}" class="px-3 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold rounded-lg transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </a>
            </div>
        </form>
    </div>

    <!-- Time Records List (Cards on Mobile, Table on Desktop) -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        
                <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-600 to-blue-700">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-bold text-white uppercase">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-white uppercase">Morning In</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-white uppercase">Morning Out</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-white uppercase">Afternoon In</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-white uppercase">Afternoon Out</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-white uppercase">Hours</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-white uppercase">Target</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-white uppercase">Accomplishment</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-white uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($records as $record)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 text-sm font-semibold text-gray-900">{{ $record->created_at->format('M j, Y') }}</td>
                        <td class="px-4 py-3"><span class="inline-flex px-2 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">{{ $record->morning_time_in ? $record->morning_time_in->format('h:i A') : '--:--' }}</span></td>
                        <td class="px-4 py-3"><span class="inline-flex px-2 py-1 rounded-full text-xs font-bold {{ $record->morning_time_out ? 'bg-orange-100 text-orange-800' : 'bg-gray-100 text-gray-600' }}">{{ $record->morning_time_out ? $record->morning_time_out->format('h:i A') : '--:--' }}</span></td>
                        <td class="px-4 py-3"><span class="inline-flex px-2 py-1 rounded-full text-xs font-bold {{ $record->afternoon_time_in ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-600' }}">{{ $record->afternoon_time_in ? $record->afternoon_time_in->format('h:i A') : '--:--' }}</span></td>
                        <td class="px-4 py-3"><span class="inline-flex px-2 py-1 rounded-full text-xs font-bold {{ $record->afternoon_time_out ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-600' }}">{{ $record->afternoon_time_out ? $record->afternoon_time_out->format('h:i A') : '--:--' }}</span></td>
                        <td class="px-4 py-3"><span class="inline-flex px-2 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-800">{{ $record->total_hours ? $record->getTotalHoursAsTime() : '--' }}</span></td>
                        <td class="px-4 py-3 max-w-xs">
                            @if($record->target)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800" title="{{ $record->target }}">
                                    🎯 {{ Str::limit($record->target, 25) }}
                                </span>
                            @else
                                <span class="text-gray-400 text-xs">--</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 max-w-xs">
                            @if($record->accomplishment)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800" title="{{ $record->accomplishment }}">
                                    ✅ {{ Str::limit($record->accomplishment, 25) }}
                                </span>
                            @else
                                <span class="text-gray-400 text-xs">--</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($record->status === 'COMPLETED')
                                <span class="inline-flex px-2 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">Complete</span>
                            @elseif($record->status === 'TIMED_IN')
                                <span class="inline-flex px-2 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">In Progress</span>
                            @else
                                <span class="inline-flex px-2 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-800">Pending</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-4 py-8 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <div class="bg-gray-100 p-3 rounded-full mb-3">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <p class="text-sm">No records found</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Mobile Card View -->
        <div class="md:hidden divide-y divide-gray-200">
            @forelse($records as $record)
            <div class="p-4">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <p class="text-sm font-bold text-gray-900">{{ $record->created_at->format('M j, Y') }}</p>
                        <p class="text-xs text-gray-500">{{ $record->created_at->format('l') }}</p>
                    </div>
                    @if($record->status === 'COMPLETED')
                        <span class="px-2 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">Complete</span>
                    @elseif($record->status === 'TIMED_IN')
                        <span class="px-2 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">In Progress</span>
                    @else
                        <span class="px-2 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-800">Pending</span>
                    @endif
                </div>
                <div class="grid grid-cols-2 gap-2 text-xs">
                    <div class="bg-green-50 p-2 rounded-lg">
                        <p class="text-gray-500">Morning In</p>
                        <p class="font-bold text-green-700">{{ $record->morning_time_in ? $record->morning_time_in->format('h:i A') : '--:--' }}</p>
                    </div>
                    <div class="bg-orange-50 p-2 rounded-lg">
                        <p class="text-gray-500">Morning Out</p>
                        <p class="font-bold text-orange-700">{{ $record->morning_time_out ? $record->morning_time_out->format('h:i A') : '--:--' }}</p>
                    </div>
                    <div class="bg-blue-50 p-2 rounded-lg">
                        <p class="text-gray-500">Afternoon In</p>
                        <p class="font-bold text-blue-700">{{ $record->afternoon_time_in ? $record->afternoon_time_in->format('h:i A') : '--:--' }}</p>
                    </div>
                    <div class="bg-purple-50 p-2 rounded-lg">
                        <p class="text-gray-500">Afternoon Out</p>
                        <p class="font-bold text-purple-700">{{ $record->afternoon_time_out ? $record->afternoon_time_out->format('h:i A') : '--:--' }}</p>
                    </div>
                </div>
                @if($record->total_hours)
                <div class="mt-2 text-center bg-indigo-50 p-2 rounded-lg">
                    <span class="text-xs font-bold text-indigo-700">Total: {{ $record->getTotalHoursAsTime() }} hours</span>
                </div>
                @endif
                @if($record->target)
                <div class="mt-2 bg-green-50 border border-green-200 p-2 rounded-lg">
                    <p class="text-xs text-green-700 font-medium flex items-center">
                        <span class="mr-1">🎯</span> Target: {{ $record->target }}
                    </p>
                </div>
                @endif
                @if($record->accomplishment)
                <div class="mt-2 bg-purple-50 border border-purple-200 p-2 rounded-lg">
                    <p class="text-xs text-purple-700 font-medium flex items-center">
                        <span class="mr-1">✅</span> Accomplishment: {{ $record->accomplishment }}
                    </p>
                </div>
                @endif
            </div>
            @empty
            <div class="p-8 text-center text-gray-500">
                <div class="flex flex-col items-center">
                    <div class="bg-gray-100 p-3 rounded-full mb-3">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <p class="text-sm">No records found</p>
                </div>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($records->hasPages())
        <div class="bg-gray-50 px-4 py-3 border-t border-gray-200">
            {{ $records->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
