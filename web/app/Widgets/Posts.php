<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Models\Post;
class Posts extends AbstractWidget
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
    $post_id = request('id');

    //$post = Post::find($post_id);


    $post = Post::query()->leftJoin('categories','posts.category_id','=','categories.id')
    ->leftJoin('users','posts.author_id','=','users.id')
    ->select('posts.id','posts.category_id','posts.title','posts.description','posts.image_alt','posts.image','posts.created_at','categories.name','users.name as author')
    ->where('posts.id', '=', $post_id)
    ->orderBy('posts.created_at','desc')
    ->get();

    
    $next_record = Post::where('id', '>', $post_id)->orderBy('id')->first();
    $previous_record = Post::where('id', '<', $post_id)->orderBy('id','desc')->first();


        return view('widgets.posts', [
            'config' => $this->config,
            'post' => $post,
            'next_record' => $next_record,
            'previous_record' => $previous_record,
        ]);
    }
}
