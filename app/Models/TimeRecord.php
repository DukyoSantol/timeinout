<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'position',
        'division',
        'notes',
        'total_hours',
        'status',  // New field for tracking status
        'morning_time_in',
        'morning_time_out',
        'afternoon_time_in',
        'afternoon_time_out'
    ];

    protected $casts = [
        'total_hours' => 'decimal:2',
        'timed_in_flag' => 'boolean',
        'status' => 'string',  // TIMED_IN, TIMED_OUT, COMPLETED
        'morning_time_in' => 'datetime',
        'morning_time_out' => 'datetime',
        'afternoon_time_in' => 'datetime',
        'afternoon_time_out' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calculateTotalHours()
    {
        $totalHours = 0;
        
        // Get all valid times and find earliest and latest
        $times = [];
        if ($this->morning_time_in) $times[] = $this->morning_time_in;
        if ($this->morning_time_out) $times[] = $this->morning_time_out;
        if ($this->afternoon_time_in) $times[] = $this->afternoon_time_in;
        if ($this->afternoon_time_out) $times[] = $this->afternoon_time_out;
        
        if (empty($times)) {
            $this->total_hours = 0;
            return;
        }
        
        // Find earliest and latest times
        $earliestTime = min($times);
        $latestTime = max($times);
        
        // Calculate total hours from earliest to latest time
        // Handle same-day time ranges properly
        $totalMinutes = 0;
        $currentEarliest = $earliestTime;
        
        // Add morning session hours
        if ($this->morning_time_in && $this->morning_time_out) {
            $morningMinutes = $currentEarliest->diffInMinutes($this->morning_time_out);
            $totalMinutes += $morningMinutes;
            $currentEarliest = $this->morning_time_out;
        }
        
        // Add afternoon session hours
        if ($this->afternoon_time_in && $this->afternoon_time_out) {
            $afternoonMinutes = $currentEarliest->diffInMinutes($this->afternoon_time_out);
            $totalMinutes += $afternoonMinutes;
            $currentEarliest = $this->afternoon_time_out;
        }
        
        $totalHours = $totalMinutes / 60;
        
        // Debug logging
        \Log::info('Total Hours Calculation Debug', [
            'earliest_time' => $earliestTime ? $earliestTime->format('H:i:s') : null,
            'latest_time' => $latestTime ? $latestTime->format('H:i:s') : null,
            'total_minutes' => $totalMinutes,
            'total_hours' => $totalHours,
            'times' => [
                'morning_time_in' => $this->morning_time_in ? $this->morning_time_in->format('H:i:s') : null,
                'morning_time_out' => $this->morning_time_out ? $this->morning_time_out->format('H:i:s') : null,
                'afternoon_time_in' => $this->afternoon_time_in ? $this->afternoon_time_in->format('H:i:s') : null,
                'afternoon_time_out' => $this->afternoon_time_out ? $this->afternoon_time_out->format('H:i:s') : null,
            ]
        ]);
        
        $this->total_hours = round($totalHours, 2);
        $this->save();
        
        return $this->total_hours;
    }
    
    public function getTotalHoursAsTime()
    {
        if (!$this->total_hours) {
            return '0:00';
        }
        
        $hours = floor($this->total_hours);
        $minutes = round(($this->total_hours - $hours) * 60);
        
        return sprintf('%02d:%02d', $hours, $minutes);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeActive($query)
    {
        return $query->whereNull('afternoon_time_out')->whereNotNull('morning_time_in');
    }

    public function scopeByDivision($query, $division)
    {
        return $query->where('division', $division);
    }

    public static function hasUserTimedInToday($userId)
    {
        return self::where('user_id', $userId)
            ->whereDate('created_at', now()->format('Y-m-d'))
            ->whereNotNull('morning_time_in')
            ->exists();
    }

    public static function hasUserCompletedToday($userId)
    {
        return self::where('user_id', $userId)
            ->whereDate('created_at', now()->format('Y-m-d'))
            ->whereNotNull('afternoon_time_out')
            ->exists();
    }

    public static function setUserTimedInToday($userId)
    {
        // Create or update a record with timed_in_flag = true
        $existingRecord = self::where('user_id', $userId)
            ->whereDate('created_at', now()->format('Y-m-d'))
            ->whereNotNull('morning_time_in')
            ->first();
            
        if ($existingRecord) {
            return true; // User already has timed in flag set
        }
        
        return false; // No timed in flag found
    }

    public static function setUserTimedInFlag($userId)
    {
        // Set timed_in_flag = true for today's record (if column exists)
        try {
            $todayRecord = self::where('user_id', $userId)
                ->whereDate('created_at', now()->format('Y-m-d'))
                ->orderBy('created_at', 'desc')
                ->first();
            
            if ($todayRecord) {
                $todayRecord->timed_in_flag = true;
                $todayRecord->save();
            }
        } catch (\Exception $e) {
            // If column doesn't exist, just ignore
            \Log::info('timed_in_flag column not found: ' . $e->getMessage());
        }
    }
}
