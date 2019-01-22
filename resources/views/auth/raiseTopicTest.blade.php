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
<div class="col-sm-8 blog-main"> <div class="form-group"> <label>标题</label> <input name="title" type="text" class="form-control" placeholder="这里是标题"> </div> <div class="form-group"> <label>内容</label> <div id="div1" class="toolbar"> </div> <div style="padding: 5px 0; color: #ccc"></div> <div id="div2" class="text" name="content" class="form-control"> <!--可使用 min-height 实现编辑区域自动增加高度--> </div> </div> <button type="submit" class="btn btn-default" id="btn">提交</button> </div>

<script type="text/javascript">
 $.ajaxSetup({ 
   headers: { 
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
   } 
 });
  var E = window.wangEditor; 
  var editor = new E('#div1', '#div2');
       // 配置服务器端地址 
       editor.customConfig.uploadImgServer = '/wangEditor/image/raise/upload'; 
       // 设置文件的name值 
       editor.customConfig.uploadFileName = 'wangEditorH5File'; 
       // 设置 headers（举例） 
       editor.customConfig.uploadImgHeaders = { 
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }; 
       // 上传文件监听 
       editor.customConfig.uploadImgHooks = { 
        customInsert: function (insertImg, result, editor) { 
          var url = result.data; 
       //上传图片回填富文本编辑器 
       insertImg(url); } }; 
       editor.create(); 
       document.getElementById('btn').addEventListener('click', function () { 
         var res = editor.txt.html(); 
         var title = $("input[name=topic_title]").val(); 
         $.ajax({ 
           url: '/auth/topic/postAdd', 
           method: 'POST', 
           dataType: "json", 
           data: { 
             'topic_title': res, 
             'title': title 
           }, 
           success: function (data) {
            if (data.error != 0) { 
              return; } 
        //js 跳转 
        window.location.href = '/auth/topic/getAdd'; 
      }, 
      error: function (data) { 
        var json = JSON.parse(data.responseText); 
        // 动态在页面添加错误提示信息 
        str = '<div class="alert alert-danger" role="alert">';
        each(json, function (i, n) { 
          str += '<li>' + n[0] + '</li>'; 
        }); 
        str += '</div>'; 
        $(".alert").remove();
        $("#btn").before(str); 
      } 
    }); 
       }, false);
</script>
<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>