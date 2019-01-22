<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Examples</title>
<meta name="description" content="">
<meta name="keywords" content="">
<link href="/css/adminTopic.css" rel="stylesheet">
<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="http://cdn.static.runoob.com/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="/js/adminTopic.js"></script>
<script src="/js/addAdmin.js"></script>
</head>
<body>
<header>
       <img src="/image/running.png" style="width: 57px;margin-left: 16px;">
            <div class="round round1"></div>
            <div class="round round2"></div>
            <div class="round round3"></div>
</header>
<div class="main">
<!--导航栏-->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/admin/admsearch">学生体质健康跟踪互动系统</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li  id="homepage"><a href="#">首页 <span class="sr-only"></span></a></li>
        <li id="scoreSearch" class="active"><a href="/admin/admsearch">成绩搜索</a></li>
        <li id="statisticsReport"><a href="/admin/statistics">统计报表</a></li>
        <li id="topic"><a href="/admin/topic/index">交流互动区</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li id="addAdmin"><a data-toggle="modal" data-target="#addadmin">添加管理员</a></li>
        <li><a href="/admin/admlogout">退出</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </nav>
    <!--添加管理员-->
      <div class="modal" id="addadmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 style="text-align: center">添加管理员</h4>
                </div>
                <form  method="post" action="/admin/addAdmin" onSubmit="return check();">
                <div class="modal-body" style="font-size: 20px;text-align: center">
                        <p><input type="text" name="username" placeholder="用户名" id="name" onclick="change()" class="form-control"></p>
                        <p id="test_name" style="font-size: 13px;"></p>
                        <p><input type="password" name="password" placeholder="密码" id="password1"  onclick="test()" class="form-control"/></p>
                        <p id="test_password" style="font-size: 13px;"></p>
                        <p><input type="password" name="password" placeholder="再次输入密码" id="password2" onclick="test1()"  class="form-control"></p>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <p id="test_password_again" style="font-size: 13px;"></p>
                </div>
                <div class="modal-footer" style="text-align: center;">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="取消">               
                    <input type="submit" class="btn btn-primary" value="添加" >           
                </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
      </div>

  <div class="topic_manager">
        <a id="topicBtn" class="btn btn-primary btn-lg" href="/admin/topic/index" >话题管理</a>
        <a id="typeBtn" class="btn btn-default btn-lg" href="/admin/topic/indexType">分类管理</a>
   </div>

<!--搜索话题区域-->
	<div class="operation_display">
		<form action="/admin/topic/index" method="get" onsubmit="return checkSearch()">
			<select id="selection" name="type_id" id="topic_type" class="form-control" style="width: 140px;display: inline-block;">
				<option selected="select" value="">全部话题</option>
                @foreach ($topic_type as $type)
				    <option  value="{{$type['id']}}" 
                        @if( $type_id == $type['id']) selected 
                        @endif>{{$type['name']}}</option>
                @endforeach
			</select>
			<select name="reply_status" style="width: 110px;display: inline-block;" class="form-control">
				<option selected="select" value="">全部状态</option>
				<option value="1" @if( $reply_status == '1') selected @endif>已回复</option>
				<option value="0" @if( $reply_status == '0') selected @endif>未回复</option>
			</select>
			<input type="text" name="keyword" class="form-control" placeholder="请输入关键字" style="width: 200px;display: inline-block;" id="keyword_search"
            value="{{ $keyword }}">
			<input type="submit" value="查询" class="btn btn-primary">
			<!-- <button data-toggle="modal" data-target="#addTopic">添加话题分类</button> -->
		</form>

	</div>

<!--搜索结果-->
  <div id="search_result_display">

     <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <tbody>
                <tr>
                    <td><strong>话题标题</strong></td>
                    <td><strong>话题内容</strong></td>
                    <td><strong>留言者</strong></td>
                    <td><strong>管理员回复</strong></td>
                    <td colspan="3"><strong>操作</strong></td>
                </tr>
