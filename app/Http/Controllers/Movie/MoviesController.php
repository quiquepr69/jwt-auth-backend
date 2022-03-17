<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $pageNumber = $request->page;

    $popularMovies = Http::withToken(config('services.movies.token'))
      ->GET('https://api.themoviedb.org/3/movie/popular?page=' . $pageNumber)
      ->json();

    return $popularMovies;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function trendingMovies(Request $request)
  {
    $pageNumber = $request->page;

    $trendingMovies = Http::withToken(config('services.movies.token'))
      ->GET('https://api.themoviedb.org/3/trending/movie/week?page=' . $pageNumber)
      ->json();

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

    $searchMovies = Http::withToken(config('services.movies.token'))
      ->GET('https://api.themoviedb.org/3/search/movie?language=en-US&include_adult=false&query=' . $searchRequest)
      ->json();

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
      ->GET('https://api.themoviedb.org/3/genre/movie/list')
      ->Json();

    return $movieGenre;
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
