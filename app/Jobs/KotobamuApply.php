<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\UtilService;

class KotobamuApply implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $event;
    public $keyword;
    public $kotobamus;

    /**
     * Create a new job instance.
     */
    public function __construct($event, string $keyword, $kotobamus)
    {
        $this->event = $event;
        $this->keyword = $keyword;
        $this->kotobamus = $kotobamus;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $util = new UtilService();
        $user = $util->CreateUserFromLineId($this->event['source']['userId']);

        foreach ($this->kotobamus as $kotobamu) {
            UtilService::CreateKotobamuApplication($user, $kotobamu, $this->keyword);
        }
    }
}
