<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TimeRecord;
use Illuminate\Support\Facades\Log;

class AutoTimeOut extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:timeout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically time out incomplete records at midnight';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting auto time out process...');
        
        // Find all incomplete records including today
        $incompleteRecords = TimeRecord::whereNull('afternoon_time_out')
            ->get();
        
        $count = 0;
        
        foreach ($incompleteRecords as $record) {
            // Set time out to 11:59 PM of the created_at day in Manila timezone
            $timeOut = $record->created_at->copy()->setTimezone('Asia/Manila')->setTime(23, 59, 59);
            $record->afternoon_time_out = $timeOut;
            $record->status = 'INCOMPLETE';
            $record->auto_completed = true;
            $record->calculateTotalHours();
            $record->save();
            
            $count++;
            
            $this->line("Auto timed out: {$record->full_name} - {$record->created_at->format('Y-m-d')} to {$timeOut->format('H:i')}");
            
            // Log the auto time out
            Log::info("Auto time out completed", [
                'user_id' => $record->user_id,
                'full_name' => $record->full_name,
                'created_at' => $record->created_at,
                'auto_time_out' => $timeOut,
                'total_hours' => $record->total_hours
            ]);
        }
        
        if ($count > 0) {
            $this->info("Successfully auto timed out {$count} incomplete records.");
        } else {
            $this->info('No incomplete records found.');
        }
        
        return 0;
    }
}
