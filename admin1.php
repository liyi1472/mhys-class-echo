<?php
	$path = 'logs/';
	$files = scandir($path);
	$studentsStr = '常贺凇,杜程,冯佳林,冯泽华,高俊杰,黄晓龙,康嘉琦,李波,李昊哲,李嘉琪,李建炫,李晓焕,李云龙,连凯悦,刘继川,刘太清,刘钊,吕宁,马邵天,孟庆硕,孙亚娟,孙一铭,王田阳,王子涵,吴嘉,吴强,杨佳辉,杨茜凡,尹培卓,张瀚,张佳琪,张烨,张益铭,张钟月,赵一天,祖秉刚';

	if (isset($_GET['clear']) && $_GET['clear'] == 'yes') {
        foreach ($files as $file) {
            if ($file !="." && $file !="..") {
                unlink($path . $file);
            }
        }
        header('Location: ' . basename(__FILE__));
	}
	
	$status = [];
	$stat = '';
	foreach (explode(",", $studentsStr) as $studentName) {
		$status[$studentName] = $stat;
	}
	
	$countYes = 0;
	$countAlmost = 0;
	$countNo = 0;
    foreach ($files as $file) {
        if ($file !="." && $file !="..") {
            $fileNames = explode("-", $file);
            $studentName = $fileNames[0];
			$stat = $fileNames[1];
			switch ($stat) {
				case '听懂了':
					$countYes += 1;
					break;
				case '差不多':
					$countAlmost += 1;
					break;
				case '差挺多':
					$countNo += 1;
					break;
				default:
					// 未知类型
					break;
			}
        }
        $status[$studentName] = $stat;
        $countUnknownStatus = count($status) - $countYes - $countAlmost - $countNo;
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>教师端</title>
	<link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.6.1/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.slim.js"></script>
</head>
<body>

	<div style="text-align: center;padding-top: 2rem;">
		<button id="clearBtn" type="button" class="btn btn-secondary">
			重新提问
		</button>
		<button type="button" onclick="location.reload()" class="btn btn-primary">
			查看结果
			<span class="badge rounded-pill bg-light text-dark" style="padding: 5px;min-width: 22px;">
				<?php echo $countUnknownStatus; ?>
			</span>
		</button>
	</div>

	<div style="text-align: center;padding-top: 1rem;zoom: 1.5;">
		<span>（</span>
		<span class="badge bg-success text-light" style="min-width: 20px;">
			<?php echo $countYes; ?>
		</span>
		<span class="badge bg-warning text-dark" style="min-width: 20px;">
			<?php echo $countAlmost; ?>
		</span>
		<span class="badge bg-danger text-light" style="min-width: 20px;">
			<?php echo $countNo; ?>
		</span>
		<span>）</span>
	</div>

	<div class="container" style="text-align: center;padding-top: 1.5rem;">
	<hr>
	<?php foreach ($status as $studentName => $stat) { ?>
		<?php
			$spanClassName = 'btn btn-';
			switch ($stat) {
				case '听懂了':
					$spanClassName .= 'success';
					break;
				case '差不多':
					$spanClassName .= 'warning';
					break;
				case '差挺多':
					$spanClassName .= 'danger';
					break;
				default:
					// 未知类型
					$spanClassName .= 'dark';
					break;
			}
		?>
		<span class="<?php echo $spanClassName; ?>" style="margin: 3px auto;">
			<?php echo $studentName; ?>
		</span>
	<?php } ?>   
	</div> 

	<script>
		$(function () {
			$('#clearBtn').on('click', function() {
				location.href = '<?php echo basename(__FILE__); ?>?clear=yes';
			});
		});
	</script>
	
</body>
</html>