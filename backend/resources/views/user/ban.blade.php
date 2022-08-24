@extends('layouts.app')

@section('content')
<x-card class="mt-5">
  <div class="card-body text-center bg-warning">
    <h6 class="text-dark">Your Account has been Banned</h6>
    <h1 class="text-danger"><i class="fa-solid fa-ban"></i></h1>
    <a href="{{ route('user.inquiry') }}" class="btn btn-dark w-50">Inquiry</a>
  </div>
</x-card>
@endsection