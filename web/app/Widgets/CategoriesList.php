<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Models\Categories;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;

class CategoriesList extends AbstractWidget
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
       // $categories= Categories ::All();

        $categories= Categories ::select('categories.name as name',DB::raw('count(posts.id) as count'))->groupBy('categories.name')->leftJoin('posts',function ($join){
            $join->on('categories.id','=','posts.category_id');
        })->get();

        return view('widgets.categories_list', [
            'config' => $this->config,
            'categories'=>$categories,
        ]);
    }
}
