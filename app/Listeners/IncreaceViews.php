<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use App\Models\Video;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaceViews
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
     * @param  object  $event
     * @return void
     */
    public function handle(VideoViewer $event)
    {
        $this->updateViews($event->myvid);
    }

    function updateViews($video){
        $video -> views += 1;
        $video -> save();
    }

}
