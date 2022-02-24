<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\UserData;
use App\Models\TypeUser;

use Validator;

class UserController extends Controller
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
            $paginate = 10;
        }
        $search = request()->get('search');
        $by = 'email'; // Order query by X column
        if (request()->has('orderBy')) {
            $by = request()->get('orderBy');
        }
        $ident = 'identificador'; // Order query by X column
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

        $users = User::with(['UserData','TypeUser'])
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                        $q->where("email", 'ILIKE', "%" . $search . "%");
                });
            })
            ->orderBy($by, $dir)
            ->paginate($paginate);
        return response()->json(
            [
                'listed' => True,
                'data' => $users,
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

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'type_users_id' => 'numeric|required ',
            'password_confirmation' => 'required ',
            'identification' => 'required|string|max:12',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:15',
            'code_city' => 'required|string|max:30',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
           
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $userData = UserData::create([
            'users_id' => $user->id,
            'type_users_id' => $request->get('type_users_id'),
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'identification' => $request->get('identification'),
            'date_of_birth' => $request->get('date_of_birth'),
            'code_city' => $request->get('code_city'),
        ]);

        return response()->json(
            [
                'listed' => True,
                'data' => [
                    'user' => $user,
                    'userData' => $userData,
                ],
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );
        return response()->json(compact('user','token'),201);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::with(['UserData','TypeUser'])->find($id);
        if (!$users) {
            return response()->json(['error' => 'user_does_not_exist'], 404);
        }
        return response()->json(
            [
                'showed' => True,
                'data' => $users,
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'type_users_id' => 'numeric|required ',
            'password_confirmation' => 'required ',
            'identification' => 'required|string|max:12',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:15',
            'code_city' => 'required|string|max:30',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $user = User::findOrFail($id);
        $user_data = UserData::where('users_id', $id)->first();
        $user->fill([
            'identificador' => $request->get('identificador'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);
        $user_data->fill([
            'users_id' => $user->id,
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'identification' => $request->get('identification'),
            'date_of_birth' => $request->get('date_of_birth'),
            'code_city' => $request->get('code_city'),
        ]);
        $user->save();
        $user_data->save();
        return response()->json(
            [
                'updated' => True,
                'data' => [
                    'user' => $user,
                    'userData' => $user_data,
                ],
                'message' => 'Elemento actualizado exitosamente'
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
        $user = User::findorFail($id);
        $user->delete();
        return response()->json([
            'deleted' => True,
            'message' => 'Elemento eliminado exitosamente',
        ], 200);
    }
}
