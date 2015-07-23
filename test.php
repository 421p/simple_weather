<?php

$name = $_GET['name'];
$age = $_GET['age'];
$secure = $_GET['sex'];

if(isset($_GET['name']) == TRUE &&
isset($_GET['name']) == TRUE)
{
    echo "Your name is $name, you are $age years old.";
    if($_GET['sex'] == 'gay')
    {
        echo " Ti pidor.";
    }
}
else{
    echo "gde infa?";
}