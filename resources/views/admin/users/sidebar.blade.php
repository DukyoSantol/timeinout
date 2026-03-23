@extends('layouts.app')

@section('title', 'User Records - MGB-XI Admin')

@php
$selectedUser = $selectedUser ?? null;
$selectedUserRecords = $selectedUserRecords ?? collect();
$totalHours = $totalHours ?? 0;
@endphp

@section('content')
<div class="flex flex-col lg:flex-row gap-4">
    <!-- Left Sidebar - User List -->
    <div class="w-full lg:w-80 flex-shrink-0">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden sticky top-20">
            <!-- Sidebar Header -->
            <div class="bg-gradient-to-r from-purple-600 to-purple-700 p-4">
                <h2 class="text-white font-bold text-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    All Users
                </h2>
                <p class="text-purple-200 text-xs mt-1">{{ $users->total() }} total users</p>
            </div>
            
            <!-- Search Box -->
            <div class="p-3 border-b border-gray-200">
                <form action="{{ route('admin.users.sidebar') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..." 
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </form>
            </div>
            
            <!-- User List -->
            <div class="overflow-y-auto" style="max-height: calc(100vh - 280px);">
                @forelse($users as $user)
                <a href="{{ route('admin.users.sidebar', ['user_id' => $user->id, 'search' => request('search')]) }}" 
                   class="block px-4 py-3 border-b border-gray-100 hover:bg-purple-50 transition-colors {{ $selectedUser && $selectedUser->id == $user->id ? 'bg-purple-100 border-l-4 border-l-purple-600' : '' }}">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm mr-3">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-gray-900 text-sm truncate {{ $selectedUser && $selectedUser->id == $user->id ? 'text-purple-700' : '' }}">
                                {{ $user->name }}
                            </p>
                            <p class="text-xs text-gray-500 truncate">{{ $user->position ?? 'No Position' }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ $user->division ?? 'No Division' }}</p>
                        </div>
                        @if($selectedUser && $selectedUser->id == $user->id)
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        @endif
                    </div>
                </a>
                @empty
                <div class="px-4 py-8 text-center text-gray-500">
                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <p class="text-sm">No users found</p>
                </div>
                @endforelse
            </div>
            
            <!-- Pagination for Users -->
            @if($users->hasPages())
            <div class="p-3 border-t border-gray-200 bg-gray-50">
                {{ $users->links() }}
            </div>
            @endif
        </div>
    </div>
    
    <!-- Right Panel - User Records -->
    <div class="flex-1">
        @if($selectedUser)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- User Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-4 sm:p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="flex items-center">
                        <div class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center text-white font-bold text-xl mr-4">
                            {{ strtoupper(substr($selectedUser->name, 0, 2)) }}
                        </div>
                        <div>
                            <h1 class="text-xl sm:text-2xl font-bold text-white">{{ $selectedUser->name }}</h1>
                            <p class="text-blue-200 text-sm">{{ $selectedUser->position ?? 'No Position' }} - {{ $selectedUser->division ?? 'No Division' }}</p>
                            <p class="text-blue-300 text-xs">{{ $selectedUser->email }}</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.users.edit', $selectedUser->id) }}" class="btn-elegant flex items-center space-x-2 px-4 py-2 bg-white/20 hover:bg-white/30 border border-white/30 text-white font-bold rounded-lg transition-all duration-300 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            <span>Edit</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 sm:p-6 bg-gray-50 border-b border-gray-200">
                <div class="bg-white rounded-lg p-4 shadow-sm border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-xs">Total Records</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $selectedUserRecords->total() }}</p>
                        </div>
                        <div class="bg-green-100 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-4 shadow-sm border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-xs">Total Hours</p>
                            <p class="text-2xl font-bold text-gray-800">{{ number_format($totalHours, 2) }}</p>
                        </div>
                        <div class="bg-blue-100 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-4 shadow-sm border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-xs">Completed Days</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $selectedUserRecords->where('status', 'COMPLETED')->count() }}</p>
                        </div>
                        <div class="bg-purple-100 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="p-4 sm:p-6 border-b border-gray-200">
                <h3 class="text-sm font-bold text-gray-700 mb-3 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                    Filter Records
                </h3>
                <form action="{{ route('admin.users.sidebar') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                    <input type="hidden" name="user_id" value="{{ $selectedUser->id }}">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Date From</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Date To</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Month</label>
                        <input type="month" name="month" value="{{ request('month') }}" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="btn-elegant btn-glow-blue flex-1 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 text-sm">
                            Filter
                        </button>
                        <a href="{{ route('admin.users.sidebar', ['user_id' => $selectedUser->id, 'search' => request('search')]) }}" class="px-3 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold rounded-lg transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </a>
                    </div>
                </form>
            </div>

            <!-- Records List -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Date</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Morning In</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Morning Out</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Afternoon In</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Afternoon Out</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Hours</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Target</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Accomplishment</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($selectedUserRecords as $record)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 text-sm font-semibold text-gray-900 whitespace-nowrap">{{ $record->created_at->format('M j, Y') }}</td>
                            <td class="px-4 py-3"><span class="inline-flex px-2 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 whitespace-nowrap">{{ $record->morning_time_in ? $record->morning_time_in->format('h:i A') : '--:--' }}</span></td>
                            <td class="px-4 py-3"><span class="inline-flex px-2 py-1 rounded-full text-xs font-bold {{ $record->morning_time_out ? 'bg-orange-100 text-orange-800' : 'bg-gray-100 text-gray-600' }} whitespace-nowrap">{{ $record->morning_time_out ? $record->morning_time_out->format('h:i A') : '--:--' }}</span></td>
                            <td class="px-4 py-3"><span class="inline-flex px-2 py-1 rounded-full text-xs font-bold {{ $record->afternoon_time_in ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-600' }} whitespace-nowrap">{{ $record->afternoon_time_in ? $record->afternoon_time_in->format('h:i A') : '--:--' }}</span></td>
                            <td class="px-4 py-3"><span class="inline-flex px-2 py-1 rounded-full text-xs font-bold {{ $record->afternoon_time_out ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-600' }} whitespace-nowrap">{{ $record->afternoon_time_out ? $record->afternoon_time_out->format('h:i A') : '--:--' }}</span></td>
                            <td class="px-4 py-3"><span class="inline-flex px-2 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-800 whitespace-nowrap">{{ $record->total_hours ? $record->getTotalHoursAsTime() : '--' }}</span></td>
                            <td class="px-4 py-3 max-w-xs">
                                @if($record->target)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800" title="{{ $record->target }}">
                                        {{ Str::limit($record->target, 15) }}
                                    </span>
                                @else
                                    <span class="text-gray-400 text-xs">--</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 max-w-xs">
                                @if($record->accomplishment)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800" title="{{ $record->accomplishment }}">
                                        {{ Str::limit($record->accomplishment, 15) }}
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
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-1">
                                    <a href="{{ route('admin.time-records.edit', $record->id) }}" class="p-1.5 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded transition-all duration-200" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.time-records.destroy', $record->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-red-600 hover:text-red-800 hover:bg-red-50 rounded transition-all duration-200" title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="px-4 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <div class="bg-gray-100 p-3 rounded-full mb-3">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm">No records found for this user</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($selectedUserRecords->hasPages())
            <div class="bg-gray-50 px-4 py-3 border-t border-gray-200">
                {{ $selectedUserRecords->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
        @else
        <!-- Empty State - No User Selected -->
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <div class="w-20 h-20 mx-auto bg-purple-100 rounded-full flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Select a User</h2>
            <p class="text-gray-500 mb-6">Click on a user from the left panel to view their time records</p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('admin.users.index') }}" class="px-6 py-3 bg-purple-600 text-white font-bold rounded-lg hover:bg-purple-700 transition-colors">
                    Go to User Management
                </a>
                <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300 transition-colors">
                    Back to Dashboard
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
