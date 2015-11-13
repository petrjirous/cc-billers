<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Payon form</title>
</head>
<body>
<form action="http://czechcash-biller-tests.local/payon_new.phpt" class="paymentWidgets">VISA MASTER AMEX</form>
<script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId=<?php echo $_GET['id']; ?>"></script>
</body>
</html>