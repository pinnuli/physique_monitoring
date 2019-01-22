<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\Model\User;
use App\Model\College;
use App\Model\Prescription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use AuthenticatesAndRegistersUsers, ThrottlesLogins;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    /**
     * Create a new controller instance.
     *
     * @return void
     */

   

    public function login()
    {
        return view('auth.stulogin');
    }

    public function alertAndRedirect($msg){
    echo "<script>alert('".$msg."');window.location.href='/'</script>";
    }

    public function getData($stu_id)
    {
        $info = User::where('stu_id','=',$stu_id)->get();
        $user[41]['class_name'] = $info[0]["class_name"];
        $user[41]['stu_id'] = "20".$info[0]["stu_id"];
        $user[41]['full_name'] = $info[0]["full_name"];
        $user[41]['sex'] = ($info[0]["sex"] == 1) ? "男" : "女";
        $user[41]['date_of_birth'] = $info[0]["date_of_birth"];

        // 添加学院
        $college_id = substr($stu_id, 2, 2);
        $user[41]['college_name'] = College::where('college_id','=',$college_id)->first()["college_name"];
        for($i = 41; $i <=44; $i++ )
        {
            $gradeinfo = User::where(['stu_id'=>$stu_id,'grade_id'=>$i])->first();
            $weight = $gradeinfo["weight"];
            $height = $gradeinfo["height"];
            $user[$i]['baric_index'] = null;
            if($weight && $height){
                $user[$i]['baric_index'] = sprintf("%.2f", $weight / pow($height/100, 2));
            }
            $user[$i]['baric_index_score'] = $gradeinfo["baric_index_score"];
            $user[$i]['baric_index_grade'] = $gradeinfo["baric_index_grade"];
            $user[$i]['vital_capacity'] = $gradeinfo["vital_capacity"];
            $user[$i]['vital_capacity_score'] = $gradeinfo["vital_capacity_score"];
            $user[$i]['vital_capacity_grade'] = $gradeinfo["vital_capacity_grade"];
            $user[$i]['fifty_meter_dash'] = $gradeinfo["50_meter_dash"];
            $user[$i]['fifty_meter_dash_score'] = $gradeinfo["50_meter_dash_score"];
            $user[$i]['fifty_meter_dash_grade'] = $gradeinfo["50_meter_dash_grade"];
            $user[$i]['sit_and_reach'] = $gradeinfo["sit_and_reach"];
            $user[$i]['sit_and_reach_score'] = $gradeinfo["sit_and_reach_score"];
            $user[$i]['sit_and_reach_grade'] = $gradeinfo["sit_and_reach_grade"];
            $user[$i]['standing_long_jump'] = $gradeinfo["standing_long_jump"];
            $user[$i]['standing_long_jump_score'] = $gradeinfo["standing_long_jump_score"];
            $user[$i]['standing_long_jump_grade'] = $gradeinfo["standing_long_jump_grade"];
            $user[$i]['strength'] = ($gradeinfo["sex"] == '1') ? $gradeinfo["push_up"] : $gradeinfo["sit_up"];
            $user[$i]['strength_score'] = ($gradeinfo["sex"] == '1') ? $gradeinfo["push_up_score"] : $gradeinfo["sit_up_score"];
            $user[$i]['strength_grade'] = ($gradeinfo["sex"] == '1') ? $gradeinfo["push_up_grade"] : $gradeinfo["sit_up_grade"];
            $user[$i]['long_distance'] = ($gradeinfo["sex"] =='1') ?$gradeinfo["1000_meter_dash"] : $gradeinfo["800_meter_dash"];
            $user[$i]['long_distance_score'] = ($gradeinfo["sex"] =='1') ?$gradeinfo["1000_meter_dash_score"] : $gradeinfo["800_meter_dash_score"];
            $user[$i]['long_distance_grade'] = ($gradeinfo["sex"] =='1') ?$gradeinfo["1000_meter_dash_grade"] : $gradeinfo["800_meter_dash_grade"];
            $user[$i]['total_score'] = $gradeinfo["total_point"];
            $user[$i]['total_grade'] = $gradeinfo["total_point_grade"];
        }
        $data['user'] = $user;
        $data['stu_id'] = $stu_id;
        return $data;
    }

    public function stuLogin(Request $request){
        $stu_id = substr($request->input('stu_id'), 2);
        $password = $request->input('password');
        $user = User::where('stu_id','=',$stu_id)->first();
        if($user)
        {
            $adjust=substr($password, 4,1);
            $date_of_birth = $user["date_of_birth"];
            if($adjust == '0')
            {
                $pwd = substr($date_of_birth, 0,4).'0'.substr($date_of_birth, 5,1);
            }
            else
            {
                $pwd = substr($date_of_birth, 0,4).substr($date_of_birth, 5,2);
            }

            if($pwd == $password)
            {
                $data['errcode'] = 0;
                Auth::login($user,true);
                return response()->json($data);
                /*Auth::login($user,true);
                return redirect('/auth/studata/'.$stu_id);*/
                
            }
            else
            {
                $data['errcode'] = 1;
                $data['errmsg'] = '密码错误';
                /*$msg = '密码错误';
                $this->alertAndRedirect($msg);
                abort(403);
                return $msg;*/
                return response()->json($data);
            }
        }

        else
        {
            $data['errcode'] = 1;
            $data['errmsg'] = '用户不存在';
            return response()->json($data);
        }
    }

    public function stuData($stu_id){
        $data=$this->getData($stu_id);
        /*return $data;*/
        return view('auth.studata',$data);
    }

    public function stuLogout(){
        Auth::logout();
        return redirect('/');
    }

    public function prescription(Request $request){
        $item = $request->input('item');
        $grade = $request->input('grade');

        $prescription = Prescription::where(['test_item' => $item, 'item_grade' => $grade])->first();
        if($prescription){
            $data["code"] = 200;
            $data["prescription"] = $prescription;
        }else{
            $data["code"] = 500;
            $data["errmsg"] = "未知错误";
        }
        return json_encode($data);
    }
}
