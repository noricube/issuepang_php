<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?><!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style>
		@import url(http://fonts.googleapis.com/earlyaccess/nanumgothic.css);
	</style>
	<style type="text/css">
		.comment_name
		{
			color: #996600;
		}
		
		.comment_date
		{
			color: #999;
		}
		
		.comments p
		{
			margin: 0em;
			line-height: 1.2;
		}
		
		.owner
		{
			margin: 0em;
		}
		
		.issue .issue_editor
		{
			display:none;
		}
		
		.issue_edit .issue_title
		{
			display:none;
		}
		
		.issue_id
		{
			margin: 0em;
		}

		p, body
		{
			font-family: 'Nanum Gothic', sans-serif !important;
		}
	</style>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap-theme.min.css">

</head>
<body>
<?php /*
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
			<tr class="success">
				<th class="col-md-1">담당 / 이슈ID</th>
				<th class="col-md-1">관리정보</th>
				<th class="col-md-5" onclick="issue_add('1');" _onmouseover="this.bgColor='#777777'" _onmouseout="this.bgColor='#000000'"><?=$issue_group['Title']?></th>
				<th class="col-md-5">진행 상황</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach($issue_group['Issues'] as &$issues)
				{
			?>	
					<tr>
						<td style="text-align: center;">
						<?php if ( strlen($issues['Owner']) == 0 )
						{
							?>
								<p class="owner"><a href="<?=site_url(array('issue', 'toggle_assign', $issues['SN']))?>">[ - ]</a></p>
							<?php
							
						}
						else
						{
							?>
								<p class="owner"><a href="<?=site_url(array('issue', 'toggle_assign', $issues['SN']))?>"><?=$issues['Owner']?></a></p>
							<?php
						}	
						?>
							<p class="issue_no"><?=$issues['SN']?></p>
						</td>
						<td style="text-align: center;">
							<div class="btn-group" role="group">
								<a href="#" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown"><?=$issues['Status']?><span class="caret"></span></a>
								<ul class="dropdown-menu">
								<?php foreach($set_order as &$order )
								{ ?>
									<li><a href="<?=site_url(array('issue', 'change_status', $issues['SN'], $order))?>"><?=$order?></a></li>
								<?php
								}
								?>
								</ul>
								<a href="#" class="btn btn-xs btn-default" onclick="tag_add('2');">+</a>
							</div>
						</td>
						<td class="markdown"><?=$issues['Issue']?></td>
						<td class="comments">
							<?php
								foreach($issues['Comments'] as &$comment )
								{
							?>
									<p>
										<span class="comment_name"><?=$comment['Writer']?></span>
										<?=auto_link_text($comment['Comment'])?>
										<span class="comment_date"><?=date('m-d H:i' ,strtotime($comment['WrittenTime']))?></span>
									</p>
							<?php
								}
							?>
							<p>
								<button class="btn btn-xs btn-default">답글</button>
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

*/ ?>

<section id="app"></section>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="//fb.me/react-with-addons-0.13.3.js"></script>
<script src="//fb.me/JSXTransformer-0.13.3.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/marked/0.3.2/marked.min.js"></script>
<script src="//cdn.jsdelivr.net/refluxjs/0.2.11/reflux.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<Script src="//cdnjs.cloudflare.com/ajax/libs/superagent/1.2.0/superagent.min.js"></script>

<script type="text/javascript">
	/* marked 링크를 새창으로 열리도록 */
	myRenderer = new marked.Renderer();
	myRenderer.link = function(href, title, text) {
		var external, newWindow, out;
		
		external = /^https?:\/\/.+$/.test(href);
		newWindow = external || title === 'newWindow';
		
		out = "<a href=\"" + href + "\"";
		if (newWindow) {
			out += ' target="_blank"';
		}
		if (title && title !== 'newWindow') {
			out += " title=\"" + title + "\"";
		}
		
		return out += ">" + text + "</a>";
	};
	
	marked.setOptions({renderer: myRenderer});
	
	csrfToken = '<?php echo $this->security->get_csrf_token_name(); ?>';
	csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>

<script type="text/jsx" src="<?=base_url()?>assets/js/app/issue.js" charset="utf-8"></script>
<script type="text/jsx" src="<?=base_url()?>assets/js/app/issue_actions.jsx" charset="utf-8"></script>
<script type="text/jsx" src="<?=base_url()?>assets/js/app/issue_store.jsx" charset="utf-8"></script>
<script type="text/jsx" src="<?=base_url()?>assets/js/app/issue_comment.jsx" charset="utf-8"></script>
<script type="text/jsx" src="<?=base_url()?>assets/js/app/issue_comments.jsx" charset="utf-8"></script>
<script type="text/jsx" src="<?=base_url()?>assets/js/app/issue_row.jsx" charset="utf-8"></script>
<script type="text/jsx" src="<?=base_url()?>assets/js/app/issue_group.jsx" charset="utf-8"></script>
<script type="text/jsx" src="<?=base_url()?>assets/js/app/app.jsx" charset="utf-8"></script>
<script type="text/jsx" src="<?=base_url()?>assets/js/app/main.jsx" charset="utf-8"></script>

</body>
</html>