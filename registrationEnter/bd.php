<?php

$db = mysql_connect("localhost", "root", "565456a") or die(mysql_error());

mysql_select_db("Brovary") or die("Dont могу подключиться к базе.") or die(mysql_error());

