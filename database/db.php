<?php

$dbconn3 = pg_connect("host=localhost port=5432 dbname=carss user=mz password=1234") or die("Can't connect to database".pg_last_error());


// $mysqli = new mysqli("localhost", "car_shop_php_db", "car_shop_user_php", "123456789");
// printf("Test");