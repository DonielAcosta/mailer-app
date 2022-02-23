<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserData;
use Validator;

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
        $dir = 'desc'; // Direction of the Order by
        if (request()->has('dirDesc')) {
            if (request()->get('dirDesc') === 'true') {
                $dir = 'desc';
            } else {
                $dir = 'asc';
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
            ->orderBy($by, $dir)
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'identification' => 'required|string|max:15',
                'phone' => 'required|string|max:15',
                'date_of_birth' => 'required|date',
                'code_city' => 'required|string|max:255',
                'users_id' => 'required|numeric'
                
            ]
        );
        if ($validator->fails()) {
            return response()
                ->json(['error' => $validator->errors()], 422);
        }
        $arr = [
            'users_id' => $request->get('users_id'),
            'name' => $request->input('name'),
            'identification' => $request->input('identification'),
            'phone' => $request->input('phone'),
            'date_of_birth' => $request->input('date_of_birth'),
            'code_city' => $request->input('code_city'),
        ];
        $user_data = UserData::create($arr);
        return response()->json(
            [
                'created' => true,
                'data' => $user_data,
                'message' => 'Elemento creado exitosamente'
            ],
            200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_data = UserData::with(['User'])->find($id);
        if (!$user_data) {
            return response()->json(['error' => 'user_data_does_not_exist'], 404);
        }
        return response()->json(
            [
                'showed' => True,
                'data' => $user_data,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );
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
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'identification' => 'required|string|max:15',
                'phone' => 'required|string|max:15',
                'date_of_birth' => 'required|date',
                'code_city' => 'required|string|max:255',
                'users_id' => 'required|numeric'
                
            ]
        );

        if ($validator->fails()) {
            return response()
                ->json(['error' => $validator->errors()], 422);
        }
        $user_data = UserData::findOrFail($id);
        $user_data->fill($request->all());
        $user_data->save();
        return response()->json(
            [
                'updated' => True,
                'data' => $user_data,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_data = UserData::findorFail($id);
        $user_data->delete();
        return response()->json([
            'deleted' => True,
            'message' => 'Elemento eliminado exitosamente',
        ], 200);
    }
}
