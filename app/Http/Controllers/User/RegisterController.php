<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterFormRequest;
use App\Http\Resources\UserResource;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RegisterController
 * @package App\Http\Controllers\User
 */
class RegisterController extends Controller
{
    /**
     * @param RegisterFormRequest $request
     * @param UserRepository $repo
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function register(RegisterFormRequest $request, UserRepository $repo)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = $repo->store($data);

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
