@extends('layouts.app')

@section('content')

<div class="container">
    <x-card> 
        <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

        <div class="card-header text-center">
          <h3>Edit Post</h3>
        </div>
        <div class="card-body">
            <label for="title" class="form-label">{{ __('Title') }}</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}" required>
            @error('title')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror

            <label for="body" class="form-label mt-2">{{ __('Body') }}</label>
            <textarea name="body" id="body" cols="30" rows="10" class="form-control" required>{{ $post->body }}</textarea>
            @error('body')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror

            <label for="tags" class="form-label mt-2">
                Tags (Comma Separated)
            </label>
            <input type="text" class="form-control" name="tags" placeholder="Example: Laravel, Backend, Postgres, etc"  value="{{ $post->tags }}" required>
            @error('tags')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror

            <label for="image" class="form-label mt-4">{{ __('Image') }}</label>
            @if ($post->image)
            <img src="{{ asset('/storage/images/'. $post->image)}}" alt="{{ $post->image }}" style="width: 40%;">
            @endif
            <input type="file" name="image" id="image" class="form-control">
            @error('image')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success w-100">Update Post</button>
            <a href="/posts/myposts" class="btn btn-light w-100 mt-3">Back</a>
        </div>  
        </form>    
    </x-card>       
</div>

@endsection