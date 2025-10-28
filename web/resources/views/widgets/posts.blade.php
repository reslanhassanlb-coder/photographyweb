


<div class="row">
    <div class="col-lg-8">
      <h2 class="title">
        <a href="#">{{$post[0]->title}}</a>
      </h2>
      <div class="d-flex align-items-center details-post-data">
        <div class="post-meta d-flex">
          <p class="post-author">{{$post[0]->author}}</p>
          <p class="post-sperator"> - </p>
          <p class="post-date">
            <time datetime="2023-01-01">{{ $post[0]->created_at->format('M d, Y') }}</time>
          </p>
        </div>
      </div>
      
      {!! html_entity_decode($post[0]->description) !!}
      
      <div class="d-flex justify-content-between mt-20">
       
        
        @if ( $previous_record)
        <button type="submit" data-text="Send Message" onclick="window.location.href='{{route('blog-details',[$previous_record->id,$previous_record->category_id])}}'" class="fill-btn"`>Previos Post</button> 
        @else
        <button type="submit" data-text="Send Message" disabled class="fill-btn-not-allowed" style="cursor:not-allowed; ">Previos Post</button> 
        @endif
        
        @if ( $next_record )
        <button type="submit" data-text="Send Message" onclick="window.location.href='{{route('blog-details',[$next_record->id,$next_record->category_id])}}'" class="fill-btn">Next Post</button>
        @else
        <button type="submit" data-text="Send Message" disabled class="fill-btn-not-allowed" style="cursor:not-allowed; ">Next Post</button> 
        @endif
        
      </div>
  </div>


