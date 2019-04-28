<?php

namespace App\Listeners;

use App\Events\ExecutarJF;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class JFExecutado
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
     * @param  ExecutarJF  $event
     * @return void
     */
    public function handle(ExecutarJF $event)
    {
        //
    }
}
