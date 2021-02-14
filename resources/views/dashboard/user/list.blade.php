@extends('layouts/dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-8">
                <h3>Users</h3>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table">
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
                <tr>
                    @foreach($users as $user)
                    <td>1</td>
                    <td>{{$user -> name}}</td>
                    <td>{{$user -> email}}</td>
                    <td>{{$user -> created_at}}</td>
                    <td>{{$user -> updated_at}}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
