<?php
	if (isset($_POST['student']) && isset($_POST['status'])) {
		$student = $_POST['student'];
		$status = $_POST['status'];
		file_put_contents('logs/' . $student . '-' . $status, '');
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>学生端</title>
	<link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.6.1/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.slim.js"></script>
</head>
<body style="display: none;">

	<div style="text-align: center;padding-top: 2rem;">
		<strong>~ 姓名 ~<h1 id="student"></h1></strong>
		<p><a href="#" onclick="clearStudent()" style="color: black;">重设姓名</a></p>
		<br>
		<form id="form" method="post" action="index.php" style="zoom: 2;">
			<input type="hidden" name="student">
			<input type="hidden" name="status">
			<button id="yesBtn" type="button" class="btn btn-success">听懂了</button>
			<button id="almostBtn" type="button" class="btn btn-warning">差不多</button>
			<button id="noBtn" type="button" class="btn btn-danger">差挺多</button>
		</form>
	</div>

	<script>
		
		$(function() {

			var student = localStorage.getItem("student");
			if (!student) {
				student = window.prompt("同学你好！请在下方输入姓名：","");
				if (student) {
					localStorage.setItem("student", student);
					location.reload();
				}
			} else {
				$('#student').text(student);
				$('#form input[name=student]').val(student);
				$('body').show();
			}

			$('#yesBtn').on('click', function () {
				// if (confirm("真的听懂了吗？")) {
				$('#form input[name=status]').val("听懂了");
				$('#form').submit();
				// }
			});

			$('#almostBtn').on('click', function () {
				// if (confirm("真的差不多吗？")) {
				$('#form input[name=status]').val("差不多");
				$('#form').submit();
				// }
			});

			$('#noBtn').on('click', function () {
				// if (confirm("真的差挺多吗？")) {
				$('#form input[name=status]').val("差挺多");
				$('#form').submit();
				// }
			});

		});

		function clearStudent() {
			localStorage.setItem("student", "");
			location.reload();
		}

	</script>
	
</body>
</html>