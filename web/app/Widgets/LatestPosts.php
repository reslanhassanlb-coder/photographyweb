<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Models\Post;
class LatestPosts extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = ['style'=>1];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */

    public function run()
    {

        //
        $posts = Post::orderBy('created_at','desc')->where('top_post','=',1)->get();
        return view('widgets.latest_posts', [
            'config' => $this->config,
            'posts' => $posts,
        ]);
    }
}
