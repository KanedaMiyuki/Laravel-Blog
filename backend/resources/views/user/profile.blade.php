@extends('layouts.app')

@section('content')
   <div class="container mt-3">
      <div class="card w-50 mx-auto bg-dark text-white">
        <div class="card-header">
          <h1 class="fw-bold text-center text-white">Profile</h1>
        </div>

        <div class="card-body">
          <div class="row">
                <h4 class="col-md-5 text-md-end pt-3">{{ __('Name') }}</h4>
                <h2 class="fw-bold col-md-7 pt-2">{{ $user_detail->name }}</h2>
          </div>

          <div class="row mt-2">
                <h3 class="col-md-3 text-md-end offset-2">{{ __('Email') }}</h3>
                <h3 class="col-md-7">{{ $user_detail->email }}</h3>
          </div>

          </div>
          <div class="card-footer">
              <a href="{{ route('user.edit') }}" class="btn btn-success w-100 mb-2" title="Edit Profile">Edit <i class="fa-solid fa-user-pen"></i></a>
              <a href="/" class="btn btn-light mb-2 w-100"> {{ __('Back')}} </a>
          </div>
        </div>
      </div>
      <div class="card w-75 mx-auto mt-5">
        <div class="card-header text-center">
          <h5>Inquiries</h5>
        </div>
        <table class="table table-light">
          <thead>
            <th>#</th>
            <th>Title</th>
            <th>Details</th>
            <th>Created At</th>
          </thead>

            @unless (count($inquiries) == 0)
              @foreach ($inquiries as $inquiry)
              <tr>
                <td>{{ $inquiry->id }}</td>
                <td>{{ $inquiry->title }}</td>
                <td>{{ $inquiry->details }}</td>
                <td>{{ $inquiry->created_at->format('Y/m/d h:i') }}</td>
              </tr>
              @endforeach

              @else
                <td colspan="4" class="text-center fst-italic fw-bold h5">No Inquiries Found</td>
            @endunless

        </table>
      </div>
  </div> 

    
@endsection