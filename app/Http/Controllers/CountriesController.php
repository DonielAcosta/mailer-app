<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Countries;
USE App\Http\Controllers\CountriesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Validator;
use App\User;


class CountriesController extends Controller{

  public function index(){

    $parent = request()->get('parent');
    $country = request()->get('parent');
    $search = request()->get('search');
    $by = 'countries_id'; // Order query by X column
    if (request()->has('orderBy')) {
      $by = request()->get('orderBy');
    }
    $dir = 'desc'; // Direction of the Order by
    if (request()->has('dirDesc')) {
      if (request()->get('dirDesc') === 'true') {
        $dir = 'desc';
      } else {
        $dir = 'asc';
      }
    }

    $pais = Countries::with(['country'])
      ->when($parent, function ($query, $parent) {
          return $query->where('countries_id', $parent);   // paises
      },function ($query) {
        return $query->whereNull('countries_id');
      })
      ->when($search, function ($query, $search) {
          return $query->where("name",'LIKE',"%".$search."%");
      })
      ->orderBy($by, $dir)
      ->get();

    return response()->json(
      [
          'listed' => True,
          'data' => $pais,
          'message' => 'Elemento obtenido exitosamente'
        ],
        200
    );
  }

  public function filter($id){

    $filter = Countries::with('country.country')
            ->where('id', $id)
            ->get();

    return response()->json(
        [
            'listed' => True,
            'data' => $filter,
            'message' => 'Elemento obtenido exitosamente'
        ],
      200);
  }


}
