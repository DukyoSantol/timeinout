@extends('layouts.app')

@section('title', 'Admin Dashboard - MGB-XI')

@section('content')
<div class="space-y-6">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Admin Dashboard</h2>
        
        <!-- Quick Links -->
        <div class="mb-6 flex flex-wrap gap-3">
            <a href="{{ route('admin.users.sidebar') }}" class="btn-elegant btn-glow-purple flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-purple-500 to-purple-600 text-white font-bold rounded-lg hover:from-purple-600 hover:to-purple-700 transition-all duration-300 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span>All Users Records</span>
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn-elegant flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <span>Manage Users</span>
            </a>
        </div>

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
            
            <!-- Export Section - With Filters -->
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="mb-3">
                    <p class="text-sm text-gray-600 mb-2">📊 Export with current filters:</p>
                    <div class="flex flex-wrap gap-2">
                        <button onclick="exportWithFilters('excel')" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm">
                            📊 Export Excel
                        </button>
                        <button onclick="exportWithFilters('csv')" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 text-sm">
                            📄 View PDF
                        </button>
                        <a href="{{ route('admin.simple.export') }}" class="px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700 text-sm">
                            📄 Simple Export
                        </a>
                    </div>
                </div>
                
                                
                <!-- Current Filter Status -->
                <div class="text-xs text-gray-600 bg-gray-100 p-2 rounded">
                    <strong>Current Filters:</strong>
                    @if(request('search')) <span class="ml-2">🔍 Search: {{ request('search') }}</span> @endif
                    @if(request('date_from')) <span class="ml-2">📅 From: {{ request('date_from') }}</span> @endif
                    @if(request('date_to')) <span class="ml-2">📅 To: {{ request('date_to') }}</span> @endif
                    @if(request('division')) <span class="ml-2">🏢 Division: {{ request('division') }}</span> @endif
                    @if(!request()->hasAny(['search', 'date_from', 'date_to', 'division'])) 
                        <span class="ml-2 text-orange-600">⚠️ No filters applied - will export today's records only</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- JavaScript for Export with Filters -->
        <script>
        function exportWithFilters(type) {
            console.log('Starting export with filters...');
            
            // Get current filter values from URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const dateFrom = urlParams.get('date_from') || '';
            const dateTo = urlParams.get('date_to') || '';
            const division = urlParams.get('division') || '';
            const search = urlParams.get('search') || '';
            
            console.log('Current filter values:', { dateFrom, dateTo, division, search });
            
            // Build export URL with current filters
            let baseUrl;
            if (type === 'excel') {
                baseUrl = '{{ route('admin.export') }}';
            } else {
                baseUrl = '{{ route('admin.view.csv') }}';
            }
            
            const params = new URLSearchParams();
            if (dateFrom) params.append('date_from', dateFrom);
            if (dateTo) params.append('date_to', dateTo);
            if (division) params.append('division', division);
            if (search) params.append('search', search);
            
            const exportUrl = baseUrl + '?' + params.toString();
            
            console.log('Export URL:', exportUrl);
            
            // Open in new window
            window.open(exportUrl, '_blank');
        }
        </script>

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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($record->status === 'INCOMPLETE')
                                --
                            @else
                                {{ $record->total_hours ? number_format($record->total_hours, 2) : '-' }}
                            @endif
                        </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-4 text-center text-gray-500">
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
