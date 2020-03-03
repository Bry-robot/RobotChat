<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link rel="shortcut icon" href="web/favicon.ico"/>
    <title>RobotChat</title>
    <script src="web/js/jquery.js" type="text/javascript"></script>
    <link rel="stylesheet" href="web/css/main.css" type="text/css"/>
	<meta name="viewport" content="width=drvice-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
    <script type="text/javascript">
        $(document).ready(function () {

            var localUrl = window.location.href;
            localUrl = localUrl.replace('web/', '');

            // só um advinhador simples
            var webServiceUrl = window.location.href + 'api.php';
            console.log(webServiceUrl);
            $('.clean').click(function () {

                Clear();
                AddText('system ', 'cleaning...');

                $('.userMessage').hide();

                $.ajax({
                    type: "GET",
                    url: webServiceUrl,
                    data: {
                        requestType: 'forget'
                    },
                    success: function (response) {
                        AddText('system ', 'Ok!');
                        $('.userMessage').show();
                    },
                    error: function (request, status, error) {
                        Clear();
                        alert('error');
                        $('.userMessage').show();
                    }
                });
            });


            $('#fMessage').submit(function () {

                // get user input
                var userInput = $('input[name="userInput"]').val();

                // basic check
                if (userInput == '')
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
                        userInput: userInput,
                        requestType: 'talk'
                    },
                    success: function (response) {
                        console.log(webServiceUrl);
                        console.log(userInput);
                        AddText('B ', response.message);
                        $('#fMessage').show();
                        $('input[name="userInput"]').focus();
                    },
                    error: function (request, status, error) {
                        console.log(error);
                        alert('error');
                        $('#fMessage').show();
                    }
                });

                return false;
            });

            function Clear() {
                $('.chatBox').html('');
            }

            function AddText(user, message) {
                console.log(user);
                console.log(message);

                var div = $('<div>');
                var name = $('<labe>').addClass('name');
                var text = $('<span>').addClass('message');

                name.text(user + ':');
                text.text('\t' + message);

                div.append(name);
                div.append(text);

                $('.chatBox').append(div);

                $('.chatBox').scrollTop($(".chatBox").scrollTop() + 100);
            }


        });
        
    </script>
</head>
	<body id="body">
		<div class="box_head">
			<div class="box_left"><a href="#">返回</a></div>
			<div class="box_center">标题</div>
			<div class="box_right"><a href="#">菜单</a></div>
		</div>
		<center>
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