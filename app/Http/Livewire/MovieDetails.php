<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Psy\Readline\Hoa\Console;

class MovieDetails extends Component
{
    public $movieId;
    public $movieTitle;

    public $selectedMovieId;
    public $selectedMovieName;

    public function movieshow(){
       $this->movieId = 1;
    }
    public function mount(){
           // get popular movies
        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json()['results'];

            // get genres
        $genresMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];
           
        $genres = collect($genresMovies)->mapWithKeys(function($genre){
            return [$genre['id']=> $genre['name']];
        });
    }

    public function render()
    {

        return view('livewire.movie-details');
    }
}
