@extends('layouts.app')

@section('content')
    <x-card>
        <div class="card-header">
            <h1 class="fw-bold text-center text-white">Check Inquiries</h1>
        </div>
        <div class="card-body bg-light">
          <form action="/checkInquiries" class="row row-cols-md-auto mt-3">
            <div class="mx-auto">
                <div class="input-group">
                    <div class="input-group-text"><i class="fa fa-search"></i></div>
                    <input type="text" class="form-control" name="inquiry_search" id="inquiry_search" placeholder="Search">
                    <button type="submit" class="btn btn-info">Search</button>
                    
                    <a href="/checkInquiries" class="btn btn-light btn-outline-dark">Reset</a>
                  </div>
            </div>
          </form>
          {{ $inquiries->links() }}
          <table class="table table-light">
            <thead>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Title</th>
              <th>Details</th>
              <th>Responder</th>
            </thead>
              @unless (count($inquiries) == 0)
                
              @foreach ($inquiries as $inquiry)
                  <tr>
                    <td> <a href="{{ route('admin.show', $inquiry->id) }}">{{ $inquiry->id }}</a></td>
                    <td>{{ $inquiry->name }}</td>
                    <td>{{ $inquiry->email }}</td>
                    <td>{{ $inquiry->title }}</td>
                    <td>{{ $inquiry->details }}</td>
                    <td>{{ $inquiry->responder }}</td>
                  </tr>
            @endforeach
            @else
                    <td colspan="6" class="text-center fst-italic fw-bold h5">No Inquiries Found</td>
            @endunless
          </table>
        </div>
    </x-card>
    
@endsection