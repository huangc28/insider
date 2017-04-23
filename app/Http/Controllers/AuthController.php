<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Domain\User\UserRepositoryInterface;

class AuthController extends BaseController
{
    /**
     * @var App\Domain\User\User
     */
    protected $user;

    /**
     * @param App\Domain\User\UserRepositoryInterface
     * @return void
     */
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Generate api token for user tries to login
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // check for input, email and password
        if ($request->has('email') && $request->has('password')) {

            // retrieve user according to email and password
            $user = $this->user->findUserByEmail(
                $request->input('email')
            );

            // user is found
            if (is_null($user) !== true)
            {
                try {
                    // check if password matches.
                    if ($request->input('password') !== $user->password)
                    {
                        return response()->json([
                            'status' => 400,
                            'error' => [
                                'message' => 'please insert correct password'
                            ]
                        ]);
                    }

                    // if password matches, generate api token

                    // generate api_token
                    $token = str_random(10);

                    // generate api token
                    $user->api_token = $token;

                    $user->save();

                    return response()->json([
                        'status' => 200,
                        'api_token' => $token
                    ]);

                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 500,
                        'error' => [
                            'message' => 'internal server error'
                        ]
                    ]);
                }
            }

            return response()->json([
                'status' => 404,
                'error' => [
                    'message' => 'user not found'
                ]
            ]);
        }
    }
}
