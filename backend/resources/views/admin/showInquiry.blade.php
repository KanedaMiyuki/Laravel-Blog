@extends('layouts.app')

@section('content')
    <x-card>
        <div class="card-header">
            <h1 class="fw-bold text-center text-white">Inquiry Detail</h1>
        </div>
        <div class="card-body bg-light text-dark">
          <h4>Name: <strong>{{ $inquiry->name}}</strong></h4>
          <h4>Email: <strong>{{ $inquiry->email}}</strong></h4>
          <h4>Title: <strong>{{ $inquiry->title}}</strong></h4>
          <h4>Details: <br>{{ $inquiry->details}}</h4>
          <br>
          <h4>Responder: <strong>{{ $inquiry->responder}}</strong></h4>
          <h4>Updated At: <strong>{{ $inquiry->updated_at->format('Y/m/d h:i') }}</strong></h4>
        </div>
        <div class="card-footer bg-light">
          <a href="{{ route('admin.respondInquiry', $inquiry->id) }}" class="btn btn-success w-100">Respond</a>
          <a href="/checkInquiries" class="btn btn-outline-dark w-100 mt-3">Back</a>
        </div>
    </x-card>
@endsection