@foreach ($topics as $topic)
                 <tr>
                    <td>{{$topic['topic_title']}}</td>
                    <td id="content{{$topic['id']}}"></td>
                    <td>{{$topic['guest_name']}}</td>
                    <td id="rply">
                        @foreach ($topic['topic_replies'] as $topic_reply)
                            <div><span><strong>{{$topic_reply['replier']}}:</strong></span><p id="adminReply"></p></div>
                        @endforeach
                    </td>
                    <td>
                    	<input type="button"  value="回复" data-toggle="modal" data-target="#reply_topic{{$topic['id']}}" class="btn btn-primary">                   
                    	<input type="button" value="修改" data-toggle="modal" data-target="#modify_topic{{$topic['id']}}" class="btn btn-primary">
                    	<input type="button" value="删除" data-toggle="modal" data-target="#delete_topic{{$topic['id']}}" class="btn btn-primary" style="background-color: red;border-color: red">
                    	</td>

                    	 <!--回复话题-->
                    	<div class="modal" id="reply_topic{{$topic['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width: 100%">
                    	<div class="modal-dialog">
                    	<div class="modal-content">
                    	<div class="modal-header">
                    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    	&times;
                    	</button>
                    	<h4 style="text-align: center">回复话题</h4>
                    	</div>
                    	<form action="/admin/topic/reply" method="post" onsubmit="return checkReply('div{{$topic['id']}}')">
                    	<div class="modal-body">
                      	    <p><input type="hidden" name="topic_id" value="{{$topic['id']}}"></p><!--/*id="replyContent" 隐藏提交回复话题的topic_id提交*/

                    		/*富文本框*/-->
                            <div id="div{{$topic['id']}}" style="display: relative;z-index: 100;width:100%">
                            </div>
                    		<p><textarea type="text" name="reply_content" id="reply_content{{$topic['id']}}" class="form-control" style="width:100%;display: none"></textarea></p>
                    	</div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="modal-footer" style="text-align: center;">
                    		<input type="button" class="btn btn-default" data-dismiss="modal" value="取消"> 				
                    		<input type="submit" class="btn btn-primary" value="提交" >			
                    	</div>
                    </form>
                  </div><!-- /.modal-content -->
	             </div><!-- /.modal -->
                </div>
				<!--修改话题-->
				  <div class="modal" id="modify_topic{{$topic['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									&times;
								</button>
								<h4 style="text-align: center">修改话题</h4>
							</div>
							 <form action="/admin/topic/modify" method="post" onsubmit="return checkModify()"> 
							<div class="modal-body" style="font-size: 20px;text-align: center">
								<p><input type="hidden" name="topic_id" value="{{$topic['id']}}"></p>
								<p><span style="width: 20%;margin-right: 15px;">话题标题</span><input type="text" name="topic_title" class="form-control" value="{{$topic['topic_title']}}" style="width: 80%;"></p>

								<!--富文本框*/-->
                                <div id="modify{{$topic['id']}}"  style="display: relative;z-index: 100;width:100%">
                                </div>                              
								<p><span style="width: 20%;margin-right: 15px;"></span><textarea name="topic_content"  class="form-control" style="width: 100%;display:none;" type="text" id="modify_content{{$topic['id']}}">{{$topic['topic_content']}}
								</textarea></p>
							</div>
							<div class="modal-footer" style="text-align: center;">
								<input type="button" class="btn btn-default" data-dismiss="modal" value="取消"> 
								<input type="submit" class="btn btn-primary" value="修改" >			
							</div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
							</form>
						</div><!-- /.modal-content -->
					</div><!-- /.modal -->
				  </div>
				<!--删除话题-->
				  <div class="modal" id="delete_topic{{$topic['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header" style="border-bottom-width: 0">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									&times;
								</button>
							</div>
						
							<div class="modal-body">
								<p style="font-size:20px;text-align: center">确定删除该话题？</p>
							</div>
							<div class="modal-footer" style="text-align: center;border-top-color: white;">
								<form action="/admin/topic/delete" method="get" onsubmit="return checkDelete()">
								<p><input type="hidden" name="topic_id" value="{{$topic['id']}}"></p>
								<!--提交(隐藏)即将删除的话题的topic_id-->
								<input type="button" class="btn btn-default" data-dismiss="modal" value="取消"> 				
								<input type="submit" class="btn btn-primary" value="确认删除" style="background-color: red" >
								</form>
							</div>							
						</div><!-- /.modal-content -->
					</div><!-- /.modal -->
				  </div>
                </tr>    
@endforeach
               </tbody>
           </table>
      </div>	
   </div>
</div>
    

<footer>
	<div class="manager">@版权所有</div>		
