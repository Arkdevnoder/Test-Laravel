<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ResizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $picture;

    /**
     * Create a new job instance.
     * DI pattern
     *
     * @return void
     */
    public function __construct($picture)
    {
        $this->picture = $picture;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $name = $this->picture;

        $path = storage_path().'/app/public/'.$name;

        $img = \Image::make($path)->resize(300, 300);
        $img->save(storage_path().'/app/public/resized/'.$name);
    }
}
