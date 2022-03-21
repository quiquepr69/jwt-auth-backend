<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\TheMovieDBGateway;

class MoviesController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $pageNumber = $request['page'];

    $popularMovies = app(TheMovieDBGateway::class)
      ->get('/movie/popular', '?page=' . $pageNumber);

    return $popularMovies;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function trendingMovies(Request $request)
  {
    $pageNumber = $request['page'];

    $trendingMovies = app(TheMovieDBGateway::class)
      ->get('/trending/movie/week', '?page=' . $pageNumber);

    return $trendingMovies;
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function search(Request $request)
  {
    $searchRequest = $request['query'];

    $searchMovies = app(TheMovieDBGateway::class)
      ->get('/search/movie', '?language=en-US&include_adult=false&query=' . $searchRequest);

    return $searchMovies;
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function genre(Request $request)
  {
    $movieGenre = Http::withtoken(config('services.movies.token'))
      ->GET(config('services.movies.url') . '/genre/movie/list')
      ->Json();

    return $movieGenre;
  }
}
