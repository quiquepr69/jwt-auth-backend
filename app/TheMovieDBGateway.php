<?php

namespace App;

use Illuminate\Support\Facades\Http;

class TheMovieDBGateway
{

  /**
   * Display a listing of the resource.
   * @param string $uri      The URI on the API to request.
   * @param string $query    Addtional parameters for the request.
   * @return \Illuminate\Http\Response
   */

  public function get(string $uri, string $query_string = '')
  {
    $data = Http::withToken(config('services.movies.token'))
      ->GET(config('services.movies.url') . $uri . $query_string)
      ->json();

    return $data;
  }
}
