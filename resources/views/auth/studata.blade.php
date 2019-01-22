<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8" >

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>学生体质健康跟踪互动系统</title>
    <!-- 包含头部信息用于适应不同设备 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 包含 bootstrap 样式表 -->
<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="http://cdn.static.runoob.com/libs/jquery/1.10.2/jquery.min.js"></script>
<link href="/css/studata.css" rel="stylesheet">
<script src="/js/prescription.js"></script>
<script src="/js/print.js"></script>
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
			<div class="stu_data_head">
				<span><button onclick="printf('print')" class="submit_form">打印</button></span>
				<span><input type="button" onclick="{location.href='/auth/topic/index'}" value="交流互动区" class="submit_form"></span>
				<span><input type="button" onclick="{location.href='/auth/stulogout'}" value="退出" class="submit_form"></span>
			</div>
			<div class="stu_system_name">
				<p>学生体质健康跟踪互动系统</p>
				<p>Student Health Tracking Interactive System</p>
		    </div>

		    <div id="print">
			<div class="stu_data_list">
				<div class="table-responsive">
				<table class="table" cellpadding="0" style="border:2px grey solid;text-align:center;">
				<tr>
				<td>姓名</td>
				<td colspan="3">{{$user[41]["full_name"]}}</td>
				<td colspan="2">性别</td>
				<td>{{$user[41]["sex"]}}</td>
				<td colspan="3">出生日期</td>
				<td colspan="3">{{$user[41]["date_of_birth"]}}</td>
				</tr>

				<tr>
				<td>学院</td>

				<td colspan="2">{{$user[41]["college_name"]}}</td>
				<td>班级</td>
				<td colspan="4">{{$user[41]["class_name"]}}</td>

				<td colspan="2">学号</td>
				<td colspan="3">{{$user[41]["stu_id"]}}</td>
				</tr>

				<tr>
				<td rowspan="2">单项</td>
				<td colspan="3">大一</td>
				<td colspan="3">大二</td>
				<td colspan="3">大三</td>
				<td colspan="3">大四</td>
				</tr>

				<tr>
				<td>成绩</td>
				<td>得分</td>
				<td>等级</td>
				<td>成绩</td>
				<td>得分</td>
				<td>等级</td>
				<td>成绩</td>
				<td>得分</td>
				<td>等级</td>
				<td>成绩</td>
				<td>得分</td>
				<td>等级</td>
				</tr>


				<tr>
				<td>体重指数(BMI)(千克/米^2)</td>
				<td>{{$user[41]["baric_index"]}}</td>
				<td></td>
				<td>
					
				    <a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription('体重指数','{{$user[41]['baric_index_grade']}}')">{{$user[41]['baric_index_grade']}}</a>	  
				
			    </td>
				<td>{{$user[42]["baric_index"]}}</td>
				<td></td>
				<td> 
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription('体重指数','{{$user[42]['baric_index_grade']}}')">{{$user[42]['baric_index_grade']}}</a>
				</td>
				
				<td>{{$user[43]["baric_index"]}}</td>
				<td></td>
				<td>
                    <a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription('体重指数','{{$user[43]['baric_index_grade']}}')">{{$user[43]['baric_index_grade']}}</a>					
				</td>

				
				<td>{{$user[44]["baric_index"]}}</td>
				<td></td>
				<td><a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription('体重指数','{{$user[44]['baric_index_grade']}}')">{{$user[44]['baric_index_grade']}}</a></td>

				</tr>

				<tr>
				<td>肺活量(毫升)</td>
				<td>{{$user[41]["vital_capacity"]}}</td>
				<td>{{$user[41]["vital_capacity_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription('肺活量','{{$user[41]['vital_capacity_grade']}}')">{{$user[41]['vital_capacity_grade']}}</a>
				</td>


				<td>{{$user[42]["vital_capacity"]}}</td>
				<td>{{$user[42]["vital_capacity_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription('肺活量','{{$user[42]['vital_capacity_grade']}}')">{{$user[42]['vital_capacity_grade']}}</a></td>

				<td>{{$user[43]["vital_capacity"]}}</td>
				<td>{{$user[43]["vital_capacity_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription('肺活量','{{$user[43]['vital_capacity_grade']}}')">{{$user[43]['vital_capacity_grade']}}</a>
				</td>


				<td>{{$user[44]["vital_capacity"]}}</td>
				<td>{{$user[44]["vital_capacity_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription('肺活量','{{$user[44]['vital_capacity_grade']}}')">{{$user[44]['vital_capacity_grade']}}</a></td>

				</tr>


				<tr>
				<td>50米跑(秒)</td>
				<td>{{$user[41]["fifty_meter_dash"]}}</td>
				<td>{{$user[41]["fifty_meter_dash_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription('50米跑','{{$user[41]['fifty_meter_dash_grade']}}')">{{$user[41]['fifty_meter_dash_grade']}}</a>
				</td>

				<td>{{$user[42]["fifty_meter_dash"]}}</td>
				<td>{{$user[42]["fifty_meter_dash_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription('50米跑','{{$user[42]['fifty_meter_dash_grade']}}')">{{$user[42]['fifty_meter_dash_grade']}}</a>

				</td>

				<td>{{$user[43]["fifty_meter_dash"]}}</td>
				<td>{{$user[43]["fifty_meter_dash_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription('50米跑','{{$user[43]['fifty_meter_dash_grade']}}')">{{$user[43]['fifty_meter_dash_grade']}}</a>
				</td>

				<td>{{$user[44]["fifty_meter_dash"]}}</td>
				<td>{{$user[44]["fifty_meter_dash_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription('50米跑','{{$user[44]['fifty_meter_dash_grade']}}')">{{$user[44]['fifty_meter_dash_grade']}}</a>

				</td>

				</tr>

				<tr>
				<td>坐位体前屈(厘米)</td>
				<td>{{$user[41]["sit_and_reach"]}}</td>
				<td>{{$user[41]["sit_and_reach_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription('坐位体前屈','{{$user[41]['sit_and_reach_grade']}}')">{{$user[41]['sit_and_reach_grade']}}</a>
				</td>
				

				<td>{{$user[42]["sit_and_reach"]}}</td>
				<td>{{$user[42]["sit_and_reach_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription('坐位体前屈','{{$user[42]['sit_and_reach_grade']}}')">{{$user[42]['sit_and_reach_grade']}}</a>
				</td>

				<td>{{$user[43]["sit_and_reach"]}}</td>
				<td>{{$user[43]["sit_and_reach_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription('坐位体前屈','{{$user[43]['sit_and_reach_grade']}}')">{{$user[43]['sit_and_reach_grade']}}</a>
				</td>

				<td>{{$user[44]["sit_and_reach"]}}</td>
				<td>{{$user[44]["sit_and_reach_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription('坐位体前屈','{{$user[44]['sit_and_reach_grade']}}')">{{$user[44]['sit_and_reach_grade']}}</a>
			    </td>
		
				</tr>


				<tr>
				<td>立定跳远(厘米)</td>
				<td>{{$user[41]["standing_long_jump"]}}</td>
				<td>{{$user[41]["standing_long_jump_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription('立定跳远','{{$user[41]['standing_long_jump_grade']}}')">{{$user[41]['standing_long_jump_grade']}}</a>
				</td>

				<td>{{$user[42]["standing_long_jump"]}}</td>
				<td>{{$user[42]["standing_long_jump_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription('立定跳远','{{$user[42]['standing_long_jump_grade']}}')">{{$user[42]['standing_long_jump_grade']}}</a>
				</td>

				<td>{{$user[43]["standing_long_jump"]}}</td>
				<td>{{$user[43]["standing_long_jump_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription('立定跳远','{{$user[43]['standing_long_jump_grade']}}')">{{$user[43]['standing_long_jump_grade']}}</a>
				</td>

				<td>{{$user[44]["standing_long_jump"]}}</td>
				<td>{{$user[44]["standing_long_jump_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription('立定跳远','{{$user[44]['standing_long_jump_grade']}}')">{{$user[44]['standing_long_jump_grade']}}</a>
			    </td>
				</tr>

              <tr>
				<td>引体向上(男)/1分钟 仰卧起坐(女)(次)</td>
				<td>{{$user[41]["strength"]}}</td>
				<td>{{$user[41]["strength_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription1('{{$user[41]['sex']}}','{{$user[41]['strength_grade']}}')">{{$user[41]['strength_grade']}}</a> 
				</td>
				
				<td>{{$user[42]["strength"]}}</td>
				<td>{{$user[42]["strength_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription1('{{$user[41]['sex']}}','{{$user[42]['strength_grade']}}')">{{$user[42]['strength_grade']}}</a>
				</td>
				
				<td>{{$user[43]["strength"]}}</td>
				<td>{{$user[43]["strength_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription1('{{$user[41]['sex']}}','{{$user[43]['strength_grade']}}')">{{$user[43]['strength_grade']}}</a>
				</td>
				
				<td>{{$user[44]["strength"]}}</td>
				<td>{{$user[44]["strength_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription1('{{$user[41]['sex']}}','{{$user[44]['strength_grade']}}')">{{$user[44]['strength_grade']}}</a>
				</td>
				</tr>

	            <tr>
				<td>1000米跑(男)/800米跑(女)(分*秒)</td>
				<td>{{$user[41]["long_distance"]}}</td>
				<td>{{$user[41]["long_distance_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription2('{{$user[41]['sex']}}','{{$user[41]['long_distance_grade']}}')">{{$user[41]['long_distance_grade']}}</a>
				</td>
				
				<td>{{$user[42]["long_distance"]}}</td>
				<td>{{$user[42]["long_distance_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription2('{{$user[41]['sex']}}','{{$user[42]['long_distance_grade']}}')">{{$user[42]['long_distance_grade']}}</a>
				</td>
				
				<td>{{$user[43]["long_distance"]}}</td>
				<td>{{$user[43]["long_distance_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription2('{{$user[41]['sex']}}','{{$user[43]['long_distance_grade']}}')">{{$user[43]['long_distance_grade']}}</a>
				</td>
				
				<td>{{$user[44]["long_distance"]}}</td>
				<td>{{$user[44]["long_distance_score"]}}</td>
				<td>
					<a data-toggle="modal" data-target="#exercise_prescription"  onclick="prescription2('{{$user[41]['sex']}}','{{$user[44]['long_distance_grade']}}')">{{$user[44]['long_distance_grade']}}</a>
				</td>
				</tr>

				<tr>
				<td>总评成绩</td>
				<td colspan="3">{{$user[41]["total_score"]}}</td>
				<td colspan="3">{{$user[42]["total_score"]}}</td>
				<td colspan="3">{{$user[43]["total_score"]}}</td>
				<td colspan="3">{{$user[44]["total_score"]}}</td>
				</tr>
				<tr>
				<td>总评等级</td>
				<td colspan="3">{{$user[41]["total_grade"]}}</td>
				<td colspan="3">{{$user[42]["total_grade"]}}</td>
				<td colspan="3">{{$user[43]["total_grade"]}}</td>
				<td colspan="3">{{$user[44]["total_grade"]}}</td>

				</tr>
				
				</table>
				</div>
		       </div>
		   </div>
		</div>
	  </div>

    <!--运动处方-->
	<div class="modal" id="exercise_prescription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                <h4 class="modal-title" id="myModalLabel">运动处方</h4>
	            </div>
	            <div class="modal-body">
	            	<div class="table-responsive">
				        <table class="table" cellpadding="0" style="border:2px grey solid;text-align:left;">
				        	<tr>
				        		<td>级别</td>
				        		<td>运动目的</td>
				        		<td>运动项目</td>
				        		<td>运动强度</td>
				        		<td>运动时间</td>
				        		<td>运动频率</td>
				        	</tr>
				        	<tr>
				        		<td id="p_grade">级别</td>
				        		<td id="p_purpose">运动目的</td>
				        		<td id="p_event">运动项目</td>
				        		<td id="p_intensity">运动强度</td>
				        		<td id="p_time">运动时间</td>
				        		<td id="p_frequency">运动频率</td>
				        	</tr>
				        </table>
				    </div>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
	            </div>
	        </div><!-- /.modal-content -->
	    </div><!-- /.modal -->
	</div>

    <!--以上-->


	<footer>
		<div class="manager">@版权所有</div>
	</footer>

</div>

<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
<!-- 可选: 合并了 Bootstrap JavaScript 插件 -->
<script src="https://apps.bdimg.com/libs/bootstrap/3.2.0/js/bootstrap.min.js"></script>

</html>