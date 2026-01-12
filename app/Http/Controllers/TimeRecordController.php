<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeRecord;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TimeRecordController extends Controller
{
    public function index()
    {
        $records = TimeRecord::with([])
            ->orderBy('time_in', 'desc')
            ->paginate(50);
        
        return view('time-records.index', compact('records'));
    }

    public function create()
    {
        return view('time-records.form');
    }

    public function store(Request $request)
    {
        // Handle form actions
        if ($request->has('action')) {
            $action = $request->action;
            
            if ($action === 'time_in') {
                return $this->handleTimeIn($request);
            } elseif ($action === 'time_out') {
                return $this->handleTimeOut($request);
            } elseif ($action === 'morning_time_in') {
                return $this->handleMorningTimeIn($request);
            } elseif ($action === 'morning_time_out') {
                return $this->handleMorningTimeOut($request);
            } elseif ($action === 'afternoon_time_in') {
                return $this->handleAfternoonTimeIn($request);
            } elseif ($action === 'afternoon_time_out') {
                return $this->handleAfternoonTimeOut($request);
            }
        }
        
        // Handle form submission (submit button)
        if ($request->has('submit_form')) {
            return $this->handleSubmit($request);
        }
        
        return redirect()->route('time-records.form')
            ->with('error', 'No action specified.');
    }
    
    private function handleTimeIn(Request $request)
    {
        // Check if user is already timed in today
        $todayRecord = TimeRecord::where('user_id', auth()->id())
            ->whereDate('time_in', now()->format('Y-m-d'))
            ->orderBy('created_at', 'desc')
            ->first();
        
        if ($todayRecord && $todayRecord->status === 'TIMED_IN') {
            return redirect()->route('time-records.form')
                ->with('error', 'You are already timed in today!');
        }
        
        // Get user information
        $user = auth()->user();
        
        // Debug: Log user information
        \Log::info('User ID: ' . $user->id);
        \Log::info('User Name: ' . ($user->name ?? 'NULL'));
        \Log::info('User Position: ' . ($user->position ?? 'NULL'));
        \Log::info('User Division: ' . ($user->division ?? 'NULL'));
        
        // Create or update time in record
        if ($todayRecord) {
            // Update existing record
            $todayRecord->update([
                'time_in' => now(),
                'status' => 'TIMED_IN'
            ]);
        } else {
            // Create new time in record
            TimeRecord::create([
                'user_id' => $user->id,
                'full_name' => $user->name ?? 'Unknown User',
                'position' => $user->position ?? 'Unknown Position',
                'division' => $user->division ?? 'Unknown Division',
                'time_in' => now(),
                'status' => 'TIMED_IN'
            ]);
        }
        
        return redirect()->route('time-records.form')
            ->with('success', 'Time In recorded successfully!');
    }
    
    private function handleTimeOut(Request $request)
    {
        // Find today's time in record
        $todayRecord = TimeRecord::where('user_id', auth()->id())
            ->whereDate('time_in', now()->format('Y-m-d'))
            ->where('status', 'TIMED_IN')
            ->first();
        
        if (!$todayRecord) {
            return redirect()->route('time-records.form')
                ->with('error', 'Please time in first!');
        }
        
        // Update time out
        $todayRecord->update([
            'time_out' => now(),
            'status' => 'COMPLETED'
        ]);
        
        // Calculate total hours
        $todayRecord->calculateTotalHours();
        
        return redirect()->route('time-records.form')
            ->with('success', 'Time out recorded successfully!');
    }

    private function handleMorningTimeIn(Request $request)
    {
        // Find today's record or create new one
        $todayRecord = TimeRecord::where('user_id', auth()->id())
            ->whereDate('created_at', now()->format('Y-m-d'))
            ->first();
        
        $user = auth()->user();
        
        if ($todayRecord) {
            // Update existing record with morning time in
            $todayRecord->update([
                'morning_time_in' => now()->subHours(16)->setTimezone('Asia/Manila'),
                'status' => 'TIMED_IN'
            ]);
        } else {
            // Create new morning time in record
            TimeRecord::create([
                'user_id' => $user->id,
                'full_name' => $user->name ?? 'Unknown User',
                'position' => $user->position ?? 'Unknown Position',
                'division' => $user->division ?? 'Unknown Division',
                'morning_time_in' => now()->subHours(16)->setTimezone('Asia/Manila'),
                'status' => 'TIMED_IN'
            ]);
        }
        
        return redirect()->route('time-records.form')
            ->with('success', 'Morning time in recorded successfully!');
    }

    private function handleMorningTimeOut(Request $request)
    {
        // Find today's morning time in record
        $todayRecord = TimeRecord::where('user_id', auth()->id())
            ->whereDate('created_at', now()->format('Y-m-d'))
            ->whereNotNull('morning_time_in')
            ->whereNull('morning_time_out')
            ->first();
        
        if (!$todayRecord) {
            return redirect()->route('time-records.form')
                ->with('error', 'Please record morning time in first!');
        }
        
        // Update morning time out and set status to available for afternoon session
        $todayRecord->update([
            'morning_time_out' => now()->subHours(16)->setTimezone('Asia/Manila'),
            'status' => 'TIMED_IN' // Available for afternoon session
        ]);
        
        return redirect()->route('time-records.form')
            ->with('success', 'Morning time out recorded successfully!');
    }

    private function handleAfternoonTimeIn(Request $request)
    {
        // Find today's record
        $todayRecord = TimeRecord::where('user_id', auth()->id())
            ->whereDate('created_at', now()->format('Y-m-d'))
            ->first();
        
        $user = auth()->user();
        
        if ($todayRecord) {
            // Update existing record
            $todayRecord->update([
                'afternoon_time_in' => now()->subHours(16)->setTimezone('Asia/Manila'),
                'status' => 'TIMED_IN'
            ]);
        } else {
            // Create new afternoon time in record
            TimeRecord::create([
                'user_id' => $user->id,
                'full_name' => $user->name ?? 'Unknown User',
                'position' => $user->position ?? 'Unknown Position',
                'division' => $user->division ?? 'Unknown Division',
                'afternoon_time_in' => now()->subHours(16)->setTimezone('Asia/Manila'),
                'status' => 'TIMED_IN'
            ]);
        }
        
        return redirect()->route('time-records.form')
            ->with('success', 'Afternoon time in recorded successfully!');
    }

    private function handleAfternoonTimeOut(Request $request)
    {
        // Find today's record
        $todayRecord = TimeRecord::where('user_id', auth()->id())
            ->whereDate('created_at', now()->format('Y-m-d'))
            ->whereNotNull('afternoon_time_in')
            ->whereNull('afternoon_time_out')
            ->first();
        
        if (!$todayRecord) {
            return redirect()->route('time-records.form')
                ->with('error', 'Please record afternoon time in first!');
        }
        
        // Update afternoon time out and complete the day
        $todayRecord->update([
            'afternoon_time_out' => now()->subHours(16)->setTimezone('Asia/Manila'),
            'time_out' => now()->subHours(16)->setTimezone('Asia/Manila'), // Final time out
            'status' => 'COMPLETED'
        ]);
        
        // Calculate total hours
        $todayRecord->calculateTotalHours();
        
        return redirect()->route('time-records.form')
            ->with('success', 'Afternoon time out recorded successfully! Day completed.');
    }
    
    private function handleSubmit(Request $request)
    {
        // Different validation rules for logged-in vs guest users
        if (auth()->check()) {
            $validated = $request->validate([
                'time_in' => 'required|date',
                'time_out' => 'nullable|date|after:time_in',
                'notes' => 'nullable|string|max:1000'
            ]);
            
            // Additional logic for logged-in user
            $user = auth()->user();
            $validated['user_id'] = $user->id;
            $validated['full_name'] = $user->name ?? 'Unknown User';
            $validated['position'] = $user->position ?? 'Unknown Position';
            $validated['division'] = $user->division ?? 'Unknown Division';
            
            // Store time record
            $timeRecord = TimeRecord::create($validated);
            
            // Set status based on whether time_out is provided
            if (!$request->time_out) {
                // Time In only - set status to TIMED_IN
                $timeRecord->status = 'TIMED_IN';
                $timeRecord->save();
            } else {
                // Time Out provided - set status to COMPLETED
                $timeRecord->status = 'COMPLETED';
                $timeRecord->save();
                
                // Calculate total hours
                $timeRecord->calculateTotalHours();
            }
            
            return redirect()->route('time-records.form')
                ->with('success', 'Time record saved successfully!');
        } else {
            // For guest users, require time in before time out
            $validated = $request->validate([
                'time_in' => 'required|date',
                'time_out' => 'nullable|date|after:time_in',
                'notes' => 'nullable|string|max:1000'
            ]);
            
            // Check if guest is trying to time out without timing in first
            if ($request->has('time_out') && !$request->has('time_in')) {
                return redirect()->route('time-records.form')
                    ->with('error', 'Please time in first before timing out!');
            }
            
            // Store time record
            $timeRecord = TimeRecord::create($validated);
            
            // Set status based on whether time_out is provided
            if (!$request->time_out) {
                // Time In only - set status to TIMED_IN
                $timeRecord->status = 'TIMED_IN';
                $timeRecord->save();
            } else {
                // Time Out provided - set status to COMPLETED
                $timeRecord->status = 'COMPLETED';
                $timeRecord->save();
                
                // Calculate total hours
                $timeRecord->calculateTotalHours();
            }
            
            return redirect()->route('time-records.form')
                ->with('success', 'Time record saved successfully!');
        }
    }

    public function showChangePasswordForm($id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('admin.change-password', compact('user'));
    }
    
    public function changePassword(Request $request, $id)
    {
        $user = \App\Models\User::findOrFail($id);
        
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        $user->password = bcrypt($request->password);
        $user->save();
        
        return redirect()->route('admin.dashboard')
            ->with('success', 'Password changed successfully for ' . $user->name);
    }

    public function checkTimedInStatus(Request $request)
    {
        if (auth()->check()) {
            $hasTimedInToday = \App\Models\TimeRecord::hasUserTimedInToday(auth()->id());
            
            return response()->json([
                'hasTimedInToday' => $hasTimedInToday
            ]);
        }
        
        return response()->json([
            'hasTimedInToday' => false
        ]);
    }

    // User Management Methods
    public function timeRecordsIndex(Request $request)
    {
        $query = TimeRecord::query();
        
        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->get('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('full_name', 'like', "%{$searchTerm}%")
                  ->orWhere('position', 'like', "%{$searchTerm}%")
                  ->orWhere('division', 'like', "%{$searchTerm}%");
            });
        }
        
        // Date filtering
        if ($request->has('date_from')) {
            $query->whereDate('time_in', '>=', $request->get('date_from'));
        }
        
        if ($request->has('date_to')) {
            $query->whereDate('time_in', '<=', $request->get('date_to'));
        }
        
        // Division filtering
        if ($request->has('division')) {
            $query->where('division', $request->get('division'));
        }
        
        $timeRecords = $query->orderBy('time_in', 'desc')->paginate(10);
        
        return view('admin.time-records.index', compact('timeRecords'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'position' => 'nullable|string|max:255',
            'division' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'position' => $request->position,
            'division' => $request->division,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully!');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'position' => 'nullable|string|max:255',
            'division' => 'nullable|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'division' => $request->division,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully!');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }

    public function exportUsers(Request $request)
    {
        $query = User::query();
        
        // Apply same filters as index
        if ($request->has('search')) {
            $searchTerm = $request->get('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('email', 'like', "%{$searchTerm}%")
                  ->orWhere('position', 'like', "%{$searchTerm}%");
            });
        }
        
        if ($request->has('date_from')) {
            $query->whereDate('created_at', '>=', $request->get('date_from'));
        }
        
        if ($request->has('date_to')) {
            $query->whereDate('created_at', '<=', $request->get('date_to'));
        }
        
        if ($request->has('division')) {
            $query->where('division', $request->get('division'));
        }
        
        $users = $query->orderBy('created_at', 'desc')->get();
        
        $filename = 'users_export_' . date('Y-m-d_H-i-s') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($users) {
            $file = fopen('php://output', 'w');
            
            // CSV header
            fputcsv($file, ['ID', 'Name', 'Email', 'Position', 'Division', 'Created At']);
            
            // CSV data
            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->position,
                    $user->division,
                    $user->created_at->format('Y-m-d H:i:s')
                ]);
            }
            
            fclose($file);
            return file_get_contents('php://output');
        };
        
        return response()->stream($callback, 200, $headers);
    }

    public function timeOutUser()
    {
        $user = auth()->user();
        $activeRecord = TimeRecord::where('user_id', $user->id)
            ->whereDate('time_in', now()->format('Y-m-d'))
            ->whereNull('time_out')
            ->first();
        
        if ($activeRecord) {
            $activeRecord->time_out = now();
            $activeRecord->calculateTotalHours();
            
            return redirect()->route('time-records.form')
                ->with('success', 'Time out recorded successfully!');
        }
        
        return redirect()->route('time-records.form')
            ->with('error', 'No active time record found.');
    }

    public function dashboard(Request $request)
    {
        $query = TimeRecord::query();
        
        // Debug: Log the request parameters
        \Log::info('Dashboard request parameters:', [
            'search' => $request->get('search'),
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
            'division' => $request->get('division'),
        ]);
        
        // Apply filters
        if ($request->has('search') && !empty($request->get('search'))) {
            $searchTerm = $request->get('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('full_name', 'like', "%{$searchTerm}%")
                  ->orWhere('position', 'like', "%{$searchTerm}%")
                  ->orWhere('division', 'like', "%{$searchTerm}%");
            });
        }
        
        if ($request->has('date_from') && !empty($request->get('date_from'))) {
            $query->whereDate('time_in', '>=', $request->get('date_from'));
        }
        
        if ($request->has('date_to') && !empty($request->get('date_to'))) {
            $query->whereDate('time_in', '<=', $request->get('date_to'));
        }
        
        if ($request->has('division') && !empty($request->get('division'))) {
            $query->where('division', $request->get('division'));
        }
        
        // If no filters applied, show only today's records
        if (!$request->has('search') && !$request->has('date_from') && !$request->has('date_to') && !$request->has('division')) {
            $query->whereDate('created_at', now()->format('Y-m-d'));
        }
        
        $todayRecords = $query->orderBy('created_at', 'desc')->get();
        
        // Force recalculate total hours for today's records
        foreach($todayRecords as $record) {
            $record->calculateTotalHours();
        }
        
        $activeRecords = TimeRecord::active()->orderBy('time_in', 'desc')->get();
        $divisions = TimeRecord::distinct('division')->pluck('division');
        
        // Debug: Log the results
        \Log::info('Dashboard results:', [
            'todayRecords_count' => $todayRecords->count(),
            'activeRecords_count' => $activeRecords->count(),
            'divisions' => $divisions->toArray(),
        ]);
        
        $totalToday = $todayRecords->count();
        $totalActive = $activeRecords->count();
        $totalHoursToday = $todayRecords->whereNotNull('total_hours')->sum('total_hours');
        
        // Calculate total hours per user
        $totalHoursPerUser = TimeRecord::whereNotNull('total_hours')
            ->whereDate('time_in', now()->format('Y-m-d'))
            ->groupBy('user_id', 'full_name')
            ->selectRaw('user_id, full_name, SUM(total_hours) as total_hours')
            ->get()
            ->keyBy('user_id');

        return view('admin.dashboard', compact(
            'todayRecords',
            'activeRecords', 
            'divisions',
            'totalToday',
            'totalActive',
            'totalHoursToday',
            'totalHoursPerUser'
        ));
    }

    public function deleteRecord(Request $request, $id)
    {
        $record = TimeRecord::findOrFail($id);
        
        // Log the deletion
        \Log::info('Deleting time record:', [
            'id' => $id,
            'user_id' => $record->user_id,
            'full_name' => $record->full_name,
        ]);
        
        $record->delete();
        
        return redirect()->route('admin.dashboard')
            ->with('success', 'Time record deleted successfully!');
    }

    public function timeOut($id)
    {
        $record = TimeRecord::findOrFail($id);
        
        if ($record->time_out) {
            return redirect()->back()->with('error', 'This record already has a time out.');
        }

        $record->time_out = now();
        $record->calculateTotalHours();

        return redirect()->back()->with('success', 'Time out recorded successfully!');
    }

    public function edit($id)
    {
        $record = TimeRecord::findOrFail($id);
        return view('time-records.edit', compact('record'));
    }

    public function update(Request $request, $id)
    {
        $record = TimeRecord::findOrFail($id);

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'time_in' => 'required|date',
            'time_out' => 'nullable|date|after:time_in',
            'notes' => 'nullable|string|max:1000'
        ]);

        $record->update($validated);

        if ($record->time_out) {
            $record->calculateTotalHours();
        }

        return redirect()->route('admin.dashboard')->with('success', 'Time record updated successfully!');
    }

    public function destroy($id)
    {
        $record = TimeRecord::findOrFail($id);
        $record->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Time record deleted successfully!');
    }

    public function viewCsv()
    {
        try {
            // Simple query without any filters
            $records = TimeRecord::orderBy('time_in', 'desc')->get();
            
            // Log success
            \Log::info('View CSV successful, records found: ' . $records->count());
            
            // Create a simple test CSV content
            $csvContent = "ID,Full Name,Position,Division,Time In,Time Out,Total Hours,Status\n";
            
            foreach ($records as $record) {
                $csvContent .= $record->id . ",";
                $csvContent .= $record->full_name . ",";
                $csvContent .= $record->position . ",";
                $csvContent .= $record->division . ",";
                $csvContent .= $record->time_in->format('Y-m-d H:i:s') . ",";
                $csvContent .= ($record->time_out ? $record->time_out->format('Y-m-d H:i:s') : '-') . ",";
                $csvContent .= ($record->total_hours ? number_format($record->total_hours, 2) : '-') . ",";
                $csvContent .= ($record->status ?? '-') . "\n";
            }
            
            // Return as plain text to view in browser
            return response($csvContent, 200, [
                'Content-Type' => 'text/plain',
                'Content-Disposition' => 'inline; filename="data.csv"'
            ]);
            
        } catch (\Exception $e) {
            Log::error('View CSV failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'View CSV failed: ' . $e->getMessage());
        }
    }

    public function simpleExport()
    {
        try {
            // Simple query without any filters
            $records = TimeRecord::orderBy('time_in', 'desc')->get();
            
            // Log success
            \Log::info('Simple export successful, records found: ' . $records->count());
            
            // Create a simple test CSV content
            $csvContent = "ID,Full Name,Position,Division,Time In,Time Out,Total Hours,Status\n";
            
            foreach ($records as $record) {
                $csvContent .= $record->id . ",";
                $csvContent .= $record->full_name . ",";
                $csvContent .= $record->position . ",";
                $csvContent .= $record->division . ",";
                $csvContent .= $record->time_in->format('Y-m-d H:i:s') . ",";
                $csvContent .= ($record->time_out ? $record->time_out->format('Y-m-d H:i:s') : '-') . ",";
                $csvContent .= ($record->total_hours ? number_format($record->total_hours, 2) : '-') . ",";
                $csvContent .= ($record->status ?? '-') . "\n";
            }
            
            // Create filename
            $filename = 'simple_time_records_export_' . date('Y-m-d_H-i-s') . '.csv';
            
            // Return as download with proper headers
            return response($csvContent, 200, [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                'Content-Length' => strlen($csvContent),
                'Cache-Control' => 'no-cache, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Simple export failed: ' . $e->getMessage());
            Log::error('Simple export error details: ' . $e->getTraceAsString());
            return redirect()->back()->with('error', 'Simple export failed: ' . $e->getMessage());
        }
    }

    public function exportTimeRecords(Request $request)
    {
        try {
            // Build query - simplified version for debugging
            $query = TimeRecord::query();
            
            // Log request parameters for debugging
            \Log::info('Export request parameters:', [
                'search' => $request->get('search'),
                'date_from' => $request->get('date_from'),
                'date_to' => $request->get('date_to'),
                'division' => $request->get('division'),
            ]);
            
            // Apply filters with better validation
            if ($request->has('search') && !empty($request->get('search'))) {
                $searchTerm = $request->get('search');
                $query->where('full_name', 'like', '%' . $searchTerm . '%');
            }
            
            // Better date validation
            if ($request->has('date_from') && !empty($request->get('date_from'))) {
                $dateFrom = $request->get('date_from');
                if (strtotime($dateFrom)) {
                    $query->whereDate('time_in', '>=', $dateFrom);
                }
            }
            
            if ($request->has('date_to') && !empty($request->get('date_to'))) {
                $dateTo = $request->get('date_to');
                if (strtotime($dateTo)) {
                    $query->whereDate('time_in', '<=', $dateTo);
                }
            }
            
            if ($request->has('division') && !empty($request->get('division'))) {
                $query->where('division', $request->get('division'));
            }
            
            // Get records
            $records = $query->orderBy('time_in', 'desc')->get();
            
            // Log success
            \Log::info('Export query successful, records found: ' . $records->count());
            
            // Prepare CSV data
            $csvData = [];
            $csvData[] = [
                'ID', 
                'Full Name', 
                'Position', 
                'Division', 
                'Time In', 
                'Time Out', 
                'Total Hours', 
                'Status',
                'Morning Time In',
                'Morning Time Out', 
                'Afternoon Time In', 
                'Afternoon Time Out'
            ];
            
            foreach ($records as $record) {
                $csvData[] = [
                    $record->id,
                    $record->full_name,
                    $record->position,
                    $record->division,
                    $record->time_in->format('Y-m-d H:i:s'),
                    $record->time_out ? $record->time_out->format('Y-m-d H:i:s') : '-',
                    $record->total_hours ? number_format($record->total_hours, 2) : '-',
                    $record->status ?? '-',
                    $record->morning_time_in ? $record->morning_time_in->format('Y-m-d H:i:s') : '-',
                    $record->morning_time_out ? $record->morning_time_out->format('Y-m-d H:i:s') : '-',
                    $record->afternoon_time_in ? $record->afternoon_time_in->format('Y-m-d H:i:s') : '-',
                    $record->afternoon_time_out ? $record->afternoon_time_out->format('Y-m-d H:i:s') : '-'
                ];
            }
            
            // Create filename
            $filename = 'time_records_export_' . date('Y-m-d_H-i-s') . '.csv';
            
            // Set headers
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Expires' => '0',
            ];
            
            // Generate CSV
            $callback = function() use ($csvData) {
                $file = fopen('php://output', 'w');
                
                foreach ($csvData as $row) {
                    fputcsv($file, $row);
                }
                
                fclose($file);
            };
            
            // Log success
            Log::info('Export successful: ' . count($records) . ' records exported');
            
            return response()->stream($callback, 200, $headers);
            
        } catch (\Exception $e) {
            Log::error('Export failed: ' . $e->getMessage());
            Log::error('Export error details: ' . $e->getTraceAsString());
            return redirect()->back()->with('error', 'Export failed: ' . $e->getMessage());
        }
    }

    public function filter(Request $request)
    {
        $query = TimeRecord::query();

        // Search by name
        if ($request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('full_name', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        if ($request->division) {
            $query->byDivision($request->division);
        }

        if ($request->date_from) {
            try {
                $dateFrom = \Carbon\Carbon::parse($request->date_from);
                $query->whereDate('time_in', '>=', $dateFrom->format('Y-m-d'));
            } catch (\Exception $e) {
                // Invalid date format, skip this filter
            }
        }

        if ($request->date_to) {
            try {
                $dateTo = \Carbon\Carbon::parse($request->date_to);
                $query->whereDate('time_in', '<=', $dateTo->format('Y-m-d'));
            } catch (\Exception $e) {
                // Invalid date format, skip this filter
            }
        }

        $records = $query->orderBy('time_in', 'desc')->paginate(50);
        $divisions = TimeRecord::distinct('division')->pluck('division');
        
        // Calculate statistics for filtered results
        $totalToday = $records->count();
        $activeRecords = TimeRecord::active()->orderBy('time_in', 'desc')->get();
        $totalActive = $activeRecords->count();
        $totalHoursToday = $records->whereNotNull('total_hours')->sum('total_hours');
        $todayRecords = $records;

        return view('dashboard', compact(
            'todayRecords',
            'activeRecords', 
            'divisions',
            'totalToday',
            'totalActive',
            'totalHoursToday',
            'records'
        ));
    }
}
