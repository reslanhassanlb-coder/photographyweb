<section id="gallery" class="bg-light">
        <div class="container">
            <h2 class="text-center animate-on-scroll" style="margin-bottom: 25px;">Gallery of Moments</h2>
            <div class="filter-controls animate-on-scroll">
                 <button class="filter-btn active" data-filter="all">All</button>
                @foreach($categories as $category )
                    <button class="filter-btn" data-filter="{{ $category->name }}">{{ ucfirst($category->name) }}</button>
                 @endforeach
            </div>
            <div class="gallery-grid" >
                @foreach($posts as $post )
                    <div class="gallery-item wedding animate-on-scroll" style="--a-delay: 0.1s;"  data-category="{{ $post->category->name }}">
                         <a href="{{asset( 'storage/app/public/'. $post->image)}}">
                            <img src="{{asset( 'storage/app/public/'. $post->image)}}" alt="{{$post->image_alt}}" title="{{$post->image_alt}}" loading="lazy">
                            <!--<div class="image-overlay">{{ ucfirst($post->category->name) }}</div>-->
                            <div class="image-overlay">
                                <span>{{ ucfirst($post->title) }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
