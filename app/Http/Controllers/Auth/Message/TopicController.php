<?php

namespace App\Http\Controllers\Auth\Message;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Message\Topics;
use App\Model\Message\Types;
use App\Model\Message\Replies;
use App\Model\User;
use App\Model\Admin;
use Auth;
use Validator;
use Intervention\Image\Facades\Image;


class TopicController extends Controller
{
  /*学生留言板首页*/
  public function index(Request $request){
   $type_id = $request->input('type_id');
   $keyword = $request->input('keyword');
   $data['topics'] = Topics::orWhere(function($query) use($request) {
    $query->where('reply_status', 1)
    ->where('topic_type_id', 'like', '%'.$request['type_id'].'%')
    ->where('topic_title', 'like', '%'.$request["keyword"].'%')
    ->deleted_at(1);
  })->orWhere(function($query) use($request){
    $query->where('reply_status', 1)
    ->where('topic_type_id', 'like', '%'.$request['type_id'].'%')
    ->where('topic_content', 'like', '%'.$request["keyword"].'%')
    ->deleted_at(1);
  })->orderBy('created_at', 'desc')->paginate(15);
  for($i = 0; $i < count($data['topics']); $i++){
    $data['topics'][$i]['topic_replies'] = Replies::where('topic_id', $data['topics'][$i]['id']) -> select('reply_content', 'replier_id', 'updated_at') ->get();
    $data['topics'][$i]['topic_sponsor'] =  User::where('id', $data['topics'][$i]['guest_id'])->select('full_name')->first()['full_name'];
    for ($j=0; $j < count($data['topics'][$i]['topic_replies']); $j++) { 
     $data['topics'][$i]['topic_replies'][$j]['replier'] = Admin::where('id', $data['topics'][$i]['topic_replies'][$j]['replier_id'])->select('username')->first()['username'];
   }

 }			
 $data['topic_type'] = Types::deleted_at(1)->get()->toArray();	
 $data['type_id'] = $type_id;
 $data['keyword'] = $keyword;
 $id = Auth::user()['id'];
  $data['stu_id'] = User::where('id', $id)->first()['stu_id'];
 /*return $data;*/
 return view('auth.stuTopic', $data);
}

/*获取发起话题页面*/
public function getAdd(){
 $data['topic_type'] = Types::deleted_at(1)->get()->toArray();
 $data['guest_id'] = Auth::user()['id'];
 $data['back_stu_id'] = Auth::user()['stu_id'];
 return view('auth.raiseTopic', $data);
}

/*提交话题*/
public function postAdd(Request $request){
 $input = $request->all();
 $topic = new Topics();
 $topic->topic_title = $input['topic_title'];
 $topic->topic_type_id = $input['topic_type_id'];
 $topic->topic_content = $input['topic_content'];
 $topic->guest_id = $input['guest_id'];
 if($topic -> save())
 {
  $msg = "提交成功！！！";
  $url = '/auth/topic/getAdd';
  $this->alertAndRedirect($msg,$url);
}
else 
{
  $msg = "提交失败！！！";
  $url = '/auth/topic/getAdd';
  $this->alertAndRedirect($msg);
  return $msg;
}
}

public function imageUpload(Request $request) { 

  if(count($_FILES["wangEditorH5File"])){
    $destPath = $_SERVER['DOCUMENT_ROOT'] . '/wangEditor/images/raise/';
    $date = date('Y-m-d', time());
    $savePath = $destPath . '' . $date;
    is_dir($savePath) || mkdir($savePath);
    $ext = pathinfo($_FILES["wangEditorH5File"]['name'], PATHINFO_EXTENSION);
    $file_name = md5(time() . $_FILES["wangEditorH5File"]['tmp_name']) . '.' . $ext;
    $thumb_file_name = 'thumb_' . $file_name;
    if ((($_FILES["wangEditorH5File"]["type"] == "image/gif")
      || ($_FILES["wangEditorH5File"]["type"] == "image/jpeg")
      || ($_FILES["wangEditorH5File"]["type"] == "image/png")
      || ($_FILES["wangEditorH5File"]["type"] == "image/pjpeg")
      || ($_FILES["wangEditorH5File"]["type"] == "image/bmp"))
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
        $picAddr = Array('/wangEditor/images/raise/' . $date . '/' . $thumb_file_name);
        $result = Array('errno' => 0, 'data' => $picAddr);
        echo json_encode($result);
      }
    }
    else
    {
  //echo "Invalid file";
      $picAddr = Array('/wangEditor/images/raise/' . $date . '/' . $thumb_file_name);
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
