<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="robots" content="noindex">
		<title>Kelionės</title>
		<link rel="stylesheet" type="text/css" href="scripts/datetimepicker/jquery.datetimepicker.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="style/main.css" media="screen" />
		<script type="text/javascript" src="scripts/jquery-1.12.0.min.js"></script>
		<script type="text/javascript" src="scripts/datetimepicker/jquery.datetimepicker.full.min.js"></script>
		<script type="text/javascript" src="scripts/main.js"></script>
	</head>
	<body>
		<div id="body">
			<div id="header">
				<h3 id="slogan"><a href="index.php">Indai :)</a></h3>
			</div>
			<div id="content">
				<div id="topMenu">
					<ul class="float-left">
						<li><a href="index.php?module=miestas&action=list" title="Miestas"<?php if($module == 'miestas') { echo 'class="active"'; } ?>>Miestas</a></li>
						<li><a href="index.php?module=paslaugos&action=list" title="Paslaugos"<?php if($module == 'paslaugos') { echo 'class="active"'; } ?>>Paslaugos</a></li>
						<li><a href="index.php?module=darbuotojas&action=list" title="Darbuotojai"<?php if($module == 'darbuotojas') { echo 'class="active"'; } ?>>Darbuotojai</a></li>
						<li><a href="index.php?module=sutartis&action=list" title="Sutartys"<?php if($module == 'sutartis') { echo 'class="active"'; } ?>>Sutartys</a></li>
						<li><a href="index.php?module=mokejimas&action=list" title="Mokejimas"<?php if($module == 'mokejimas') { echo 'class="active"'; } ?>>Mokejimas</a></li>
						<li><a href="index.php?module=imone&action=list" title="Imone"<?php if($module == 'imone') { echo 'class="active"'; } ?>>Imones</a></li>
					</ul>
				</div>
				<div id="contentMain">
					<?php
						// įtraukiame veiksmų failą
						if(file_exists($actionFile)) {
							include $actionFile;
						}
					?>
					<div class="float-clear"></div>
				</div>
			</div>
			<div id="footer">

			</div>
		</div>
	</body>
</html>