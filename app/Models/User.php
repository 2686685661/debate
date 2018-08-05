<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class User extends Model
{
    // 登陆判断
    public static function get_account($loginName)
    {
        $result = DB::table('user')
            ->where('sn', $loginName)
            ->first();
        return $result;
    }

    public static function reset($user){
        return DB::table('user')
                ->where('id', $user['id'])
                ->update($user);
    }
}