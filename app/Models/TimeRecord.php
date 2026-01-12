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
        'time_in',
        'time_out',
        'notes',
        'total_hours',
        'status',  // New field for tracking status
        'morning_time_in',
        'morning_time_out',
        'afternoon_time_in',
        'afternoon_time_out'
    ];

    protected $casts = [
        'time_in' => 'datetime',
        'time_out' => 'datetime',
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
        
        // Calculate morning session hours
        if ($this->morning_time_in && $this->morning_time_out) {
            $morningMinutes = $this->morning_time_out->diffInMinutes($this->morning_time_in);
            $totalHours += $morningMinutes / 60;
        }
        
        // Calculate afternoon session hours
        if ($this->afternoon_time_in && $this->afternoon_time_out) {
            $afternoonMinutes = $this->afternoon_time_out->diffInMinutes($this->afternoon_time_in);
            $totalHours += $afternoonMinutes / 60;
        }
        
        // If only morning time in exists (no time out), calculate from morning time in to now
        if ($this->morning_time_in && !$this->morning_time_out && !$this->afternoon_time_in) {
            $currentMinutes = now()->diffInMinutes($this->morning_time_in);
            $totalHours = $currentMinutes / 60;
        }
        
        // If morning complete and afternoon time in exists (no time out), calculate from afternoon time in to now
        if ($this->morning_time_in && $this->morning_time_out && $this->afternoon_time_in && !$this->afternoon_time_out) {
            $currentMinutes = now()->diffInMinutes($this->afternoon_time_in);
            $morningMinutes = $this->morning_time_out->diffInMinutes($this->morning_time_in);
            $totalHours = ($morningMinutes + $currentMinutes) / 60;
        }
        
        $this->total_hours = round($totalHours, 2);
        $this->save();
        
        return $this->total_hours;
    }

    public function scopeToday($query)
    {
        return $query->whereDate('time_in', today());
    }

    public function scopeActive($query)
    {
        return $query->whereNull('time_out');
    }

    public function scopeByDivision($query, $division)
    {
        return $query->where('division', $division);
    }

    public static function hasUserTimedInToday($userId)
    {
        return self::where('user_id', $userId)
            ->whereDate('time_in', now()->format('Y-m-d'))
            ->where('status', 'TIMED_IN')
            ->exists();
    }

    public static function hasUserCompletedToday($userId)
    {
        return self::where('user_id', $userId)
            ->whereDate('time_in', now()->format('Y-m-d'))
            ->where('status', 'COMPLETED')
            ->exists();
    }

    public static function setUserTimedInToday($userId)
    {
        // Create or update a record with timed_in_flag = true
        $existingRecord = self::where('user_id', $userId)
            ->whereDate('time_in', now()->format('Y-m-d'))
            ->where('timed_in_flag', true)
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
                ->whereDate('time_in', now()->format('Y-m-d'))
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
