<?php
namespace App\Http\Controllers;

use App\Models\Temp;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Log;

class DebateController extends Controller 
{
    public function change(Request $request){
        $stand  = intval($request->input('stand'));
        if(Temp::change($stand)){
            return responseToJson(0,'success');
        }else{
            return responseToJson(1,'failed');
        }
    }

    public function getNum(){
        $temp = DB::table('temp')->first();
        return responseToJson(0,'success',[
            'square' => $temp->square,
            'negative' => $temp->negative
        ]);
    }

    public function option(Request $request){
        $content  = $request->input('content');
        // var_dump($content);die;
        $data = [
            'user_id' => get_user_id(),
            'content' => $content,
            'create_time' => millisecond()
        ];

        $res = DB::table('opinion')->insert($data);
        if($res){
            return responseToJson(0,'success');
        }else{
            return responseToJson(1,'failed');
        }
    }

    public function getOption(Request $request){
        $opinion_id  = $request->input('opinion_id');
        if($opinion_id == 0){
            $time = millisecond() - 5000;
            $opinions = DB::table('opinion')
                        ->leftJoin('user','opinion.user_id','user.id')
                        ->where('opinion.create_time','>',$time)
                        ->select('opinion.id','content','name','stand')
                        ->get();

        } else {
            $opinions = DB::table('opinion')
                ->leftJoin('user','opinion.user_id','user.id')
                ->where('opinion.id','>',$opinion_id)
                ->select('opinion.id','content','name','stand')
                ->get();
        }
        return responseToJson(0,'success',$opinions);
    }

    public function getUser(){
        $user = DB::table('user')
                ->where('id',get_user_id())
                ->first();
        return responseToJson(0,'success',$user);
    }
    public function updateUser(Request $request){
        $name  = $request->input('name');
        $res = User::reset([
            'id' => get_user_id(),
            'name' => $name
        ]);
        if($res){
            return responseToJson(0,'success');
        }
        else{
            return responseToJson(1,'failed');
        }
    }
}