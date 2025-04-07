<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Video;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessVideo implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $video;

    /**
     * Create a new job instance.
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            sleep(5); // simulate processing
            $this->video->update(['status' => 'processed']);
        } catch (\Exception $e) {
            $this->video->update(['status' => 'failed']);
            throw $e;
        }
    }
}
