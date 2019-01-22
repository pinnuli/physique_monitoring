<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>学生体质健康跟踪互动系统</title>
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="stylesheet" type="text/css" href="/css/stuTopic.css">
<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="http://cdn.static.runoob.com/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="/js/stuTopic.js">
</script>

</head>
<body>
<div class="wrap">
  <header>
        <img src="/image/running.png" style="width: 57px;margin-left: 16px;">
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
          <a href="javascript:;" onclick="javascript:history.go(-1);">我的成绩</a>
        </span>
        <span><input type="button" onclick="{location.href='/auth/stulogout'}" value="退出" class="submit_form"></span>
    </div>
     <div class="stu_system_name">
       <p>学生体质健康跟踪互动系统</p>
       <p>Student Health Tracking Interactive System</p>
    </div>
    <div class="operation_choose">
      <input type="button"  value="查看话题" class="show_topicSelection">
      <input type="button"  value="发起话题
      " class="show_topicRaise" onclick="{location.href='/auth/topic/getAdd'}">
    </div>
    <div class="topic_selection">
      <form action="/auth/topic/index" method="get" onsubmit="return checkKeyword()">
      <select id="selection" class="form-control" name="type_id">
        <option selected="select" value="" >
          全部话题
        </option>
        @foreach ($topic_type as $type)
            <option  value="{{$type['id']}}" 
                @if( $type_id == $type['id']) selected 
                @endif>{{$type['name']}}</option>
        @endforeach
      </select>      
      <input type="text" name="keyword" placeholder="请输入关键字" class="keyword form-control" id="keyword" value="{{ $keyword }}">
      <input type="submit" value="搜索" id="search" class="form-control" style="color:white">
      </form>
      </div>
      <div id="search_result_display">
          @foreach ($topics as $topic)
         <ul>
            <li><strong>{{$topic['topic_sponsor']}}:</strong>&nbsp;&nbsp;&nbsp;{{$topic['topic_title']}}</li>
            <li><strong>留言内容:</strong>
              <p id="content"></p>
            </li>
            <li>
              <div style="padding:8px 15px"><strong>管理员回复：</strong></div>
              @foreach ($topic['topic_replies'] as $reply)
              <div style="overflow: hidden"><strong style="float: left;">{{$reply['replier']}}:</strong><p id="adminReply" style="float: left;padding-bottom: 0px"></p></div>
              @endforeach
            </li>
          </ul>
        @endforeach       
     </div>
 
   </div>
</div>
</div>
<!--        <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <tbody>
                <tr>
                    <td><strong>话题标题</strong></td>
                    <td><strong>话题内容</strong></td>
                    <td><strong>留言者</strong></td>
                    <td><strong>管理员回复</strong></td>
                </tr>
                @foreach ($topics as $topic)
                 <tr>
                    <td>{{$topic['topic_title']}}</td>
                    <td>{{$topic['topic_content']}}</td>
                    <td>{{$topic['topic_sponsor']}}</td>
                    <td>
                      @foreach ($topic['topic_replies'] as $reply)
                        <p>{{$reply['replier']}}+":&nbsp;&nbsp;"+{{$reply['reply-content']}}</p>
                      @endforeach
                    </td>
                  </tr>
                @endforeach     
              </tbody>  
          </table>          
      </div> -->
    
<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">

var i=1;

@foreach ($topics as $topic)
/*解析学生提问中的html标签*/

$("#content").attr("id","content"+i);
var Id="content"+i;
var topic='{{$topic['topic_content']}}';
var tpc=$.parseHTML(topic);  
$('#'+Id).append(tpc[0].data);
i++;



var j=1;
  @foreach ($topic['topic_replies'] as $reply)
  $("#adminReply").attr("id","adminReply"+i+j);
  var token="adminReply"+i+j;
  var reply='{{$reply['reply_content']}}';
  var rpy=$.parseHTML(reply);  
  $('#'+token).append(rpy[0].data);
  j++;
  @endforeach
@endforeach
</script>    


</body>
</html>
