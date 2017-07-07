<!DOCTYPE HTML>
<html lang="ja-JP">
<head>
	<?php echo $this->Html->charset("UTF-8"); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->css("j14016");
		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header">フレームワーク演習 : CakePHP</div>
		<div id="content">
			<?php echo $content_for_layout; ?>
		</div>
		<div id="footer">静岡産業技術専門学校みらい情報科3年test</div>
	</div>
</body>
</html>