<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserAuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $this->getCredentials($request);
        return $this->createToken($credentials);
    }

    /**
     * Get the authenticated User.
     *
     * @return UserResource
     */
    public function me(): UserResource
    {
        return new UserResource(User::findOrFail($this->guard()->id()));
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $this->guard()->user()->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     * @param User $user
     * @return JsonResponse
     */
    protected function respondWithToken(string $token,User $user): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => new UserResource($user)
        ]);
    }

    /**
     * @param Request $request
     * @return array
     */
    private function getCredentials (Request $request): array
    {
        return $request->validate([
            'email'     => 'required|email',
            'password'  => 'required|string|min:8'
        ]);
    }

    /**
     * @throws ValidationException
     */
    private function createToken($credentials): JsonResponse
    {
        $user = User::where('email',$credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('mobile_app_user_auth_token')->plainTextToken;

        return $this->respondWithToken($token,$user);
    }

    private function guard(){
        return auth()->guard('api');
    }
}
