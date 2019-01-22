<?php

namespace App\Http\Controllers\Admin\Message;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Message\Types;

class TypeController extends Controller
{

	//获取话题分类信息数组
	public function index(Request $request){
		$data['types'] = Types::deleted_at(1)->get()->toArray();
		return view('admin.adminType', $data);
	}

    //添加话题分类
    public function add(Request $request){

    	$type = new Types();
    	$type -> name =$request->input('name');
    	$type -> type_key = $request->input('type_key');
    	$type -> type_desc =$request->input('type_desc');
    	
    	if($type -> save())
        {
            $msg = "添加成功！！！";
            $url = '/admin/topic/indexType';
            $this->alertAndRedirect($msg,$url);
        }
        else 
        {
            $msg = "添加失败！！！";
            $url = '/admin/topic/indexType';
            $this->alertAndRedirect($msg);
            return $msg;
        }
    }

    /*修改话题分类*/
    public function modify(Request $request){

    	$input=$request->all();
     	$id = $request->input('type_id');
     	$type=Types::where('id',$id)->get();
    	$type[0]->name=$request->input('name');
     	$type[0]->type_key=$request->input('type_key');
    	$type[0]->type_desc=$request->input('type_desc');
    	if($type[0] -> save())
        {
            $msg = "修改成功！！！";
            $url = '/admin/topic/indexType';
            $this->alertAndRedirect($msg,$url);
        }
        else 
        {
            $msg = "修改失败！！！";
            $url = '/admin/topic/indexType';
            $this->alertAndRedirect($msg);
            return $msg;
        }
    }

    /*删除话题分类*/
    public function delete(Request $request){
        $type_id = $request->input('type_id');
       	$type=Types::where('id', $type_id)->first();
       	$type -> deleted_at = 0;
       	if($type -> save())
        {
            $msg = "删除成功！！！";
            $url = '/admin/topic/indexType';
            $this->alertAndRedirect($msg,$url);
        }
        else 
        {
            $msg = "删除失败！！！";
            $url = '/admin/topic/indexType';
            $this->alertAndRedirect($msg);
            return $msg;
        }
    }


    public function alertAndRedirect($msg,$url){
    	echo "<script>alert('".$msg."'); window.location.href='".$url."'</script>";
    }
}
