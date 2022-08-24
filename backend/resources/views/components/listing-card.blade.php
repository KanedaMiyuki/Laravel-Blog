  @props(['post'])

<x-card>
    <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-white">

          @if ($post->image)
          <img src="{{ asset('/storage/images/'. $post->image) }}" alt="{{ $post->image }}" class="card-img-top text-center" style="width: 40%;">
          @else
          <div class="card-img-top">
            <i class="fa-solid fa-image ms-3" style="font-size: 800%;"></i>
          </div>
          @endif
          
          <div class="card-header">
            <p class="display-4">{{ $post->title }}</p>
          </div>
          <div class="card-body">
                <h3>{!! \Michelf\Markdown::defaultTransform($post->body) !!}</h3>

          </div>
          <div class="card-body">
            <x-listing-tags :tagsCsv="$post->tags" />

          </div>
          {{-- <div class="card-footer">
              <p>written by {{ Auth::user()->name }} </p>
          </div> --}}
  </a>
</x-card>