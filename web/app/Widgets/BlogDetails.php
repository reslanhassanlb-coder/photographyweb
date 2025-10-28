<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class BlogDetails extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        //$id = request('id');
        //$cat_id = request('cat_id');
        //echo $id . " " . $cat_id ;

        //$posts = Post::('created_at','desc')->take(3)->get();
        //$posts = find($id);

         return view('widgets.blog_details', [
            'config' => $this->config,
            //'posts' => $posts,
        ]);
    }
}
