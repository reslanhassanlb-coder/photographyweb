<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Models\Post;
class RecentPosts extends AbstractWidget
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

        $search = request('search');

        //
       //$posts = Post::orderBy('created_at','desc')->take(3)->get();
       if( isset(  $search ) ) 
       {
        $posts = Post::query()->leftJoin('categories','posts.category_id','=','categories.id')
        ->leftJoin('users','posts.author_id','=','users.id')
        ->select('posts.id','posts.category_id','posts.title','posts.description','posts.image_alt','posts.image','posts.created_at','categories.name','users.name as author')
        ->where('title', 'like', '%' . $search . '%')
        ->orderBy('posts.created_at','desc')
        ->get();
       }
       else{

        $posts = Post::query()->leftJoin('categories','posts.category_id','=','categories.id')
        ->leftJoin('users','posts.author_id','=','users.id')
        ->select('posts.id','posts.category_id','posts.title','posts.description','posts.image_alt','posts.image','posts.created_at','categories.name','users.name as author')
        ->orderBy('posts.created_at','desc')
        ->get();

       }

      

        return view('widgets.recent_posts', [
            'config' => $this->config,
            'posts' => $posts,
        ]);
    }
}
