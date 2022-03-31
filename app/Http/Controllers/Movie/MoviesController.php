<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\TheMovieDBGateway;
use GuzzleHttp\Psr7\Query;

class MoviesController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {

    $parameters = $this->validate($request, [
      'page' => 'integer|required'
    ]);

    $query = [
      'page' => $parameters['page'],
    ];

    $pageNumber = Query::build(array_filter($query), PHP_QUERY_RFC1738);

    $popularMovies = app(TheMovieDBGateway::class)
      ->get('/movie/popular' . '?' . $pageNumber);

    return $popularMovies;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function trendingMovies(Request $request)
  {
    
    $parameters = $this->validate($request, [
      'page' => 'integer|required'
    ]);
    
    $query = [
      'page' => $parameters['page'],
    ];

    $pageNumber = Query::build(array_filter($query), PHP_QUERY_RFC1738);

    $trendingMovies = app(TheMovieDBGateway::class)
      ->get('/trending/movie/week' . '?' . $pageNumber);

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
      ->get('/search/movie' . '?language=en-US&include_adult=false&query=' . $searchRequest);

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
