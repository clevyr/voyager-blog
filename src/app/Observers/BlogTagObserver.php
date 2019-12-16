<?php

namespace App\Observers;

use App\BlogTag;
use Illuminate\Support\Str;

class BlogTagObserver
{

    /**
     * Handle the blog tag "saving" event.
     *
     * @param BlogTag $blogTag
     * @return void
     */
    public function saving(BlogTag $blogTag): void
    {
        $blogTag->slug = Str::slug($blogTag->title, '-');
    }

    /**
     * Handle the blog tag "created" event.
     *
     * @param  \App\BlogTag  $blogTag
     * @return void
     */
    public function created(BlogTag $blogTag): void
    {
        //
    }

    /**
     * Handle the blog tag "updated" event.
     *
     * @param  \App\BlogTag  $blogTag
     * @return void
     */
    public function updated(BlogTag $blogTag): void
    {
        //
    }

    /**
     * Handle the blog tag "deleted" event.
     *
     * @param  \App\BlogTag  $blogTag
     * @return void
     */
    public function deleted(BlogTag $blogTag): void
    {
        //
    }

    /**
     * Handle the blog tag "restored" event.
     *
     * @param  \App\BlogTag  $blogTag
     * @return void
     */
    public function restored(BlogTag $blogTag): void
    {
        //
    }

    /**
     * Handle the blog tag "force deleted" event.
     *
     * @param  \App\BlogTag  $blogTag
     * @return void
     */
    public function forceDeleted(BlogTag $blogTag): void
    {
        //
    }
}