</footer>
<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src='/js/wangEditor.js'></script>
<script type="text/javascript">

    $('#topicBtn').attr("class","btn btn-primary btn-lg");
    $('#typeBtn').attr("class","btn btn-default btn-lg");
    $("#bs-example-navbar-collapse-1 li").removeAttr("class");
    $("#topic").attr("class", "active");



 @foreach ($topics as $topic)

/*解析学生提问中的html标签*/
var test ='{{$topic['topic_content']}}';
var doc=$.parseHTML(test);  
$('#content{{$topic['id']}}').append(doc[0].data);

var i=1;
@foreach ($topic['topic_replies'] as $topic_reply)
$("#adminReply").attr("id","adminReply"+'{{$topic['id']}}'+i);
var Id="adminReply"+'{{$topic['id']}}'+i;
var reply='{{$topic_reply['reply_content']}}';

var rpy=$.parseHTML(reply);  
$('#'+Id).append(rpy[0].data);
i++;
@endforeach

 /****************************************************************/
 //用来创建（回复）模态框里面的富文本框
    var E = window.wangEditor;

    var editor{{$topic['id']}} = new E(document.getElementById("div{{$topic['id']}}"));

    editor{{$topic['id']}}.customConfig.onchange = function (html){
        // 监控变化，同步更新到 textarea
        document.getElementById("reply_content{{$topic['id']}}").innerHTML=html;
    }
    editor{{$topic['id']}}.customConfig.menus=[
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
    // editor{{$topic['id']}}.customConfig.uploadImgServer='/upload';
     editor{{$topic['id']}}.customConfig.uploadImgServer = '/wangEditor/image/reply/upload';  // 上传图片到服务器处理的php脚本
    editor{{$topic['id']}}.customConfig.uploadFileName = 'wangEditorH5File';
    editor{{$topic['id']}}.customConfig.uploadImgMaxLength = 5;//限制一次最多能传几张图片
    editor{{$topic['id']}}.customConfig.uploadImgHeaders = {
        'X-CSRF-TOKEN' : $('input[name="_token"]').val()
    };//上传图片时刻自定义设置 header
    editor{{$topic['id']}}.customConfig.uploadImgHooks = {
        before: function (xhr, editor{{$topic['id']}}, files) {
        },
        success: function (xhr, editor{{$topic['id']}}, result) {
            // 图片上传并返回结果，图片插入成功之后触发
            // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，result 是服务器端返回的结果
            alert("图片上传成功！");
        }
    };

    editor{{$topic['id']}}.create();
    // 初始化 textarea 的值
    document.getElementById("reply_content{{$topic['id']}}").innerHTML=editor{{$topic['id']}}.txt.html();
    
    
/*****************************************************************/
//用来创建（修改）模态框里面的富文本框     
    var E = window.wangEditor;
    var edit{{$topic['id']}}=new E(document.getElementById("modify{{$topic['id']}}"));

    edit{{$topic['id']}}.customConfig.onchange = function (html){
        // 监控变化，同步更新到 textarea
        document.getElementById("modify_content{{$topic['id']}}").innerHTML=html;
    }
    edit{{$topic['id']}}.customConfig.menus=[
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

   edit{{$topic['id']}}.customConfig.uploadImgHeaders = {
        'X-CSRF-TOKEN' : $('input[name="_token"]').val()
    };//注意
    edit{{$topic['id']}}.customConfig.uploadImgServer='/wangEditor/image/reply/upload';
    edit{{$topic['id']}}.customConfig.uploadFileName = 'wangEditorH5File';
    edit{{$topic['id']}}.customConfig.uploadImgHooks = {
        before: function (xhr, edit{{$topic['id']}}, files) {
        },
        success: function (xhr, edit{{$topic['id']}}, result) {
            // 图片上传并返回结果，图片插入成功之后触发
            // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，result 是服务器端返回的结果
            alert("图片上传成功！");
        }
    };


    edit{{$topic['id']}}.create();

    var adminModify ='{{$topic['topic_content']}}';
    var adm=$.parseHTML(adminModify);  
    // $('#content{{$topic['id']}}').append();
    edit{{$topic['id']}}.txt.html(adm[0].data);
    // 初始化 textarea 的值
    document.getElementById("modify_content{{$topic['id']}}").innerHTML=edit{{$topic['id']}}.txt.html();

/***************************************************************/    

@endforeach





</script>


</body>
</html>