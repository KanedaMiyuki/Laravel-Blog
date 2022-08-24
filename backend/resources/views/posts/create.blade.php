@extends('layouts.app')

@section('content')

<div class="container">
    <x-card> 
        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            
        <div class="card-body">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            @error('title')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror

            <label for="body" class="form-label mt-2">Body</label>
            <textarea name="body" id="body" cols="30" rows="10" class="form-control" required>{{ old('body') }}</textarea>
            @error('body')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror

            <label for="tags" class="form-label mt-2">
                Tags (Comma Separated)
            </label>
            <input type="text" class="form-control" name="tags" placeholder="Example: Laravel, Backend, Postgres, etc"  value="{{ old('tags') }}" required>
            @error('tags')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror

            <label for="image" class="form-label mt-4">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success w-100">Submit</button>
            <a href="/" class="btn btn-light w-100 mt-3">Back</a>
        </div>  
        </form>    
    </x-card>       
</div>

@endsection