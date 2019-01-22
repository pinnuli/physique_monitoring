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
</head>
<body>
<header>
       <img src="/image/running.png" style="width: 57px;margin-left: 16px;">
            <div class="round round1"></div>
            <div class="round round2"></div>
            <div class="round round3"></div>
</header>
<div class="main">
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

	    <!-- Collect the nav links, forms, and other content for toggling -->

	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li><a href="#">首页 <span class="sr-only"></span></a></li>
	        <li id="scoreSearch" class="active"><a href="/admin/admsearch">成绩搜索</a></li>
	        <li id="statisticsReport"><a href="/admin/statistics">统计报表</a></li>
	        <li id="topic"><a href="/admin/topic/index">交流互动区 </a></li>
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

                        <p><input type="text" name="username" placeholder="用户名" id="name" onclick="change()" class="form-control"></p >
                        <p id="test_name" style="font-size: 13px;"></p >
                        <p><input type="password" name="password" placeholder="密码" id="password1"  onclick="test()" class="form-control"/></p >
                        <p id="test_password" style="font-size: 13px;"></p >
                        <p><input type="password" name="password" placeholder="再次输入密码" id="password2" onclick="test1()"  class="form-control"></p >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <p id="test_password_again" style="font-size: 13px;"></p >
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
	        <p>
		        <a id="topicBtn" class="btn btn-primary btn-lg" href="/admin/topic/index" >话题管理</a>
		        <a id="typeBtn" class="btn btn-default btn-lg" href="/admin/topic/indexType">分类管理</a>
		    </p>
		</div>
		<div class="operation_display">
		    <p style="margin-top:20px;">
		        <a id="allBtn" class="btn btn-default" href="/admin/topic/indexType" >全部</a>
		        <a id="addBtn" class="btn  btn-primary"  data-toggle="modal" data-target="#addTopic">添加话题分类</a><br/>
	        </p> 
	    </div>
         <!--话题分类内容显示-->
		<div class="topic_type">
		     <div class="table-responsive">
		        <table class="table table-hover table-bordered">
		            <tbody>
		                <tr>
		                	<td><strong>话题分类</strong></td>
		                    <td><strong>分类名称</strong></td>
		                    <td><strong>分类关键字</strong></td>
		                    <td><strong>分类描述</strong></td>
		                    <td colspan="3"><strong>操作</strong></td>
		                </tr>
		@foreach ($types as $type)
		                 <tr>
		                    <td>{{$type['id']}}</td>
		                    <td>{{$type['name']}}</td>
		                    <td>{{$type['type_key']}}</td>
		                    <td>{{$type['type_desc']}}</td>
		                    <td>
								<input type="button" value="修改" class="btn btn-primary" data-toggle="modal" data-target="#modifyTopic{{$type['id']}}">
			           			<input type="button" value="删除" data-toggle="modal" data-target="#deleteTopic{{$type['id']}}" class="btn" style="background-color: red;color:white">	
