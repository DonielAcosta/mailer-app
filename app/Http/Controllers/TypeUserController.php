<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeUser;
use App\Models\User;
use Validator;


class TypeUserController extends Controller
{
    public function index(Request $request)
    {
        $paginate = request()->get('paginate');
        if ($paginate == null) {
            $paginate = 10;
        }
        $search = request()->get('search');
        $by = 'type'; // Order query by X column
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
        $type_user = TypeUser::with(['User'])
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where("type", 'LIKE', "%" . $search . "%");
                });
            })
            ->orderBy($by, $dir)
            ->orderBy('id', 'desc')
            ->paginate($paginate);

        return response()->json(
            [
                'listed' => True,
                'data' => $type_user,
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
                'type' => 'required|string'
            ]
        );
        if ($validator->fails()) {
            return response()
                ->json(['error' => $validator->errors()], 422);
        }
        $arr = [
            'type' => $request->input('type')
        ];
        $type_user = TypeUser::create($arr);
        return response()->json(
            [
                'created' => true,
                'data' => $type_user,
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
        $type_user = TypeUser::with(['User'])->find($id);
        if (!$type_user) {
            return response()->json(['error' => 'type_does_not_exist'], 404);
        }
        return response()->json(
            [
                'showed' => True,
                'data' => $type_user,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );
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
                'type' => 'required|string'
            ]
        );
        if ($validator->fails()) {
            return response()
                ->json(['error' => $validator->errors()], 422);
        }
        $type_user = TypeUser::findOrFail($id);
        $type_user->fill($request->all());
        $type_user->save();
        return response()->json(
            [
                'updated' => True,
                'data' => $type_user,
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
        $type_user = TypeUser::findorFail($id);
        $type_user->delete();
        return response()->json([
            'deleted' => True,
            'message' => 'Elemento eliminado exitosamente',
        ], 200);
    }
}
