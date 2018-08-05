<?php
/**
 * Created by PhpStorm.
 * User: WeiYalin
 * Date: 2018/8/4
 * Time: 15:55
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Log;

class Temp extends Model
{
    public static function change($stand)
    {
        $temp = DB::table('temp')->where('id',1);

        DB::beginTransaction();
        try{
            $user = DB::table('user')->where('id', get_user_id())->first();

            if($stand == 1){
                if($user->stand == 0){
                    $temp->increment('square');
                }else{
                    $temp->increment('square');
                    $temp->decrement('negative');
                }
            }else if($stand == 2){
                if($user->stand == 0){
                    $temp->increment('negative');
                }else{
                    $temp->increment('negative');
                    $temp->decrement('square');
                }
            }

            DB::table('user')->where('id', get_user_id())->update(['stand' => $stand]);

            DB::commit();
            return true;
        }catch (\Exception $e){
            Log::info($e);
            DB::rollBack();
            return false;
        }
    }
}