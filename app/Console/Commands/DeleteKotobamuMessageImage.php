<?php

namespace App\Console\Commands;

use App\Models\Message;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class DeleteKotobamuMessageImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:delete-kotobamu-message-image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $target_messages = Message::all();

        $target_messages = $target_messages->filter(function ($message) {
            return $message->image_path && Carbon::parse($message->send_at)->addDays(14)->isPast();
        });
        // dd($target_messages);

        foreach ($target_messages as $message) {
            if (File::exists(public_path($message->image_path))) {
                File::delete(public_path($message->image_path));
                $message->image_path = '削除済み';
                $message->save();
            }
        }
    }
}
