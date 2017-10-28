<!doctype html>
<html>
<head>
	<title>Layouts Manager<?php echo $title_for_layout; ?></title>
	<?php echo $this->layouts->print_includes(); ?>
</head>
<body>
<h1>Hello from the layout!</h1>

<?php echo $content_for_layout; ?>
</body>
</html>