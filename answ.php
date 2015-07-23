<?php

$ch = curl_init("data/pogoda");
curl_exec($ch); curl_close($ch);

$xml = simplexml_load_file("data/text.xml");

echo $xml->today->wind;

