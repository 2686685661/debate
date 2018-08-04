<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $name = $request->name;
            $pwd = $request->pwd;
            $user = User::get_account($name);
            if ($user && $user->status == 0) {
                if (get_md5_password($pwd) == $user->password) {

                    $this->login_success($request, $user);

                    return Response::json(['status' => 0, 'msg' => '登陆成功']);
                } else {
                    return Response::json(['status' => 1, 'msg' => '用户名或密码错误,请重新输入']);
                }
            } else {
                return Response::json(['status' => 1, 'msg' => '用户名或密码错误,请重新输入']);
            }
        } else {
            return view('login');
        }
    }
}