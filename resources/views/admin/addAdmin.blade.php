<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>学生体质健康跟踪互动系统</title>
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="/css/addAdmin.css">
</head>
<body>
<div class="wrap">
	<header>
		<img src="/image/running.png" style="width: 57px;margin-left: 16px;">
		<div class="round round1"></div>
     		<div class="round round2"></div>
     		<div class="round round3"></div>
	</header>
	<div class="main">
	<div class="mainbody">
		<div class="stu_system">
			<span><a href="javascript :;" onClick="javascript :history.back(-1);">返回上一页</a></span>
		</div>
		<div class="stu_system_name">
			<p>学生体质健康跟踪互动系统</p>
			<p>Student Health Tracking Interactive System</p>
		</div>
		<div class="add_Admin">
			<div class="add1">
				<span class="register">
					添加管理员
				</span>			
				<form  method="post" action="/admin/addAdmin" onSubmit="return check();">
				<p><input type="text" name="username" placeholder="用户名" id="name" onclick="change()"></p>
				<p id="test_name"></p>
				<p><input type="password" name="password" placeholder="密码" id="password1"  onclick="test()"/></p>
				<p id="test_password"></p>
				<p><input type="password" name="password" placeholder="再次输入密码" id="password2" onclick="test1()" /></p>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<p id="test_password_again"></p>
				<input type="submit" value="添加" name="submitBtn" class="submit_form""/>
                                                   </form> 
                                      </div>
			<div class="add2"></div>

	             </div>
             </div>
             </div>
	<footer>
		<div class="manager">@版权所有</div>
	</footer>
</div>
<script type="text/javascript">
            function test(){
		var per=/[0-9a-zA-Z]{6,20}/;
		var tt=document.getElementById("name");
		if(tt.value==""){
			document.getElementById("test_name").innerHTML="用户名不能为空";
			document.getElementById("test_name").style.color="red";
		}
	             document.getElementById("test_password").style.color="black";
	             document.getElementById("test_password").innerHTML=" ";
	}
	function change(){
		document.getElementById("test_name").innerHTML=" ";
	}
	function test1(){
		var kk=document.getElementById("password1");
		var pp=document.getElementById("name");
		if(kk.value==""&&pp.value==""){
			document.getElementById("test_name").innerHTML="用户名不能为空";
			document.getElementById("test_name").style.color="red";
			document.getElementById("test_password").innerHTML="密码不能为空";
			document.getElementById("test_password").style.color="red";
		}
		else if(kk.value==""){
			document.getElementById("test_name").innerHTML="用户名不能为空";
			document.getElementById("test_name").style.color="red";			
		}
		else if(kk.value.length<6||kk.value.length>20){
			document.getElementById("test_password").innerHTML="密码由6-20位字符组成";
			document.getElementById("test_password").style.color="red";
		}
		document.getElementById("test_password_again").innerHTML=" ";
	}

	function check(){
		var pass=document.getElementById("password1");
		var v=document.getElementById("password2");
		var me=document.getElementById("name");
		if(me.value==""||(pass.value.length<6)||(pass.value.length>20)||pass.value==""){
			if(me.value==""&&pass.value==""){
			document.getElementById("test_name").innerHTML="用户名不能为空";
			document.getElementById("test_name").style.color="red";
			document.getElementById("test_password").innerHTML="密码不能为空";
			document.getElementById("test_password").style.color="red";
		             }
			 if(me.value==""){
			document.getElementById("test_name").innerHTML="用户名不能为空";
			document.getElementById("test_name").style.color="red";
			}
	             	if(pass.value==""){
	             	document.getElementById("test_password").innerHTML="密码不能为空";
			document.getElementById("test_password").style.color="red";
	             	}
	                           if(pass.value.length<6||pass.value.length>20){
			document.getElementById("test_password").style.color="red";
	             	}
	             	return false;
	              }
	              if(v.value==""||(pass.value!=v.value)||pass.value==""){
	              	if(v.value==""&&pass.value==""){
	             	document.getElementById("test_password").innerHTML="密码不能为空";
			document.getElementById("test_password").style.color="red"; 
			return false;            
	                          }
	             	else if(v.value==""){
			document.getElementById("test_password_again").innerHTML="请重复输入密码,以确认无误！";
			document.getElementById("test_password_again").style.color="red";
	             	}
	             	  else{
			document.getElementById("test_password_again").innerHTML="两次密码输入不同，请重新输入！";
			document.getElementById("test_password_again").style.color="red";
		             }
	             	return false;
	              }
	             return true;
	}

</script>
        <script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
       <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>     
</body>
</html>