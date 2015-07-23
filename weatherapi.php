<?php

$city = $_GET['city'];
$obj = simplexml_load_file("http://api.openweathermap.org/data/2.5/weather?q=$city&mode=xml");

echo $obj->temperature['value'] - 273;