@extends('layouts.app')

@section('title', 'MGB-XI Edit Time Record')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Time Record</h2>
        
        <form action="{{ route('admin.time-records.update', $record->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">
                    Full Name <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="full_name" 
                    name="full_name" 
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    value="{{ old('full_name', $record->full_name) }}"
                >
            </div>

            <div>
                <label for="position" class="block text-sm font-medium text-gray-700 mb-2">
                    Position <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="position" 
                    name="position" 
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    value="{{ old('position', $record->position) }}"
                >
            </div>

            <div>
                <label for="division" class="block text-sm font-medium text-gray-700 mb-2">
                    Division <span class="text-red-500">*</span>
                </label>
                <select 
                    id="division" 
                    name="division" 
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
                    <option value="">Select Division</option>
                    <option value="Office of the Regional Director" {{ old('division', $record->division) == 'Office of the Regional Director' ? 'selected' : '' }}>Office of the Regional Director</option>
                    <option value="Finance Administrative Division" {{ old('division', $record->division) == 'Finance Administrative Division' ? 'selected' : '' }}>Finance Administrative Division</option>
                    <option value="Mine Management Division" {{ old('division', $record->division) == 'Mine Management Division' ? 'selected' : '' }}>Mine Management Division</option>
                    <option value="Mine Safety Environment and Social Development Division" {{ old('division', $record->division) == 'Mine Safety Environment and Social Development Division' ? 'selected' : '' }}>Mine Safety Environment and Social Development Division</option>
                    <option value="Geoscience Division" {{ old('division', $record->division) == 'Geoscience Division' ? 'selected' : '' }}>Geoscience Division</option>
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="time_in" class="block text-sm font-medium text-gray-700 mb-2">
                        Time In <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="datetime-local" 
                        id="time_in" 
                        name="time_in" 
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        value="{{ old('time_in', $record->time_in->format('Y-m-d\TH:i')) }}"
                    >
                </div>

                <div>
                    <label for="time_out" class="block text-sm font-medium text-gray-700 mb-2">
                        Time Out
                    </label>
                    <input 
                        type="datetime-local" 
                        id="time_out" 
                        name="time_out"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        value="{{ old('time_out', $record->time_out ? $record->time_out->format('Y-m-d\TH:i') : '') }}"
                    >
                </div>
            </div>

            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                    Notes (Optional)
                </label>
                <textarea 
                    id="notes" 
                    name="notes" 
                    rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Add any additional notes..."
                >{{ old('notes', $record->notes) }}</textarea>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors"
                >
                    Update Record
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
