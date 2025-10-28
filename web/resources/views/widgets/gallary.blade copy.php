<!-- Filter Buttons -->
  <div class="filter-btns">
    <button class="filter-btn active" onclick="filterGallery('all', this)">All</button>
     @foreach($categories as $category )
        <button class="filter-btn" onclick="filterGallery('{{$category->name}}', this)">{{$category->name}}</button>
     @endforeach
  </div>
  <!-- Masonry Gallery -->
 <div id="gallery" class="masonry">
   @foreach($posts as $post )
     <div class="masonry-item" data-category="{{$post->name}}">
      <a href="{{asset( 'storage/app/public/'. $post->image)}}">
        <!--<img src="{{asset('images/4B5A0414.JPG')}}" alt="Wedding">-->
        <img src="{{asset( 'storage/app/public/'. $post->image)}}" alt="{{$post->image_alt}}" title="{{$post->image_alt}}" class="img-fluid">
        <div class="caption">{!! $post->title !!}</div>
      </a>
    </div>
   @endforeach
 </div>
