<?php

// app/Jobs/CompleteTaskJob.php
namespace App\Jobs;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CompleteTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Task $task)
    {
    }

    public function handle()
    {
        // Simulate some processing time
        sleep(3);
        
        $this->task->update([
            'completed_at' => now(),
        ]);
    }
}