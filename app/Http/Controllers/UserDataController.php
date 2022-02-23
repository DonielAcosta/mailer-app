<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginate = request()->get('paginate');
        if ($paginate == null) {
            $paginate = 30;
        }

        $search = request()->get('search');
        $by = 'name'; // Order query by X column
        if (request()->has('orderBy')) {
            $by = request()->get('orderBy');
        }
        $identi = 'desc'; // identificacion of the Order by
        if (request()->has('identiDesc')) {
            if (request()->get('identiDesc') === 'true') {
                $identi = 'desc';
            } else {
                $identi = 'asc';
            }
        }
        $codecity = 'code_city'; // codigo de la ciudad 
        if(request()->has('orderBy')) {
            $codecity = request()->get('orderBy');
        }
        $user_data = UserData::with(['User'])
        	->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                       $q->where("name", 'ILIKE', "%" . $search . "%")
                       	->orWhere("identification", "ILIKE", "%" . $search . "%")
                       	->orWhere("phone", "ILIKE", "%" . $search . "%")
                       	->orWhere("date_of_birth", "ILIKE", "%" . $search . "%")
                       	->orWhere("code_city", "ILIKE", "%" . $search . "%");
                });
            })
            ->orderBy($by, $identi)
            ->orderBy('id', 'desc')
            ->paginate($paginate);

        return response()->json(
            [
                'listed' => True,
                'data' => $user_data,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );
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
