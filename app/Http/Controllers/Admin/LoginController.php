<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin;
use App\Model\User;
use App\Model\College;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

    
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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/admsearch';
    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->middleware('guest')->except(['logout','getLogin','getData','search','searchResult','getAddAdmin','postAddAdmin','postLogin','detailData']);    
	}
    
    protected function guard()
    {
        return auth()->guard('admin');
    }

    public function alertAndRedirect($msg,$url){
    echo "<script>alert('".$msg."');window.location.href='".$url."'</script>";
    }

    public function getLogin()
    {
    	
    	return view('admin.admlogin');
    }

    public function postLogin(Request $request)
    {
    	$username = $request->input('username');
    	$password = $request->input('password');
        $admin = Admin::where('username', $username)->first();
        if($admin){
            if(Auth::guard('admin')->attempt(['username' => $username, 'password' => $password], true))
            {
                /*return redirect('/admin/admsearch');*/
                $data['errcode'] = 0;
                return response()->json($data);
            }
            else
            {
                $data['errcode'] = 1;
                $data['errmsg'] = '密码错误';
                return response()->json($data);
            /*$msg = '账号密码错误';
            $url = '/admin/admlogin';
            $this->alertAndRedirect($msg,$url);
            abort(403);
            return $msg;*/
            } 

        }
        else{
            $data['errcode'] = 1;
            $data['errmsg'] = '用户不存在';
            return response()->json($data);
        }
    	
    }


    public function search(Request $request)
    {
    	$full_name = $request->input('full_name');
        $prefix = substr($request->input('stu_id'), 0,2);
    	$stu_id = ($prefix == "20") ? substr($request->input('stu_id'), 2) : $request->input('stu_id');
    	$total_point_grade = $request->input('total_point_grade');
        if(!($full_name || $prefix || $total_point_grade)){
            $users = array();
        }else{
            $handle = DB::table('anthropometric_data');
            $full_name&&$handle->where('full_name','like',"%$full_name%");
            $stu_id && $handle->where('stu_id','like',"$stu_id%");
            $total_point_grade && $handle->where('total_point_grade','=',$total_point_grade);
            $result = $handle->select('full_name','stu_id','grade_id','class_name','height','weight','total_point','total_point_grade')->orderby('grade_id','desc')->get();
            if(!is_array($result))
            {
                $users = json_decode($result,true);
            }
            for($i=0; $i<sizeof($result); $i++)
            {
                $users[$i]['stu_id'] = "20".$users[$i]['stu_id'];
                switch ($users[$i]['grade_id']) {
                    case '41':
                    $grade="大一";
                    break;
                    case '42':
                    $grade="大二";
                    break;
                    case '43':
                    $grade="大四";
                    break;
                    case 44:
                    $grade="大四";
                    break;
                    default:
                    break;
                }
                $users[$i]['grade_id'] = $grade;
            }
        }
        $data['stu_id'] = $request->input('stu_id');
        $data['full_name'] = $request->input('full_name');
        $data['total_point_grade'] = $request->input('total_point_grade');
        if($users) {
            $data['users'] = $users;
            return view('admin.admsearch',$data);
        
        } else{
            $data['users'] = array();
            return view('admin.admsearch',$data);
        }
        
    }

    public function logout()
    {
    	Auth::guard('admin')->logout();
    	return redirect('/admin/admlogin');
    }

    public function getAddAdmin()
    {
        return view('admin.addAdmin');
    }

    public function postAddAdmin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $user = new Admin();
        $user->username = $username;
        $user->password = bcrypt($password);
        if($user->save())
        {
            $msg = "添加成功！！！";
            $url = '/admin/admsearch';
            $this->alertAndRedirect($msg,$url);
        }
        else 
        {
            $msg = "添加失败！！！";
            $url = '/admin/addAdmin';
            $this->alertAndRedirect($msg);
            return $msg;
        }
    }

    public function detailData(Request $request,$stu_id)
    {
        
        $true_id = substr($stu_id, 2);
        $info = User::where('stu_id','=',$true_id)->get();
        $user[41]['class_name'] = $info[0]["class_name"];
        $user[41]['stu_id'] = "20".$info[0]["stu_id"];
        $user[41]['full_name'] = $info[0]["full_name"];
        $user[41]['sex'] = ($info[0]["sex"] == 1) ? "男" : "女";
        $user[41]['date_of_birth'] = $info[0]["date_of_birth"];

         // 添加学院,注意这里从4开始取2位
         $college_id = substr($stu_id, 4, 2);
         $user[41]['college_name'] = College::where('college_id','=',$college_id)->first()["college_name"];
        for($i = 41; $i <=44; $i++ )
        {
            $gradeinfo = User::where(['stu_id'=>$true_id,'grade_id'=>$i])->first();
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
        
        return view('admin.detailData',$data);
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


