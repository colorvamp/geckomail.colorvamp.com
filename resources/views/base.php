<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<title>{%BLOG.TITLE%}</title>
	<script type="text/javascript" src="{%baseURL%}js/coreJS.402.js"></script>
	{%BLOG.JS%}
	<link rel="StyleSheet" href="{%baseURL%}css/geckomail.css" type="text/css" media="screen"/>
	<link rel="StyleSheet" href="{%baseURL%}css/font-awesome.min.css" type="text/css" media="screen"/>
	{%BLOG.CSS%}
</head>
<body onload="if(window.init){window.init();}">
	<div class="page">
		<div class='header'>
			
		</div>
		<div class='body'>
			<aside>
				<div class="user">
					<div class="image"><img src="{%baseURL%}r/images/avatars/default/av64.png"/></div>
					<div class="content">
						<h2>{%user_userName%}</h2>
						<p>Organize // <a href="{%baseURL%}logout">Logout</a></p>
					</div>
				</div>
				<ul class="folders">
					<li>Inbox</li>
					<li>Sent</li>
					<li>Important</li>
					<li>Drafts</li>
					<li>Trash</li>
				</ul>
			</aside>
			<div>
				{%MAIN%}
			</div>
		</div>
		<div class='footer'>
			<p>Copyright © 2013 sombra2eternity for colorvamp.com</p>
		</div>
	</div>
</body>
</html>
