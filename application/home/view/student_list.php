<!DOCTYPE html>
<html>
<head>
	<title>PHP原生开发</title>
</head>
<body>
	<?php foreach ($list as $v) { ?>
	<h6 width="100px" height="30px">
		<?php echo $v['s_name'];?> -> <?php echo $v['s_grade'];?>
	</h6>
	<?php } ?>
</body>
</html>