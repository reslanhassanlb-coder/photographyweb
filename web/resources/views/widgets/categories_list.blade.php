

@foreach($categories as $key => $category)
<li><a href="#"><i class="bi bi-arrow-right-circle-fill"></i> {{$category->name}}  ({{$category->count}})</a></li>
@endforeach