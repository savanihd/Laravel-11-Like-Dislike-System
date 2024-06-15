@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style type="text/css">
    i{
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Posts List') }}</div>

                <div class="card-body">
                    
                    <div class="row">
                        @foreach($posts as $post)
                        <div class="col-md-3">
                            <div class="card mt-2" style="width: 18rem;">
                              <img src="https://picsum.photos/id/0/367/267" class="card-img-top" alt="...">
                              <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <div class="like-box">
                                    <i id="like-{{ $post->id }}" 
                                        data-post-id="{{ $post->id }}"
                                        class="like fa-thumbs-up {{ auth()->user()->hasLiked($post->id) ? 'fa-solid' : 'fa-regular' }}"></i> 
                                    <span class="like-count">{{ $post->likes->count() }}</span>
                                    <i id="like-{{ $post->id }}" 
                                        data-post-id="{{ $post->id }}"
                                        class="dislike fa-thumbs-down {{ auth()->user()->hasDisliked($post->id) ? 'fa-solid' : 'fa-regular' }}"></i> 
                                    <span class="dislike-count">{{ $post->dislikes->count() }}</span>
                                </div>
                              </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $(document).ready(function() {     

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.like-box i').click(function(){    
            var id = $(this).attr('data-post-id');
            var boxObj = $(this).parent('div');
            var c = $(this).parent('div').find('span').text();
            var like = $(this).hasClass('like') ? 1 : 0;

            $.ajax({
               type:'POST',
               url: "{{ route('posts.ajax.like.dislike') }}",
               data:{ id:id, like:like },
               success:function(data){

                    if (data.success.hasLiked == true) {

                        if($(boxObj).find(".dislike").hasClass("fa-solid")){
                            var dislikes = $(boxObj).find(".dislike-count").text();
                            $(boxObj).find(".dislike-count").text(parseInt(dislikes)-1);
                        }

                        $(boxObj).find(".like").removeClass("fa-regular");
                        $(boxObj).find(".like").addClass("fa-solid");

                        $(boxObj).find(".dislike").removeClass("fa-solid");
                        $(boxObj).find(".dislike").addClass("fa-regular");

                        var likes = $(boxObj).find(".like-count").text();
                        $(boxObj).find(".like-count").text(parseInt(likes)+1);

                    } else if(data.success.hasDisliked == true){

                        if($(boxObj).find(".like").hasClass("fa-solid")){
                            var likes = $(boxObj).find(".like-count").text();
                            $(boxObj).find(".like-count").text(parseInt(likes)-1);
                        }

                        $(boxObj).find(".like").removeClass("fa-solid");
                        $(boxObj).find(".like").addClass("fa-regular");

                        $(boxObj).find(".dislike").removeClass("fa-regular");
                        $(boxObj).find(".dislike").addClass("fa-solid");

                        var dislike = $(boxObj).find(".dislike-count").text();
                        $(boxObj).find(".dislike-count").text(parseInt(dislike)+1);
                    } else {
                        if($(boxObj).find(".dislike").hasClass("fa-solid")){
                            var dislikes = $(boxObj).find(".dislike-count").text();
                            $(boxObj).find(".dislike-count").text(parseInt(dislikes)-1);
                        } 

                        if($(boxObj).find(".like").hasClass("fa-solid")){
                            var likes = $(boxObj).find(".like-count").text();
                            $(boxObj).find(".like-count").text(parseInt(likes)-1);
                        }

                        $(boxObj).find(".like").removeClass("fa-solid");
                        $(boxObj).find(".like").addClass("fa-regular");

                        $(boxObj).find(".dislike").removeClass("fa-solid");
                        $(boxObj).find(".dislike").addClass("fa-regular");

                    }
               }
            });

        });   

    }); 
</script>
@endsection