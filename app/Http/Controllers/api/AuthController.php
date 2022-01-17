<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Carbon;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
/**

    * @OA\Post(
     * path="/api/register",
     *   tags={"auth"},
     *   summary="Register",
     *   operationId="register",
     * @OA\RequestBody(
     *    required=true,
     *    description="Register",
     *    @OA\MediaType(
     *      mediaType="multipart/form-data",
     *    @OA\Schema(
     *      required={"name","email","password","password_confirmation"},
     *       @OA\Property(property="name", type="string", example="user"),
     *       @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *       @OA\Property(property="password", type="string", format="password", example="secretuser"),
     *       @OA\Property(property="password_confirmation", type="string", format="password", example="secretuser"),
     *      )
     *    )
     *  ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Created",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     *
     */

    public function register(Request $request){
        $validator =Validator::make($request->all() ,[
            'email'=> 'required|string|email|unique:users',
            'password'=> 'required|string|unique:users'
       ]);

        if($validator->fails()){

            return response()->json($validator->errors(),400);

          }
          $user =new User;
          $user->name=$request->name;
          $user->email=$request->email;
          $user->role='user';
          $user->password=Hash::make($request->password);
          $user->image='';
          $user->save();

         $token= JWTAuth::getFacadeRoot()->fromUser($user);
         return response()->json(['status'=> true ,'token'=> $token,'user'=> $user],201);
    }





    /**
     * @OA\Post(
     * path="/api/login",
     *   tags={"auth"},
     *   summary="Login",
     *   operationId="login",
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="mahfod@gmail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="123456789"),
     *    ),
     * ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     */



    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        try {
            $credentials = request(['email', 'password']);
            if ($token = JWTAuth::attempt($credentials, ['exp' => Carbon::now()->addYear(7)->timestamp])) {
                $user = $request->user();
                return response()->json([
                    'access_token' => $this->respondWithToken($token),
                    'token_type' => 'Bearer',
                    'user' =>
                    UserResource::make($user)  ////////S
                ], 200);
            } else {
                return response()->json(['status' => false, 'Messages' => 'Invalid Data '], 401);
            }
        } catch (JWTException $ex) {
            return response()->json(['status' => false, 'Messages' => $ex->getMessage()], 500);
        }

    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }




    /**
     * @OA\Get(
     * path="/api/user",
     * summary="get user information",
     * description="get user information",
     * operationId="authUser",
     * tags={"auth"},
     * security={{ "apiAuth": {} }},
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Created",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     */
    public function user(Request $request)
    {
        return response()->json(UserResource::make($request->user()));
    }


}
