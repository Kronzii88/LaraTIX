<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Movie $movies)
    {
        $q = $request->input('q');
        $active = 'Movies';
        $movies = $movies -> when($q, function($query) use ($q) {
            return $query -> where('title', 'like', '%'.$q.'%');
        })
                        ->paginate(10);
        
        //variabel request disini hanya berisi dua array yaitu 'nama' dan 'page' (coba di dd($request))
        $request = $request -> all();
        return view('dashboard/movie/list', [
                                            'movies' => $movies, 
                                            'active' => $active,
                                            'request' => $request,
                                            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active = 'Movies';
        return view('dashboard/movie/form', [
            'active' => $active
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Movie $movie)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|unique:App\Models\Movie,title',
            'description' => 'required',
            'thumbnail' => 'required|image'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('dashboard.movies.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $image = $request -> file('thumbnail');
            $filename = time(). '.'. $image->getClientOriginalExtension();
            Storage::disk('local')->putFileAs('public/movies', $image, $filename); 
            
            $movie->title = $request->title;
            $movie->description = $request->description;
            $movie->thumbnail = $filename;
            $movie->save();
            return redirect ('/dashboard/movies');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        $active = 'Movies';
        // dd($movie);
        return view('dashboard/movie/form', [
            'active' => $active,
            'movie' => $movie,
            'button' => 'Update',
            'url' => 'dashboard.movies.update'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
