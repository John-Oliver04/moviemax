<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json()['results'];

        $genresMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];
           

        $genres = collect($genresMovies)->mapWithKeys(function($genre){
            return [$genre['id']=> $genre['name']];
        });
//  dump($genres);
        return view('app',
                    [
                        'popularMovies' => $popularMovies,
                        'genres' => $genres,
                    ]);
    }

    public function show()
    {

    }
}