<!-- 								<input type="button" value="修改" class="btn btn-primary" data-toggle="modal" data-target="#modifyTopic">
			           			<input type="button" value="删除" data-toggle="modal" data-target="#deleteTopic" class="btn" style="background-color: red;color:white">	 -->
		                    </td>
		<!--修改话题分类-->
							  <div class="modal" id="modifyTopic{{$type['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><!--id名称后面要加上话题分类id号-->
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">
												修改话题分类
											</h4>
										</div>
										<form onsubmit="return modifySubmit('name{{$type['id']}}','type_key{{$type['id']}}','type_desc{{$type['id']}}')" action="/admin/topic/modifyType" method="post">
										<div class="modal-body">
											<input type="hidden" name="type_id" value="{{$type['id']}}">
											<p>
												<span style="margin-left:15px">分类名称</span>
												<input type="text" name="name" class="form-control" style="display: inline-block;width: 200px;margin-left: 15px" id="name{{$type['id']}}" value="{{$type['name']}}" >
											</p>
											<p>
												<span>分类关键字</span>
												<input type="text" name="type_key" class="form-control" style="display:inline-block;width:200px;margin-left:17px" id="type_key{{$type['id']}}" value="{{$type['type_key']}}">
											</p>
											<p>
												<span style="margin-left: 16px">分类描述&nbsp;&nbsp;&nbsp;</span>
												<input type="text" name="type_desc" class="form-control" style="margin-left:3px" id="type_desc{{$type['id']}}" value="{{$type['type_desc']}}">
											</p>
										</div>
										<div class="modal-footer">
											<input type="button" class="btn btn-default" data-dismiss="modal" value="关闭"> 				
											<input type="submit" class="btn btn-primary" value="确认提交" id="submitBtn">						
										</div>
										</form>
									</div><!-- /.modal-content -->
								 </div><!-- /.modal -->
							   </div>

							<!--删除话题分类-->
							  <div class="modal" id="deleteTopic{{$type['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header" style="border-bottom-width: 0">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
										</div>
										<form action="/admin/topic/deleteType" method="get">
										<div class="modal-body"  >
											<input type="hidden" name="type_id" value="{{$type['id']}}">
											<p style="text-align: center;font-size: 20px">确认删除该话题分类</p>
										</div>
										<div class="modal-footer" style="border-top-width: 0;text-align: center">
											<input type="button" class="btn btn-default" data-dismiss="modal" value="关闭"> 				
											<input type="submit" class="btn btn-primary" value="确认删除" style="background-color: red">			
										</div>
										</form>
									</div><!-- /.modal-content -->
								</div><!-- /.modal -->
							  </div>
		                </tr>
	@endforeach	          
		            </tbody>
		        </table>
		    </div>


		</div>     




	<!--添加话题分类-->
   <div class="modal" id="addTopic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">
					添加话题分类
				</h4>
			</div>
			<form onsubmit="return addSubmit()" action="/admin/topic/addType" method="post">
			<div class="modal-body">
				<p><span style="margin-right:25px">分类名称</span><input type="text" class="form-control" placeholder="分类名称" name="name" id="nm"></p>
				<p><span style="margin-right:10px">分类关键字</span><input type="text" class="form-control" placeholder="分类关键字" name="type_key" id="keyword"></p>	
				<p><span style="margin-right:25px">分类描述</span><input type="text" class="form-control" placeholder="分类描述" name="type_desc" id="type_desc"></p>
			</div>
			<div class="modal-footer">
				<input type="button" class="btn btn-default" data-dismiss="modal" value="关闭">
				<input type="submit" class="btn btn-primary" value="确认提交" id="submitBtn">
			</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal -->
  </div>




 </div>


<footer>
	<div class="manager">@版权所有</div>		
</footer>
<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$('#typeBtn').attr("class","btn btn-primary btn-lg");
	$('#topicBtn').attr("class","btn  btn-default btn-lg");
    $("#bs-example-navbar-collapse-1 li").removeAttr("class");
    $("#topic").attr("class", "active");
    //判断(添加话题分类)时信息是否填写完整，填写完整才可提交

function addSubmit(){
		var s;
		if($('#nm').val().length>6||$('#keyword').length>6){
			alert("分类名称,分类关键字长度不能大于6");
			return false;
		}
	    else if($('#nm').val()==""||$('#keyword').val()==""||$('#type_desc').val()==""){
	    	alert("请将内容填写完整");
		    return false;
	    }
}
//判断(修改话题分类)时信息是否填写完整，同上
    function modifySubmit(a,b,c){

        var m=document.getElementById(a);
        var n=document.getElementById(b);
        var k=document.getElementById(c);
        if(m.value.length>6||n.value.length>6){
			alert("分类名称,分类关键字长度不能大于6");
			return false;	    	
	    }
	    if(m.value==""||n.value==""||k.value==""){
		    alert("请将信息填写完整");
		    return false;
	    }

	    return true;
    }
</script>

</body>
</html>