<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">
		.comment_name
		{
			color: #996600;
		}
	</style>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

</head>
<body>
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">IssuePang</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href='/?page=work'>작업</a></li>
				<li class=""><a href='/?page=mine'>내 작업</a></li>
				<li class=""><a href='/?page=plan'>기획</a></li>
				<li class=""><a href='/?page=program'>프로그램</a></li>
				<li class=""><a href='/?page=art'>아트</a></li>
				<li class=""><a href='/?page=all'>전체</a></li>
			</ul>
    
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">로그아웃</a></li>
			</ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
<?php
	foreach($issue_groups as &$issue_group)
	{
?>
		<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr class="success" title="{}포함 / {}제외">
				<th class="col-md-1">담당</th>
				<th class="col-md-1">관리정보</th>
				<th class="col-md-5" onclick="issue_add('1');" _onmouseover="this.bgColor='#777777'" _onmouseout="this.bgColor='#000000'">모든 작업-진행<span id='cnt_1'></span></th>
				<th class="col-md-5">진행 상황</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach($issue_group['Issues'] as &$issues)
				{
			?>	
					<tr>
						<td><?=$issues['Owner']?></td>
						<td><?=$issues['Status']?></td>
						<td class="markdown"><?=$issues['Issue']?></td>
						<td>
							<?php
								foreach($issues['Comments'] as &$comment )
								{
							?>
									<p>
										<span class="comment_name"><?=$comment['Writer']?></span>
										<?=$comment['Comment']?>
									</p>
							<?php
								}
							?>
						</td>
					</tr>
			<?php
				}
			?>
			<tr>
		</tbody>
		</table>
<?php
	}
?>
</div>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://fb.me/react-with-addons-0.13.3.min.js"></script>
<script src="https://fb.me/JSXTransformer-0.13.3.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/marked/0.3.2/marked.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('.markdown').each(function() {
			var text = $(this).html();
			$(this).html(marked(text));
		});
	});
</script>

</body>
</html>