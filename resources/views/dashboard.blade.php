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
            <form action="{{ route('admin.dashboard') }}" method="GET" class="grid grid-cols-1 md:grid-cols-6 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search by Name</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search name..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="date_from" class="block text-sm font-medium text-gray-700 mb-1">Date From</label>
                    <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="date_to" class="block text-sm font-medium text-gray-700 mb-1">Date To</label>
                    <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
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
                <div class="flex space-x-2 mb-2">
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
                
                <!-- Debug Test Links -->
                <div class="flex space-x-2 text-xs">
                    <a href="{{ route('admin.export') }}?date_from=2026-01-10&date_to=2026-01-10" class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                        🧪 Test Jan 10 Excel
                    </a>
                    <a href="{{ route('admin.view.csv') }}?date_from=2026-01-10&date_to=2026-01-10" class="px-2 py-1 bg-purple-500 text-white rounded hover:bg-purple-600">
                        🧪 Test Jan 10 PDF
                    </a>
                    <a href="{{ route('admin.debug.params') }}?date_from=2026-01-10&date_to=2026-01-10&test=value" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                        🔍 Debug Params
                    </a>
                </div>
                
                <!-- Direct Export Links (Workaround) -->
                <div class="flex space-x-2 text-xs mt-2">
                    <span class="text-gray-600">🔧 Simple Export (Bypass):</span>
                    <script>console.log('Export section loading...');</script>
                    <form method="POST" action="{{ route('admin.export') }}" target="_blank" style="display:inline;">
                        @csrf
                        <input type="hidden" name="date_from" id="export_date_from">
                        <input type="hidden" name="date_to" id="export_date_to">
                        <input type="hidden" name="division" id="export_division">
                        <input type="hidden" name="search" id="export_search">
                        <button type="submit" class="px-2 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                            📊 Export Excel
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.view.csv') }}" target="_blank" style="display:inline;">
                        @csrf
                        <input type="hidden" name="date_from" id="export_pdf_date_from">
                        <input type="hidden" name="date_to" id="export_pdf_date_to">
                        <input type="hidden" name="division" id="export_pdf_division">
                        <input type="hidden" name="search" id="export_pdf_search">
                        <button type="submit" class="px-2 py-1 bg-purple-600 text-white rounded hover:bg-purple-700">
                            📄 Export PDF
                        </button>
                    </form>
                </div>
                
                <script>
                // Copy form values to export forms on submit
                document.addEventListener('DOMContentLoaded', function() {
                    console.log('Export script loaded');
                    
                    // Update export form values when main form changes
                    const dateFromEl = document.getElementById('date_from');
                    const dateToEl = document.getElementById('date_to');
                    const divisionEl = document.getElementById('division');
                    const searchEl = document.getElementById('search');
                    
                    console.log('Form elements found:', {
                        dateFrom: !!dateFromEl,
                        dateTo: !!dateToEl,
                        division: !!divisionEl,
                        search: !!searchEl
                    });
                        
                    // Update Excel export form
                    const excelDateFrom = document.getElementById('export_date_from');
                    const excelDateTo = document.getElementById('export_date_to');
                    const excelDivision = document.getElementById('export_division');
                    const excelSearch = document.getElementById('export_search');
                    
                    // Update PDF export form
                    const pdfDateFrom = document.getElementById('export_pdf_date_from');
                    const pdfDateTo = document.getElementById('export_pdf_date_to');
                    const pdfDivision = document.getElementById('export_pdf_division');
                    const pdfSearch = document.getElementById('export_pdf_search');
                    
                    console.log('Export form elements found:', {
                        excelDateFrom: !!excelDateFrom,
                        excelDateTo: !!excelDateTo,
                        pdfDateFrom: !!pdfDateFrom
                    });
                        
                    function updateExportForms() {
                        console.log('Updating export forms with values:', {
                            dateFrom: dateFromEl ? dateFromEl.value : null,
                            dateTo: dateToEl ? dateToEl.value : null,
                            division: divisionEl ? divisionEl.value : null,
                            search: searchEl ? searchEl.value : null
                        });
                        
                        if (dateFromEl && excelDateFrom) excelDateFrom.value = dateFromEl.value;
                        if (dateToEl && excelDateTo) excelDateTo.value = dateToEl.value;
                        if (divisionEl && excelDivision) excelDivision.value = divisionEl.value;
                        if (searchEl && excelSearch) excelSearch.value = searchEl.value;
                            
                        if (dateFromEl && pdfDateFrom) pdfDateFrom.value = dateFromEl.value;
                        if (dateToEl && pdfDateTo) pdfDateTo.value = dateToEl.value;
                        if (divisionEl && pdfDivision) pdfDivision.value = divisionEl.value;
                        if (searchEl && pdfSearch) pdfSearch.value = searchEl.value;
                    }
                        
                    // Update on input change
                    if (dateFromEl) dateFromEl.addEventListener('change', updateExportForms);
                    if (dateToEl) dateToEl.addEventListener('change', updateExportForms);
                    if (divisionEl) divisionEl.addEventListener('change', updateExportForms);
                    if (searchEl) searchEl.addEventListener('input', updateExportForms);
                        
                    // Initial update
                    updateExportForms();
                });
            </div>
        </div>

        <script>
        function exportDirect(type) {
            console.log('Starting direct export...');
            
            // Read values directly from form elements
            const dateFromEl = document.getElementById('date_from');
            const dateToEl = document.getElementById('date_to');
            const divisionEl = document.getElementById('division');
            const searchEl = document.getElementById('search');
            
            const dateFrom = dateFromEl ? dateFromEl.value : '';
            const dateTo = dateToEl ? dateToEl.value : '';
            const division = divisionEl ? divisionEl.value : '';
            const search = searchEl ? searchEl.value : '';
            
            console.log('Direct export values:', { dateFrom, dateTo, division, search });
            
            // Build export URL with parameters directly
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
            
            console.log('Direct export URL:', exportUrl);
            
            // Open in new window to avoid any URL rewriting issues
            window.open(exportUrl, '_blank');
        }

        function exportWithFilters(type) {
            console.log('Starting export function...');
            
            // Read values from current URL parameters first (after search)
            const urlParams = new URLSearchParams(window.location.search);
            let dateFrom = urlParams.get('date_from');
            let dateTo = urlParams.get('date_to');
            let division = urlParams.get('division');
            let search = urlParams.get('search');
            
            // Fallback to form values if URL params are empty
            if (!dateFrom) {
                const dateFromEl = document.getElementById('date_from');
                dateFrom = dateFromEl ? dateFromEl.value : '';
            }
            if (!dateTo) {
                const dateToEl = document.getElementById('date_to');
                dateTo = dateToEl ? dateToEl.value : '';
            }
            if (!division) {
                const divisionEl = document.getElementById('division');
                division = divisionEl ? divisionEl.value : '';
            }
            if (!search) {
                const searchEl = document.getElementById('search');
                search = searchEl ? searchEl.value : '';
            }
            
            console.log('Filter values:', { dateFrom, dateTo, division, search });
            console.log('Current URL:', window.location.search);
            
            // Alert user if filters are not set
            if (!dateFrom && !dateTo && !division && !search) {
                alert('Please set filters first (date range, search, or division) and click Search before exporting.');
                return;
            }
            
            // Build export URL with parameters directly
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
            
            console.log('Final export URL:', exportUrl);
            
            // Open in new window to avoid any URL rewriting issues
            window.open(exportUrl, '_blank');
        }
        </script>
        </div>

        <!-- Today's Records Table -->
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Today's Records ({{ ($todayRecords ?? collect())->count() }})</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Division</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time In</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time Out</th>
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $record->afternoon_time_out ? $record->afternoon_time_out->format('H:i:s') : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $record->total_hours ? $record->getTotalHoursAsTime() : '-' }}
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
                                    <form action="{{ route('admin.time-records.delete', $record->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this record?')">
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
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">No records found for today.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
