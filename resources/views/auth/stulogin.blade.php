<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>学生体质健康跟踪互动系统</title>
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="/css/stulogin.css">
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
		<div class="stu_system_name">
			<p>学生体质健康跟踪互动系统</p>
			<p>Student Health Tracking Interactive System</p>
		</div>
		<div class="stu_login">
			<div class="login1">
				<span class="login1_stu">
					学生查询登录
				</span>
				<span class="login1_tea">
					<a href="/admin/admlogin">管理员登录</a>
				</span>				

			<div class="submit">
				<p><input type="text" name="stu_id" placeholder="学号"></p>
				<p><input type="password" name="password" placeholder="出生年月"/></p>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="submit" value="登录" name="submitBtn" class="submit_form" onclick="login()" style="	height:40px;border:1px solid #0DCEE2;background-color:#0DCEE2;color:white;" />
            </div>   
          </div>
		   <div class="login2"></div>

          </div>
         </div>
         </div>
	<footer>
		<div class="manager">@版权所有</div>
	</footer>
</div>
<script type="text/javascript">
function login(){
	var id = $("input[name='stu_id']").val();
    var password = $("input[name='password']").val();
    var _token = $("input[name = '_token']").val();
    var back_id = id.substring(2);
    $.ajax({
        url:'/auth/stulogin',
        type:'POST',
        dataType:'json',
        data:{"stu_id":id,"password":password,"_token":_token},
        success:function(data){
            console.log(data);
            if(data.errcode == 0){
            	window.location.href="/auth/studata/" + back_id;
            }
            else if(data.errcode == 1){
                alert('登录失败 '+data.errmsg);
            }
        
        },
        error:function(){
            alert('系统错误');
        }  
    });

}
</script>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>     
</body>
</html>