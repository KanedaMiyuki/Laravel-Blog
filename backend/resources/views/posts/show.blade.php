@extends('layouts.app')

@section('content')
<div class="row mt-3">
    <div class="col-md-6 offset-md-3">
        <a href="/" class="text-decoration-none text-center text-dark fs-5 fw-bold"><i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>
</div>


<div class="mx-4">    
  <x-card>
        @if ($post->image)
        <img src="{{ asset('/storage/images/'. $post->image) }}" alt="{{ $post->image }}" class="card-img-top text-center" style="width: 40%;">
        @else
        <div class="card-img-top">
        <i class="fa-solid fa-image ms-3" style="font-size: 800%;"></i>
        </div>
        @endif

        <div class="card-header">
            <p class="display-4">{{ $post->title }}</p>
            <p>written by  {{ $user->name }}</p>

        </div>

        <div class="card-body">
            <h3>{!! \Michelf\Markdown::defaultTransform($post->body) !!}</h3>
        </div>

        <div class="card-body">
            <x-listing-tags :tagsCsv="$post->tags" />
        </div>

        <div class="card-footer">
            
            <form action="{{ route('comment.store') }}" class="row row-cols-md-auto mt-3">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <input type="hidden" name="name" value="{{ Auth::user()->name }}">

                <label for="comment" class="form-label text-center">{{__('Comment')}}</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="comment" id="comment" placeholder="Comment here...">
                    <button type="submit" class="btn btn-info">Add comment</button>
                </div>
           </form>
           
            <div>
                @unless (count($comments) == 0)
                    @foreach($comments as $comment)
                        <hr>
                        <h5>{{ $comment->comment }}</h5>
                        
                        <p><strong>{{ $comment->name }}</strong> &middot; {{ $comment->created_at->format('Y/m/d') }}
                        </p>
                        @if ($comment->user_id == Auth::user()->id)
                            <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</button>
                            </form>
                        @endif
                    @endforeach
                @else
                    <p>No Comments Found</p>
                @endunless
            </div>
        </div>

    </x-card>
</div>
@endsection