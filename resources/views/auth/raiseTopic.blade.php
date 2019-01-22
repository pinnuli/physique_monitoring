<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>学生体质健康跟踪互动系统</title>
<meta name="description" content="">
<meta name="keywords" content="">
<link href="/css/raiseTopic.css" rel="stylesheet">
<script src="/js/raiseTopic.js">
</script>
<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="http://cdn.static.runoob.com/libs/jquery/1.10.2/jquery.min.js"></script>

</head>
<body>
<div class="wrap">
  <header>
       <!-- <img src="/image/running.png" style="width: 57px;margin-left: 16px;">-->
            <div class="round round1"></div>
            <div class="round round2"></div>
            <div class="round round3"></div>
  </header>
   <footer>
  <div class="manager">@版权所有</div>    
  </footer>
 <div class="main">
   <div class="mainbody">
     <div class="stu_data_head">
        <span><!-- <input type="button" onclick="{location.href='/auth/topic/index'}" value="留言板" class="submit_form"> -->

          <a href="javascript:;" onclick="{location.href='/auth/studata/{{ $back_stu_id }}'}">我的成绩</a>
        </span>
        <span><input type="button" onclick="{location.href='/auth/stulogout'}" value="退出" class="submit_form"></span>
    </div>
     <div class="stu_system_name">
       <p>学生体质健康跟踪互动系统</p>
       <p>Student Health Tracking Interactive System</p>
    </div>
    <div class="operation_choose">
      <input type="button"  value="查看话题" class="show_topicSelection" onclick="{location.href='/auth/topic/index'}">
      <input type="button"  value="发起话题" class="show_topicRaise" onclick="{location.href='/auth/topic/getAdd'}">
    </div>

    <div class="raise_topic">
      <form action="/auth/topic/postAdd" method="post" id="formdata" onsubmit="return checkRaiseTopic()">
      <p><span>话题类别</span>
        <select id="selection" name="topic_type_id"  class="form-control" >
          @foreach ($topic_type as $type)
            <option  value="{{$type['id']}}" >{{$type['name']}}</option>
          @endforeach
        </select>
     </p>
      <p>
        <span>话题标题</span><input type="text" name="topic_title" class="form-control" style="display: inline-block;" id="tp_title">
      </p>
      <p><div id="content_post"></div></p>
      <p>
        <textarea id="ct" name="topic_content" class="form-control" style="display: none"></textarea>
      </p>
      <input type="hidden" name="guest_id" value="{{ $guest_id }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <p style="text-align: center;"><input type="submit" class="form-control" value="提交" style="width:100%;margin:10px auto;background-color: #0DCEE2"></p>
      </form>
    </div>
  </div>
</div>
</div>
<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/wangEditor.js"></script>
<script type="text/javascript">
    var E = window.wangEditor;

    var editor= new E(document.getElementById("content_post"));
    /*var _token = "{{ csrf_token() }}";*/

    editor.customConfig.onchange = function (html){
        // 监控变化，同步更新到 textarea
        document.getElementById("ct").innerHTML=html;
    }
    editor.customConfig.menus=[
    'head',  // 标题
    'bold',  // 粗体
    'italic',  // 斜体
    'underline',  // 下划线
    'foreColor',  // 文字颜色
    'backColor',  // 背景颜色
    'link',  // 插入链接
    'list',  // 列表
    'justify',  // 对齐方式
    'emoticon',  // 表情
    'image',  // 插入图片
    'table',  // 表格
    'code',  // 插入代码
    'undo',  // 撤销
    'redo'  // 重复
    ]
        editor.customConfig.uploadImgHeaders = {
        'X-CSRF-TOKEN' : $('input[name="_token"]').val()
    };
    editor.customConfig.uploadImgServer='/wangEditor/image/raise/upload';
    editor.customConfig.uploadFileName = 'wangEditorH5File';
    editor.customConfig.uploadImgHooks = {
        before: function (xhr, editor, files) {
        },
        success: function (xhr, editor, result) {
            // 图片上传并返回结果，图片插入成功之后触发
            // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，result 是服务器端返回的结果
            alert("图片上传成功！");
        },
        fail: function (xhr, editor, result) {
            // 图片上传并返回结果，但图片插入错误时触发
            // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，result 是服务器端返回的结果
        },
        error: function (xhr, editor) {
            // 图片上传出错时触发
            // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象
        },
        timeout: function (xhr, editor) {
            // 图片上传超时时触发
            // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象
        }
    };

    editor.create();
    // 初始化 textarea 的值
    document.getElementById("ct").innerHTML=editor.txt.html();
</script>

</body>
</html>