<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use App\Models\blog;
use App\Models\Tag;
use App\Models\BlogCategory;
use App\Models\VisitorProfile;
use App\Models\VisitorLog;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $profile = VisitorProfile::where('visitor_uuid', session('visitor_uuid'))->first();
        $allBlogs = Blog:: paginate(6);
        $totalPostCount = Blog::count();
        $categories = BlogCategory::withCount('blogs')->get();
        $featuredBlogs = Blog::where('is_featured', true)->latest()->take(3)->get();

        SEOMeta::setTitle('Our Latest Blog Posts | Hassan Reslan Photography');
        SEOMeta::setDescription('Stay up-to-date with expert tips, ultimate checklists, and industry news on event photography, wedding preparation, and professional services in Lebanon.');

        SEOMeta::addKeyword([
            'wedding photography blog Lebanon',
            'event photographer tips Lebanon',
            'Hassan Reslan blog',
            'photography industry news'
            ]);
        SEOMeta::setCanonical(url()->current());


        // OpenGraph
        OpenGraph::setTitle('Hassan Reslan Photography Blog: Latest Posts');
        OpenGraph::setDescription('Expert tips and news on event photography, wedding planning, and professional photo services in Lebanon.');
        OpenGraph::setUrl(url()->current());
        // CRITICAL: Type should be 'website' for a listing page
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addImage(asset('assets/images/hero.png'));


         // JSON-LD
        JsonLd::setTitle('Our Latest Blog Posts | Hassan Reslan Photography');
        JsonLd::setDescription('Expert tips and news on event photography, wedding planning, and professional photo services in Lebanon.');
        JsonLd::setUrl(url()->current());
        JsonLd::setType('Article');
        JsonLd::addImage(asset('assets/images/hero.png'));

        return view('blog',[
            'profile' => $profile,
            'allBlogs' => $allBlogs,
            'categories' => $categories,
            'featuredBlogs' => $featuredBlogs,
            'currentCategory' => null,
            'totalPostCount'=> $totalPostCount,
        ]);
    }

    public function indexByCategory($slug)
    {
        $profile = VisitorProfile::where('visitor_uuid', session('visitor_uuid'))->first();
        // 1. Find the Category based on the slug
        $category = BlogCategory::where('slug', $slug)->firstOrFail();

        // 2. Filter the featured blogs by the current category's ID
        $featuredBlogs = $category->blogs()
                              ->where('is_featured', true)
                              ->latest()
                              ->take(3)
                              ->get();

        // 3. Get the paginated blogs related to that category
        $allBlogs = $category->blogs()->paginate(6);

        // 4. Get other sidebar data
        $categories = BlogCategory::withCount('blogs')->get();
        // ... $featuredBlogs, etc.

         //$totalPostCount = Blog::count();

        // 5. Return the view with the filtered data
        return view('blog', [
            'profile'=> $profile,
            'allBlogs' => $allBlogs,
            'categories' => $categories,
            'currentCategory' => $category, // Useful for displaying the current filter
            'featuredBlogs' => $featuredBlogs,
        ]);
    }

    public function indexByTag($slug)
    {

        $profile = VisitorProfile::where('visitor_uuid', session('visitor_uuid'))->first();

        // 1. Find the Tag based on the slug, or fail
        $tag = Tag::where('slug', $slug)->firstOrFail();

        // 2. Get the paginated blogs related to that tag
        // This uses the 'blogs()' relationship defined in your Tag model.
        $allBlogs = $tag->blogs()
                    ->latest()
                    ->paginate(6)
                    ->withQueryString();

        // 3. Gather sidebar data for consistent layout
        $categories = BlogCategory::withCount('blogs')->get();
        $totalPostCount = Blog::count();
        $featuredBlogs = Blog::where('is_featured', true)->latest()->take(3)->get();

        // 4. Return the standard blog view with the filtered data
        return view('blog', [
            'profile'=> $profile,
            'allBlogs' => $allBlogs,
            'categories' => $categories,
            'featuredBlogs' => $featuredBlogs,
            'totalPostCount' => $totalPostCount,
            'currentTag' => $tag, // Pass the current tag for view feedback
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $profile = VisitorProfile::where('visitor_uuid', session('visitor_uuid'))->first();

        // 1. Find the current blog post using route model binding/slug
        $blog = Blog::where('slug', $slug)->firstOrFail();

        $seoDescription = $blog->meta_description ?? $blog->description;
        $imagePath = asset('storage/app/public/' . $blog->image);
        $keywords = $blog->tags->pluck('name')->toArray();
        $keywords[] = $blog->blogCategory->name;

        // ----------------------------------------------------
        // 3. SEOMeta (Basic SEO Tags)
        // ----------------------------------------------------
        SEOMeta::setTitle($blog->title . ' | Hassan Reslan Photography');
        SEOMeta::setDescription($seoDescription);
        SEOMeta::addKeyword($keywords);
        SEOMeta::setCanonical(url()->current());

        // ----------------------------------------------------
        // 4. OpenGraph (Facebook, LinkedIn, Social Previews)
        // ----------------------------------------------------
        OpenGraph::setTitle($blog->title);
        OpenGraph::setDescription($seoDescription);
        OpenGraph::setUrl(url()->current());
        // CRITICAL: Type must be 'article' for a single blog post
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addImage($imagePath);

        // Set article-specific properties (optional but recommended)
        OpenGraph::addProperty('article:published_time', $blog->created_at->toIso8601String());
        OpenGraph::addProperty('article:author', $blog->author->name);

        // ----------------------------------------------------
        // 5. TwitterCard (Twitter Previews)
        // ----------------------------------------------------
        TwitterCard::setTitle($blog->title);
        TwitterCard::setDescription($seoDescription);
        TwitterCard::setImage($imagePath);
        //TwitterCard::setSite('@YourTwitterHandle'); // Replace with your actual handle

        // ----------------------------------------------------
        // 6. JSON-LD (Structured Data Schema) - Using correct addValue() methods
        // ----------------------------------------------------
        JsonLd::setTitle($blog->title);
        JsonLd::setDescription($seoDescription);
        JsonLd::setUrl(url()->current());
        JsonLd::setType('Article'); // CRITICAL: Identify as a structured article
        JsonLd::addImage($imagePath);


        // 2. Fetch Related Blogs (Excluding the current one, within the same category)
        $relatedBlogs = Blog::where('blog_category_id', $blog->blog_category_id)
                            ->where('id', '!=', $blog->id) // Exclude the current blog
                            ->latest()
                            ->take(4) // Get 4 related posts
                            ->get();

        // 3. Fetch Sidebar Data (If needed, for a full sidebar)
        $categories = BlogCategory::withCount('blogs')->get();

        return view('blog-details', [
            'profile'=>$profile,
            'blog' => $blog,
            'relatedBlogs' => $relatedBlogs,
            'categories' => $categories, // Passed if you include the categories widget
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function search(Request $request)
    {
           // Get the search query from the request
            $query = $request->input('query');

            // 1. Search Logic: Filter by title OR description (or both)
            $allBlogs = Blog::where('title', 'like', '%' . $query . '%')
                            ->orWhere('description', 'like', '%' . $query . '%')
                            ->latest() // Order by newest posts first
                            ->paginate(6)
                            ->withQueryString(); // Keeps the search query in the pagination links

            // 2. Sidebar Data (Required for consistent layout)
            $categories = BlogCategory::withCount('blogs')->get();
            $totalPostCount = Blog::count();
            // Assuming $featuredBlogs is handled as previously discussed
            $featuredBlogs = Blog::where('is_featured', true)->latest()->take(3)->get();

            // 3. Return the view
            return view('blog', [
                'allBlogs' => $allBlogs,
                'categories' => $categories,
                'featuredBlogs' => $featuredBlogs,
                'totalPostCount' => $totalPostCount,
                'searchQuery' => $query, // Pass the query back to the view
            ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
