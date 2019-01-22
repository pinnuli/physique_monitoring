<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>学生体质健康跟踪互动系统</title>
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="stylesheet" type="text/css" href="/css/admsearch.css">
<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="http://cdn.static.runoob.com/libs/jquery/1.10.2/jquery.min.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="../dist/css/wangEditor.min.css"> -->
<script src="/js/addAdmin.js"></script>
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

        <li  id="homepage"><a href="#">首页 <span class="sr-only">(current)</span></a></li>
        <li id="scoreSearch" class="active"><a href="/admin/admsearch">成绩搜索</a></li>
        <li id="statisticsReport"><a href="/admin/statistics">统计报表</a></li>
        <li id="topic"><a href="/admin/topic/index">交流互动区</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a data-toggle="modal" data-target="#addadmin">添加管理员</a></li>
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


  <div class="teacher_search_data">
    <div class="teacher_search_data_limit">

      <form method="get" action="/admin/admsearch" onsubmit="return search()">
      
        <input type="text" name="stu_id" placeholder="按学号搜索" class="form-control" value="{{ $stu_id }}" id="stuId">
        <input type="text" name="full_name" placeholder="按姓名搜索" class="form-control" value="{{ $full_name }}" id="fullName">
        <select name="total_point_grade" class="form-control">
          <option value="">按总分等级搜索</option>
          <option value="优秀" @if( $total_point_grade == '优秀') selected @endif>优秀</option>
          <option value="良好" @if( $total_point_grade == '良好') selected @endif>良好</option>
          <option value="及格" @if( $total_point_grade == '及格') selected @endif>及格</option>
          <option value="不及格" @if( $total_point_grade == '不及格') selected @endif>不及格</option>
        </select>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
        <input type="submit"  value="搜索" name="submitBtn" class="form-control submit_form1 "   />
      </form>
    </form>
    </div>
  </div>  

   <div class="search_result_display">
      <p>搜索结果如下</p>
                
        <div id="final_result_display">
@foreach ($users as $user)
                    <ul>
                      <li>{{$user['full_name']}}</li>
                      <li>学号：{{$user['stu_id']}}</li>
                      <li>年级：{{$user['grade_id']}}</li>
                      <li>班级：{{$user['class_name']}}</li>
                      <li>身高：{{$user['height']}}</li>
                      <li>体重：{{$user['weight']}}</li>
                      <li>总分：{{$user['total_point']}}</li>
                      <li>总分等级：{{$user['total_point_grade']}}</li>
                      <li><input type="button" onclick="{location.href='/admin/detailData/{{$user['stu_id']}}'}" value="查看详情" ></li>
                    </ul>
@endforeach
              </div>
               
      </div>

</div>

  <footer>
    <div class="manager">@版权所有</div>    
  </footer>

  

</div>
 <script src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>  
<script type="text/javascript" src='//unpkg.com/wangeditor/release/wangEditor.min.js'></script>
<script type="text/javascript">
// var E = window.wangEditor;
// var editor2 = new E('#editor');
// editor2.create();
function search(){
  if($("#stuId").val().length > 12&&$("#stuId").val().length!=0&&$("#fullName").val().length>5){
    alert("学号长度为12,姓名长度不能超过5");
  }
  else if($("#stuId").val().length > 12&&$("#stuId").val().length!=0){
    alert("学号长度为12");
    return false;
  }
  else if($("#fullName").val().length>5){
    alert("姓名长度不能超过5");
    return false;
  }
  else{
    return true;
  }
}
    $("#bs-example-navbar-collapse-1 li").removeAttr("class");
    $("#scoreSearch").attr("class","active");
</script>
    <style type="text/css">
     .table-responsive table tr td{
      border:1.5px solid rgb(160,160,160);
  }
    </style>   
</body>
</html>