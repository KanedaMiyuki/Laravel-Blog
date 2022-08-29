@extends('layouts.app')

@section('content')

  <h1 class="text-center mt-3">My Posts</h1>


<table class="table w-50 mx-auto mt-5">
  <thead class="table-dark text-center">
    <tr>
      <th>#</th>
      <th>Title</th>
      <th>Date</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @unless ($posts->isEmpty())
    @foreach ($posts as $post)
      <tr class="">
          <td class="text-center">
              <h4 class="mt-3">{{ $post->id }}</h4>              
          </td>
          <td class="fs-1 fw-bold text-center">
              <a href="/posts/{{ $post->id }}" class="text-decoration-none text-dark">
                  {{ $post->title }}
              </a>
          </td>
          <td class="text-center pt-4">
            {{ $post->updated_at->format('Y/m/d')}}
          </td>
          <td class="text-center">
              <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info mt-2"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
          </td>
          <td>
              <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger mt-2" type="submit"onclick="return confirm('Are you sure to delete No: {{ $post->id }}?')"><i class="fa-solid fa-trash"></i> Delete</button>
            </form>
          </td>
      </tr>
      @endforeach
      @else
          <tr class="border-gray-300">
            <td class="fst-italic fs-2" colspan="4">
              <p class="text-center">No Listings Found</p>
            </td>
          </tr>
      @endunless
  </tbody>
</table>
@endsection