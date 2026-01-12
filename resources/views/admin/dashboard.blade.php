@extends('layouts.app')

@section('title', 'Admin Dashboard - MGB-XI')

@section('content')
<div class="space-y-6">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Admin Dashboard</h2>
        
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold">👥</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Total Today</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalToday ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-green-50 border-l-4 border-green-500 p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold">⏱️</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Active Now</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalActive ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-purple-50 border-l-4 border-purple-500 p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold">📊</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Total Hours Today</p>
                        <p class="text-2xl font-bold text-gray-800">{{ number_format($totalHoursToday ?? 0, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Search and Filter Section -->
        <div class="bg-gray-50 p-4 rounded-lg mb-6">
            <form action="{{ route('admin.dashboard') }}" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search by Name</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search name..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="date_from" class="block text-sm font-medium text-gray-700 mb-1">Date From</label>
                    <input type="date" id="date_from" name="date_from" value="{{ request('date_from') ?? now()->format('Y-m-d') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="date_to" class="block text-sm font-medium text-gray-700 mb-1">Date To</label>
                    <input type="date" id="date_to" name="date_to" value="{{ request('date_to') ?? now()->format('Y-m-d') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="division" class="block text-sm font-medium text-gray-700 mb-1">Division</label>
                    <select id="division" name="division" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Divisions</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division }}" {{ request('division') == $division ? 'selected' : '' }}>{{ $division }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="flex items-end space-x-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                        🔍 Search
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 text-sm">
                        ↻ Reset
                    </a>
                </div>
            </form>
            
            <!-- Export Section - Separate Form -->
            <div class="mt-4 pt-4 border-t border-gray-200">
                <form action="{{ route('admin.export') }}" method="GET" class="inline">
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm">
                        📊 Export Excel
                    </button>
                </form>
                <a href="{{ route('admin.view.csv') }}" class="ml-2 px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 text-sm">
                    👁️ View CSV
                </a>
                <a href="{{ route('admin.simple.export') }}" class="ml-2 px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700 text-sm">
                    📄 Simple Export
                </a>
            </div>
        </div>

        <!-- Today's Records Table -->
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Today's Records ({{ ($todayRecords ?? collect())->count() }})</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Division</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Morning Time In</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Morning Time Out</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Afternoon Time In</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Afternoon Time Out</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Hours</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse(($todayRecords ?? collect()) as $record)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $record->full_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $record->position }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $record->division }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $record->morning_time_in ? $record->morning_time_in->format('H:i:s') : '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $record->morning_time_out ? $record->morning_time_out->format('H:i:s') : '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $record->afternoon_time_in ? $record->afternoon_time_in->format('H:i:s') : '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $record->afternoon_time_out ? $record->afternoon_time_out->format('H:i:s') : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $record->total_hours ? number_format($record->total_hours, 2) : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.time-records.edit', $record->id) }}" class="inline-flex items-center text-blue-600 hover:text-blue-900" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    @if($record->user_id)
                                        <a href="{{ route('admin.users.change-password', $record->user_id) }}" class="inline-flex items-center text-green-600 hover:text-green-900" title="Change Password">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2h2l5.257 5.257A6 6 0 1121 9z"></path>
                                            </svg>
                                        </a>
                                    @endif
                                    <form action="{{ route('admin.time-records.destroy', $record->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this record?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center text-red-600 hover:text-red-900" title="Delete">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                    No records found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
