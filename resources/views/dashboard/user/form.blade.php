@extends('layouts/dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-8">
                <h3>Form User</h3>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form method="post" action="{{url('dashboard/user/update/'.$user->id)}}">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="name" value="{{$user -> name}}">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="{{$user -> email}}">
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
