<?php
header('Content-Type: image/jpeg');
readfile($_GET['i']);
exit;