@extends('layouts.app')

@section('content')
<div class="mt-4 p-4">
    {{ $posts->links() }}
</div>
@unless (count($posts) == 0)
    @foreach($posts as $post)

    <div class="container">
        <x-listing-card :post="$post" />       
    </div>
    @endforeach
@else
    <p>No Posts Found</p>
@endunless

@endsection