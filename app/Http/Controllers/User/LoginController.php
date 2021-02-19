<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginFormRequest;
use App\Http\Resources\UserResource;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LoginController
 * @package App\Http\Controllers\User
 */
class LoginController extends Controller
{
    /**
     * @param LoginFormRequest $request
     * @param UserRepository $repo
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function login(LoginFormRequest $request, UserRepository $repo)
    {
        $data = $request->validated();
        $user = $repo->find(['email' => $data['email']])->first();

        if (!$user || !Hash::check( $data['password'], $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
