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
    


    public function hola(){

        dd();
        echo "probando";
    }

    
    public function index(){

    $paginate = request()->get('paginate');
        if ($paginate == null) {
            $paginate = 20;
        }
    
    $search = request()->get('search');
    $by = 'name'; // Order query by X column
        if (request()->has('orderBy')) {
            $by = request()->get('orderBy');
         }
    $dir = 'desc'; // Order query by X column
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


    $countr = Countries::with(['childrenCountries'])
        ->when($search, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                    $q->where("name", 'LIKE', "%" . $search . "%")
                      ->whereNull('countries_id');
            });
        })
        ->orderBy($by, $dir)
        ->orderBy('id', 'desc')
        ->paginate($paginate);
     

    return response()->json(
        [
            'listed' => True,
            'data' => $countr,
            'message' => 'Elemento obtenido exitosamente'
        ],
        200
    );
    }
}
