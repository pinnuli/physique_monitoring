 <!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>学生体质健康跟踪互动系统</title>
    <!-- 包含头部信息用于适应不同设备 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 包含 bootstrap 样式表 -->
    <link rel="stylesheet" href="https://apps.bdimg.com/libs/bootstrap/3.2.0/css/bootstrap.min.css">
<link href="/css/admsearchres.css" rel="stylesheet">
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
    <div class="mainbody_head">
       <span><a href="javascript :;" onClick="javascript :history.back(-1);">返回上一页</a></span>
      <span>
        <input type="button" onclick="{location.href='/admin/admlogout'}" value="退出" class="submit_form">
      </span>
    </div>
      <div class="stu_system_name">
             <p>学生体质健康跟踪互动系统</p>
            <p>Student Health Tracking Interactive System</p>
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
     </div>
      <footer>
            <p>@版权所有</p>
       </footer>
</div>
 <script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
</body>
</html>