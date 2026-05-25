<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	$this->load->view('admin/theme/meta.php');
	$this->load->view('admin/theme/header.php');
	?>

	<title>
		<?php if ($title) {
			echo 'LPRU | ' . $title;
		} else {
			echo 'LPRU';
		}	?>
	</title>

</head>

<body>
	<?php $this->load->view('admin/theme/menu.php'); ?>

	<div id="main">
		<?php $this->load->view('admin/theme/navbar.php'); ?>
		<?php
		if ($content) {
			$this->load->view('admin/' . $content);
		}
		?>
	</div>
</body>

<?php
$this->load->view('admin/theme/footer.php');
$this->load->view('admin/theme/sweetalert.php')
?>

<?php
if (!empty($script)) {
	$this->load->view('admin/script/' . $script);
}
?>

</html>