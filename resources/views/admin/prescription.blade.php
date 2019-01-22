




<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>学生体质健康跟踪互动系统</title>
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
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
				        <table class="table" cellpadding="0" style="border:2px grey solid;text-align:center;">
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

<script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>     
</body>
</html>