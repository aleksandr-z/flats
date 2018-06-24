<!DOCTYPE html>
<html>
<head>
	<title>parser</title>
</head>
<body>
<style type="text/css">
	#main {
		margin:0 auto;
		width:800px;
		max-width: 100%;
		padding:10px;
	}

</style>
<div id="main">
	<form method="post">
		<input type="text" name="path">
		<input type="submit" value="парсить!">
	</form>
<?if (count($list)>0):?>
	<ul class="dates">
	<?dump($list);?>
	<?foreach ($list as $date => $f):?>
		<li class="$date"><?=$date?></li>
	<?endforeach;?>
	</ul>
	<div class="files">
	<?foreach ($list as $date):?>
		<?foreach ($date as $key):?>
			<div class="file"><a href="<?=$key["url"]?>"><?=$key["name"]?></a></div>
		<?endforeach;?>		
	<?endforeach;?>		
	</div>
<?endif;?>
</div>
</body>
</html>