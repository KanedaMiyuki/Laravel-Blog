@extends('layouts.app')

@section('content')
   <div class="container">
    <x-card> 
      <form action="{{ route('user.update') }}" method="POST">
        @csrf
        @method('PATCH')
        
          <div class="card-header">
            <h1 class="fw-bold text-center text-white">Edit Profile</h1>
          </div>

          <div class="card-body">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user_detail->name }}" required>
            @error('name')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror

            <label for="email" class="form-label mt-2">{{ __('Email') }}</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user_detail->email }}" required>
            @error('name')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
          </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-success w-100">Update Profile</button>
              <a href="{{ route('user.show') }}" class="btn btn-light w-100 mt-3">Back</a>
            </div>

        </form>
      </x-card>
  </div> 

    
@endsection