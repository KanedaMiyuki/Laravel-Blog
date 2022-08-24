@props(['tagsCsv'])
@php
    $tags = explode(',', $tagsCsv); 
@endphp

<ul class="list-group list-group-horizontal"  style="list-style: none;">
  @foreach ($tags as $tag)
  <li class="me-2">
      <a href="/?tag={{ $tag }}" class="list-group-item list-group-item-info rounded text-decoration-none border border-1">{{ $tag }}</a>
  </li>
  @endforeach
</ul>