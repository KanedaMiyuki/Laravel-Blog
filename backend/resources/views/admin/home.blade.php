@extends('layouts.app')

@section('content')
    <x-card>
        <div class="card-header">
            <h1 class="fw-bold text-center text-white">Admin Page</h1>
        </div>
        <div class="card-body mx-auto">
            <ul>
                <li class="mb-2"><a href="{{ route('admin.addAdmin') }}" class="h4">Add Admin</a></li>
                <li class="mb-2"><a href="{{ route('admin.index') }}" class="h4">Check Inquiries</a></li>
                <li class="mb-2"><a href="{{ route('admin.account') }}" class="h4">Account Administration</a></li>
            </ul>
        </div>
    </x-card>
@endsection