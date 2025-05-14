<?php 
session_start();
unset($_SESSION["username"]);
?>
<script>
	window.location="index.php";
</script>