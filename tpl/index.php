<html>
<head>
<meta charset="utf-8" />
<title>文章列表</title>
<link rel="stylesheet" href="/static/css/bootstrap.min.css" />
<link rel="stylesheet" href="/static/css/main.css" />
</head>
<body>
	<div class="panel panel-info">
		<div class="panel-heading clearfix">
<!--    <a href="" class="btn btn-info" style="float: left;">上一页</a>
		  <a href="" class="btn btn-info" style="float: right;">下一页</a> -->
		  文章列表
		</div>
		<!-- 
		<div class="panel-body">
			<p>文章均采集自互联网，本站不负责文章版权，如有侵权，请联系：lcmoook@gmail.com</p>
		</div> -->
		<table class="table">
		  <?php 
		    if (empty($article)){
		        
		    }
		  ?>
		</table>
	</div>
</body>
</html>