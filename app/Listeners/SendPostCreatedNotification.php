<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use App\Mail\PostCreated as PostCreatedMail;
use App\Events\PostCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPostCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        Mail::to($event->post->owner->email)->send(
            new PostCreatedMail($event->post)
        );
    }
}
