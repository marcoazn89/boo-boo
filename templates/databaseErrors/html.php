<?php
use HTTP\response\Status;
$status = Status::getInstance();
?>

<html>
	<head>
		<title>BooBoo - <?php echo $status->code; ?></title>
<link href='https://www.dropbox.com/static/css/error.css' rel='stylesheet' type='text/css'>
<link rel='shortcut icon' href='booboo.png'>
</head>
<body>
<div class='figure'>
<img src='booboo.png' width='300' alt=<?php echo "'Error ".$status->code."'"; ?>>
</div>
<div id='errorbox'>
<h1>Error (<?php echo $status->code; ?>)</h1>
<p>Oh no it's a <a href="http://github.com/marcoazn89/BooBoo">BooBoo!</a> Something went terribly wrong and we are sorry. Please try again later.</p>
<p>Thanks,</p>
<p>A good looking production BooBoo</p>
</div>
</body>
</html>
