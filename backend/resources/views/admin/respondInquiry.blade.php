@extends('layouts.app')

@section('content')
   <div class="container">
    <x-card> 
      <form action="{{ route('admin.updateInquiry', $inquiry->id) }}" method="POST">
        @csrf
        @method('PATCH')
          <div class="card-header">
            <h1 class="fw-bold text-center text-white">Respond Inquiry</h1>
          </div>

          <div class="card-body">
            <h5>Name: <strong>{{ $inquiry->name}}</strong></h5>
            <h5>Email: <strong>{{ $inquiry->email}}</strong></h5>
            <h5>Title: <strong>{{ $inquiry->title}}</strong></h5>
            <h5>Details: <br>{{ $inquiry->details}}</h5>

            <label for="details"class="form-label mt-2">{{ __('Details') }}</label>
            <textarea name="details" id="details" cols="30" rows="10" class="form-control" required autofocus>Inquey No. {{ $inquiry->id }}  /  Details: {{ $inquiry->details }}
            </textarea>
            @error('details')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror

          </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-info w-100">Submit</button>
              <a href="/showInquiry/{{ $inquiry->id }}" class="btn btn-light w-100 mt-3">Back</a>
            </div>

        </form>
      </x-card>
  </div> 

    
@endsection