<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Blog;
use App\Models\Package;
use App\Models\Categories;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Sitemap::create();

        // Static pages
        $sitemap->add(Url::create('/')->setLastModificationDate(now())->setChangeFrequency('weekly')->setPriority(1.0));
        $sitemap->add(Url::create('/#about')->setLastModificationDate(now())->setChangeFrequency('monthly')->setPriority(0.8));
        $sitemap->add(Url::create('/#contact')->setLastModificationDate(now())->setChangeFrequency('monthly')->setPriority(0.8));
        $sitemap->add(Url::create('/#packages')->setChangeFrequency('monthly')->setPriority(0.8));
        $sitemap->add(Url::create('/#services')->setChangeFrequency('monthly')->setPriority(0.8));
        $sitemap->add(Url::create('/#gallery')->setChangeFrequency('monthly')->setPriority(0.8));
        $sitemap->add(Url::create('/#blogs')->setChangeFrequency('weekly')->setPriority(0.8));

        // Blog posts
        Blog::all()->each(function ($blog) use ($sitemap) {
            $sitemap->add(
                Url::create(route('blog.show', $blog->slug))
                    ->setLastModificationDate($blog->updated_at)
                    ->setChangeFrequency('weekly')
                    ->setPriority(0.7)
            );
        });

        // Packages
        Package::all()->each(function ($package) use ($sitemap) {
            $sitemap->add(
                Url::create(route('offers', $package->id))
                    ->setLastModificationDate($package->updated_at)
                    ->setChangeFrequency('monthly')
                    ->setPriority(0.7)
            );
        });


        return $sitemap->toResponse(request());
    }
}
