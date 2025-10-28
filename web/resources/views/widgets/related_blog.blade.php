<div class="blog-title">
    <h2>{{__('customlang.related_blog')}}</h2>
</div>

@if($relatedposts->count() >0 )

@foreach($relatedposts as $key => $rb)
    <div class="col-lg-6 wow fadeInUp animated">
        <div class="related-blog-single-box">
            <div class="blog-box-thumb">
                <img src="{{asset( 'storage/app/public/'. $rb->image)}}" alt="thumb">
            </div>
            <div class="blog-content">
                <div class="blog-box-date">
                    <h5><i class="far fa-calendar-alt"></i>{{$rb->created_at}}</h5>
                </div>
                <div class="blog-box-title">
                    <a href="{{route('blog-details',[$rb->id,$rb->category_id])}}">{{$rb->title}}</a>
                </div>
                <div class="blog-box-footer">
                    <div class="posted-by">
                        <a href="#"><i class="far fa-user"></i> John Doe</a>
                    </div>
                    <div class="post-comment">
                        <!--<a href="#"><i class="far fa-comment-alt"></i> 0 Comments</a>-->
                    </div>
                    <div class="related-box-btn">
                        <a href="blog.html"><i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
@else
    <div class="col-lg-6 wow fadeInUp animated">
    <h5 class="h5-related">{{__('customlang.no_related_blod')}}</h5>
    </div>
@endif

