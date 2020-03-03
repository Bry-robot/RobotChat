<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
		<link rel="shortcut icon" href="favicon.ico" />
		<title>RobotChat</title>
		<script src="js/jquery.js" type="text/javascript"></script>
		<link rel="stylesheet" href="css/main.css" type="text/css" />
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<script type="text/javascript">
			$(document).ready(function(){

				var localUrl = window.location.href;
				localUrl = localUrl.replace('web/', '');

				// só um advinhador simples
				var webServiceUrl 	= window.location.href.replace('web/', 'api.php');

				$('.clean').click(function(){

					Clear();
					AddText('system ', 'cleaning...');
					
					$('.userMessage').hide();

					$.ajax({
						  type: "GET",
						  url: webServiceUrl,
						  data: {
							  	requestType:'forget'
						  	},
						  success: function(response){
							  AddText('system ', 'Ok!');
							  $('.userMessage').show();
						  },
						  error: function(request, status, error)
						  {
							  Clear();
							  alert('error');
							  $('.userMessage').show();
						  }
						});
				});
				
				
				$('#fMessage').submit(function(){
					
					// get user input
					var userInput = $('input[name="userInput"]').val();
					
					// basic check
					if(userInput == '')
						return false;
					//
					
					// clear
					$('input[name="userInput"]').val('');
					
					// hide button
					$(this).hide();
					
					// show user input
					AddText('A ', userInput);
					
					$.ajax({
					  type: "GET",
					  url: webServiceUrl,
					  data: {
						  	input:userInput,
						  	requestType:'talk'
					  	},
					  success: function(response){
						  AddText('B ', response.message);
						  $('#fMessage').show();
						  $('input[name="userInput"]').focus();
					  },
					  error: function(request, status, error)
					  {
					  	  console.log(error);
						  alert('error');
						  $('#fMessage').show();
					  }
					});

					return false;
				});

				function Clear()
				{
					$('.chatBox').html('');
				}
				
				function AddText(user, message)
				{
					console.log(user);
					console.log(message);

					var div 	= $('<div>');
					var name	= $('<labe>').addClass('name');
					var text	= $('<span>').addClass('message');
					
					name.text(user + ':');
					text.text('\t' + message);
					
					div.append(name);
					div.append(text);
					
					$('.chatBox').append(div);
					
					$('.chatBox').scrollTop($(".chatBox").scrollTop() + 100);
				}
				
				
				
				
			});
			
	if(/Android (\d+\.\d+)/.test(navigator.userAgent)){
       var version = parseFloat(RegExp.$1);
    if(version>2.3){
       var phoneScale = parseInt(window.screen.width)/230;
       document.write('<meta name="viewport" content="width=230, minimum-scale = '+ phoneScale +', maximum-scale = '+ phoneScale +', user-scalable=no, target-densitydpi=device-dpi">');
       }else{
            document.write('<meta name="viewport" content="width=230, target-densitydpi=device-dpi">');
       }
       }else{
            document.write('<meta name="viewport" content="width=230, user-scalable=no, target-densitydpi=device-dpi">');
       }
		</script>
	</head>
	<body id="body">
		<div class="box_head">
			<div class="box_left"><a href="#">返回</a></div>
			<div class="box_center">标题</div>
			<div class="box_right"><a href="#">菜单</a></div>
		</div>
		<center class="box_body">
				<div class="chatBox">
					<p>欢迎~我是你爸爸哈哈哈</p>
				</div>
				<div id="box2" class="userMessage">
					<form id="fMessage">
						<input id="clean" type="button" class="clean" value="清屏" style="border-radius:50px;"/>
						<input type="text" name="userInput" id="userInput" style="border-radius:50px;"/>
						<input id="send" type="submit" value="发送" class="send" style="border-radius:50px;"/>
					</form>
				</div>
		</center>
	</body>


</html>
