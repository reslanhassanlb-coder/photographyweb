

@foreach($posts as $key => $post)
    <li><a href="{{route('blog-details',[$post->id,$post->category_id])}}"><i class="bi bi-arrow-right-circle-fill"></i>  {{substr($post->title,0,26)}}...</a></li>
@endforeach

