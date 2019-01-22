<?php

namespace App\Http\Controllers\Admin\Message;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Message\Types;
use App\Model\Message\Topics;
use App\Model\Message\Replies;
use App\Model\User;
use App\Model\Admin;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use AuthenticatesAndRegistersUsers, ThrottlesLogins;
use Intervention\Image\Facades\Image;


class TopicController extends Controller
{
    /*管理员留言板首页*/
    public function index(Request $request){

    	$type_id = $request->input('type_id');
    	$reply_status = $request->input('reply_status');
    	$keyword = $request->input('keyword');
        /*模糊查找*/
    	$data['topics'] = Topics::orWhere(function($query) use($request) {
                                    $query->where('topic_type_id', 'like', '%'.$request['type_id'].'%')
                                    ->where('reply_status', 'like', '%'.$request['reply_status'].'%')
                                    ->where('topic_title', 'like', '%'.$request["keyword"].'%')
                                    ->deleted_at(1);
                                })->orWhere(function($query) use($request){
                                    $query->where('topic_type_id', 'like', '%'.$request['type_id'].'%')
                                    ->where('reply_status', 'like', '%'.$request['reply_status'].'%')
                                    ->where('topic_content', 'like', '%'.$request["keyword"].'%')
                                    ->deleted_at(1);
                                })->orderBy('created_at', 'desc')->paginate(15);
    	for($i = 0; $i < count($data['topics']); $i++){
    		$data['topics'][$i]['topic_replies'] = Replies::where('topic_id', $data['topics'][$i]['id']) -> select('reply_content', 'replier_id', 'updated_at') ->get();
    		$data['topics'][$i]['guest_name'] =  User::where('id', $data['topics'][$i]['guest_id'])->first()['full_name'];
    		for ($j=0; $j < count($data['topics'][$i]['topic_replies']); $j++) { 
    			$data['topics'][$i]['topic_replies'][$j]['replier'] = Admin::where('id', $data['topics'][$i]['topic_replies'][$j]['replier_id'])->select('username')->first()['username'];
    		}

    	}				
        $data['topic_type'] = Types::deleted_at(1)->get()->toArray();  
        $data['type_id'] = $type_id;
        $data['reply_status'] = $reply_status;
        $data['keyword'] = $keyword;
        /*return $data;*/
    	return view('admin.adminTopic', $data);
     }

     /*管理员回复*/
    public function reply(Request $request){

    	$input = $request -> all();
    	$reply = new Replies();
    	$reply->topic_id = $input['topic_id'];
    	$reply->reply_content = $input['reply_content'];
    	$admin = Auth::guard('admin')->user();
    	$reply->replier_id = $admin["id"];
    	if($reply -> save())
        {
            $topic = Topics::where('id', $input['topic_id'])->first();
            $topic->reply_status = 1;
            $topic->save();
            $msg = "回复成功！！！";
            $url = '/admin/topic/index';
            $this->alertAndRedirect($msg,$url);
        }
        else 
        {
            $msg = "回复失败！！！";
            $url = '/admin/topic/index';
            $this->alertAndRedirect($msg);
            return $msg;
        }
     }

     /*管理员修改话题*/
     public function modify(Request $request){
     	$input = $request->all();
     	$topic = Topics::where('id', $input['topic_id'])->first();
     	$topic->topic_title = $input['topic_title'];
     	$topic->topic_content = $input['topic_content'];
     	if($topic -> save())
        {
            $msg = "修改成功！！！";
            $url = '/admin/topic/index';
            $this->alertAndRedirect($msg,$url);
        }
        else 
        {
            $msg = "修改失败！！！";
            $url = '/admin/topic/index';
            $this->alertAndRedirect($msg);
            return $msg;
        }
     }

     /*管理员删除话题*/
     public function delete(Request $request){
        $topic_id = $request -> input('topic_id');
     	$topic=Topics::where('id', $topic_id)->first();
       	$topic -> deleted_at = 0;
       	if($topic -> save())
        {
            $msg = "删除成功！！！";
            $url = '/admin/topic/index';
            $this->alertAndRedirect($msg,$url);
        }
        else 
        {
            $msg = "删除失败！！！";
            $url = '/admin/topic/index';
            $this->alertAndRedirect($msg);
            return $msg;
        }
     }

    public function imageUpload(Request $request) { 

    if(count($_FILES["wangEditorH5File"])){
    $destPath = $_SERVER['DOCUMENT_ROOT'] . '/wangEditor/images/reply/';
    $date = date('Y-m-d', time());
    $savePath = $destPath . '' . $date;
    is_dir($savePath) || mkdir($savePath);
    $ext = pathinfo($_FILES["wangEditorH5File"]['name'], PATHINFO_EXTENSION);
    $file_name = md5(time() . $_FILES["wangEditorH5File"]['tmp_name']) . '.' . $ext;
    $thumb_file_name = 'thumb_' . $file_name;
    if ((($_FILES["wangEditorH5File"]["type"] == "image/gif")
      || ($_FILES["wangEditorH5File"]["type"] == "image/jpeg")
      || ($_FILES["wangEditorH5File"]["type"] == "image/png")
      || ($_FILES["wangEditorH5File"]["type"] == "image/pjpeg"))
      && ($_FILES["wangEditorH5File"]["size"] < 5*1024*1024)){

      if ($_FILES["wangEditorH5File"]["error"] > 0){
        echo "Return Code: " . $_FILES["wangEditorH5File"]["error"] . "<br />";
      }
      else{
        $img = Image::make($_FILES["wangEditorH5File"]['tmp_name'])->save($savePath . '/' . $file_name);
        $thumb_img = Image::make($_FILES["wangEditorH5File"]['tmp_name'])->resize(250, 150)
                        ->save($savePath . '/' . $thumb_file_name);
        /*move_uploaded_file($_FILES["wangEditorH5File"]["tmp_name"],
          $savePath . '/' . $file_name);*/
        $picAddr = Array('/wangEditor/images/reply/'. $date . '/' .$thumb_file_name);
        $result = Array('errno' => 0, 'data' => $picAddr);
        echo json_encode($result);
      }
    }
    else
    {
  //echo "Invalid file";
      $picAddr = Array('/wangEditor/images/reply/' . $date . '/' . $thumb_file_name);
      $result = Array('errno' => 1, 'data' => $picAddr);
      echo json_encode($result);
    }
  }

  else{
      $msg = "请选择图片！！！";
      $url = '/auth/topic/getAdd';
      $this->alertAndRedirect($msg);
      return $msg;
    }

}
    public function alertAndRedirect($msg,$url){
    	echo "<script>alert('".$msg."'); window.location.href='".$url."'</script>";
    }
}
