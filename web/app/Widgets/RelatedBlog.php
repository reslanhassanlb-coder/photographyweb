<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Models\Post;

class RelatedBlog extends AbstractWidget
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
        $category_id = request('cat_id');
        $post_id = request('id');

        $relatedposts = Post::where('category_id','=',$category_id)->where('id','<>',$post_id)->get();
        return view('widgets.related_blog', [
            'config' => $this->config,
            'relatedposts' => $relatedposts,
        ]);
    }
}
