<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Response;
use Redirect;

class LoginController extends Controller
{

	public function index()
	{
		return view("login");
	}

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

	public function logout(Request $request)
	{
		$request->session()->flush();
		$request->session()->all();
		return Redirect::to('/');
	}

	// 登陆成功之后调用
	private function login_success($request, $user)
	{
		$session = $request->session();
		$session->put('user', $user);
		$session->put('permission', null);
	}
}