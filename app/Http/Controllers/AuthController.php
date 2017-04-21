<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Domain\User\UserRepository;

class AuthController extends BaseController
{
    /**
     * @var App\Domain\User\User
     */
    protected $user;

    /**
     * @param App\Domain\User\UserRepository
     * @return void
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function login(Request $request)
    {
        // check for input, email and password
        if ($request->has('email') && $request->has('password')) {
            $email = $request->input('email');

            // retrieve user according to email and password
            $user = $this->user->findUserByEmail($email);

            // user is found
            if (is_null($user) !== null)
            {
                try {
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
                    'message' => 'user not found',
                ]
            ]);
        }
    }
}
