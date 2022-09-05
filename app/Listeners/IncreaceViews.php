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
        if(!session()->has('videoVisited')) {

            $this->updateViews($event->myvid);
        
        } else {
        
            return false;
        
        }
    }

    function updateViews($video){
        $video -> views += 1;
        $video -> save();
        session()->put('videoVisited', $video->id); // should logout and login again to increace
    }

}
