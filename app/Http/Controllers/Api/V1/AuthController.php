<?php
/**
 * @Author Bob
 * @Date: 2018/11/16
 * @Email  bob@bobcoder.cc
 * @Site https://www.bobcoder.cc/
 */
namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class AuthController extends Controller
{
    protected $guard = 'api';//设置使用guard为api选项验证，请查看config/auth.php的guards设置项，重要！

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function test(){
        echo "test!!";
    }

    public function register(Request $request)
    {

        $rules = [
            'name' => ['required'],
            'phone' => ['required'],
            'password' => ['required', 'min:6', 'max:16'],
        ];

        $payload = $request->only('name', 'phone', 'password');
        $validator = Validator::make($payload, $rules);

        // 验证格式
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        // 创建用户
        $result = Member::create([
            'name' => $payload['name'],
            'phone' => $payload['phone'],
            'password' => bcrypt($payload['password']),
        ]);

        if ($result) {
            return response()->json(['success' => '创建用户成功']);
        } else {
            return response()->json(['error' => '创建用户失败']);
        }

    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json('登录失败');
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        //return response()->json(['message' => 'Successfully logged out']);
        return response()->json(['message' => '退出成功']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard($this->guard);
    }
}