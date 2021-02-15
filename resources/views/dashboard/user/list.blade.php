@extends('layouts/dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-8">
                <h3>Users</h3>
            </div>
            <div class="col-4">
                <form action={{url('dashboard/users')}} method=get>
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Search" name="nama" value={{$request['nama'] ?? ''}}>
                        <button class="btn btn-outline-success sm" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Registered</th>
                    <th>Edited</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    {{-- loop iteration untuk penomoran 1,2,3,dst --}}
                    <td>{{($users->currentPage() - 1) * $users->perPage() + $loop->iteration}}</td>
                    <td>{{$user -> name}}</td>
                    <td>{{$user -> email}}</td>
                    <td>{{$user -> created_at}}</td>
                    <td>{{$user -> updated_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- syntax blade untuk pagination (sudah dibuat di UserController pagination ada 10) --}}
        {{$users -> appends($request) -> links()}}
    </div>
</div>

@endsection
