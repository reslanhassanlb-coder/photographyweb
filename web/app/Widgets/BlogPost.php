<?php

namespace App\Widgets;
use App\Models\Post;
use Arrilot\Widgets\AbstractWidget;

class BlogPost extends AbstractWidget
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
        $posts = Post::query()->leftJoin('categories','posts.category_id','=','categories.id')
                ->leftJoin('users','posts.author_id','=','users.id')
                ->select('posts.id','posts.category_id','posts.title','posts.description','posts.image_alt','posts.image','posts.created_at','categories.name','users.name as author')
                ->where('display_in_home','=',1)
                ->orderBy('posts.created_at','desc')
                ->get();

        return view('widgets.blog_post', [
            'config' => $this->config,
            'posts' => $posts,
        ]);
    }
}
