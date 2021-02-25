@extends('layouts/dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-8 align-self-center">
                <h3>Users</h3>
            </div>
            <div class="col-4">
                <form action={{route('dashboard.movies')}} method=get>
                    <div class="input-group">
                        {{-- pada atribut value terdapat operator null coalescing/ternary yang hanya ada pada php7 --}}
                        <input class="form-control" type="search" placeholder="Search" name="nama" value={{$request['nama'] ?? ''}}>
                        <button class="btn btn-outline-success sm" type="submit"><i class="fas fa-search"></i></button>
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
                    <th>title</th>
                    <th>thumbnail</th>
                    {{-- nilai kosong pada tabel --}}
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movies as $movie)
                <tr>
                    {{-- loop iteration untuk penomoran 1,2,3,dst --}}
                    <th scope="row">{{($movies->currentPage() - 1) * $movies->perPage() + $loop->iteration}}</th>
                    <td>{{$movie -> title}}</td>
                    <td>{{$movie -> email}}</td>
                    <td> 
                        <a href="{{ route('dashboard.movie.edit', ['id' => $user->id])}}" class="btn btn-success btn-sm"> 
                            <i class="fas fa-pen"></i>
                        </a> 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- syntax blade untuk pagination (sudah dibuat di UserController pagination ada 10) --}}
        {{$movies -> appends($request) -> links()}}
    </div>
</div>

@endsection
