<?php

namespace App\Widgets;
use App\Models\Post;
use App\Models\Categories;
use Arrilot\Widgets\AbstractWidget;

class Gallary extends AbstractWidget
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
         $categories = Categories::query()->get();

         $posts = Post::query()->leftJoin('categories','posts.category_id','=','categories.id')
                ->select('posts.id','posts.category_id','posts.title','posts.description','posts.image_alt','posts.image','posts.created_at','categories.name')
                ->orderBy('posts.created_at','desc')
                ->get();

        return view('widgets.gallary', [
            'config' => $this->config,
             'posts' => $posts,
             'categories' => $categories,
        ]);
    }
}
