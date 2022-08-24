@extends('layouts.app')

@section('content')
    <x-card>
        <div class="card-header">
            <h1 class="fw-bold text-center text-white">Account Administration</h1>
        </div>
        <div class="card-body bg-light">
          <form action="/addAdmin" class="row row-cols-md-auto mt-3">
            <div class="mx-auto">
                <div class="input-group">
                    <div class="input-group-text"><i class="fa fa-search"></i></div>
                    <input type="text" class="form-control" name="user_search" id="user_search" placeholder="Enter ID or Name here">
                    <button type="submit" class="btn btn-info">Search</button>
                    
                    <a href="/addAdmin" class="btn btn-light btn-outline-dark">Reset</a>
                  </div>
            </div>
          </form>
          {{ $users->links() }}
          <table class="table table-light">
            <thead>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th></th>
              <th></th>
            </thead>
            
              @foreach ($users as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                @if ($user->ban == 0)
                  @if ($user->usertype == 1)
                      <td><h4>Admin</h4></td>
                  @else
                      <form action="{{ route('admin.suspended', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <td>
                          <button type="submit" class="btn btn-danger">Suspended</button>
                        </td>
                      </form>
                  @endif

                @else 

                    <form action="{{ route('admin.reversed', $user->id) }}" method="POST">
                      @csrf
                      @method('PATCH')
                      <td>
                        <button type="submit" class="btn btn-warning">Reversed</button></td>
                    </form>
                @endif
                @endforeach
            </tr>
          </table>
        </div>
    </x-card>
@endsection