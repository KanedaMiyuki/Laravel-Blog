@extends('layouts.app')

@section('content')
   <div class="container">
    <x-card> 
      <form action="{{ route('user.store') }}" method="POST">
        @csrf
        
          <div class="card-header">
            <h1 class="fw-bold text-center text-white">Inquiry</h1>
          </div>

          <div class="card-body">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control" required>
            @error('name')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror

            <label for="email" class="form-label mt-2">{{ __('Email') }}</label>
            <input type="email" name="email" id="email" class="form-control" required>
            @error('name')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror

            <label for="title">Title</label>
            <select name="title" id="title" class="form-select" required>
              <option value="" selected disabled>Choose from here</option>
              <option value="U/I" >About U/I</option>
              <option value="Account" >About Account</option>
              <option value="Other" >Other</option>
            </select>

            <label for="details"class="form-label mt-2">{{ __('Details') }}</label>
            <textarea name="details" id="details" cols="30" rows="10" class="form-control" required></textarea>
            @error('details')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror

          </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-info w-100">Submit</button>
              <a href="/" class="btn btn-light w-100 mt-3">Back</a>
            </div>

        </form>
      </x-card>
  </div> 

    
@endsection