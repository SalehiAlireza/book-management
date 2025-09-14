<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;

class UserController extends Controller
{

    public function index()
    {
        return UserResource::collection(User::all());
        return response()->json(User::all(), 200);
    }

    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->all();

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->all();

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user->update($validated);

        return response()->json($user, 200);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

}
