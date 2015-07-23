<?php
$cityname = $_GET['city'];

$url="https://pogoda.mail.ru/prognoz/$cityname";
$charset="<weather>" . PHP_EOL;
file_put_contents("text.xml", "<?xml version=\"1.0\" encoding=\"UTF-8\"?>". "<weather>" . PHP_EOL);
$page = file_get_contents($url);
$arr = array();
//$pattern = '#(<div class="day__[^>]+>[^<]+</div>)#i';
//$pattern = '#<(div|span) class="day__[^"]+"[^<]+<\/(span|div)>#i';

$patternToday = '#class="[^"]+"[^<`\'"]+</span>([^<`\r\n]+)#';

$pattern = '#class="day__[^>]+>([^<]+)<\/#i';
preg_match_all($pattern,$page, $arr);

$arrToday = array(); 

preg_match_all($patternToday, $page, $arrToday);
foreach($arrToday[1] as $temp)
{
        $intovayaShtuka++;
        switch($intovayaShtuka%3)
        {
            case 1: $temp = str_replace("&deg;", "", $temp);
                $temp = "<wind>$temp</wind>"; break;
            case 2: $temp = "<pressure>$temp</pressure>"; break;
            case 0: $temp = "<humidity>$temp</humidity>";break;
        }
        if($temp != 'div'||$temp != 'span')
        {
            $tepstrToday = $tepstrToday . $temp  . PHP_EOL;
        }
}



foreach($arr[1] as $temp)
{
        $intovayaShtuka++;
        switch($intovayaShtuka%3)
        {
            case 1: $temp = str_replace("&deg;", "", $temp);
                $temp = "<temperature>$temp</temperature>"; break;
            case 2: $temp = "<osadki>$temp</osadki>"; break;
            case 0: $temp = "<day>$temp</day>";break;
        }
        if($temp != 'div'||$temp != 'span')
        {
            $tepstr = $tepstr . $temp .  PHP_EOL;
        }
}
echo $tepstrToday;
echo $tepstr;

file_put_contents("text.xml", "<today>", FILE_APPEND);
file_put_contents("text.xml", $tepstrToday, FILE_APPEND);
file_put_contents("text.xml", "</today>", FILE_APPEND);
file_put_contents("text.xml", $tepstr, FILE_APPEND);

file_put_contents("text.xml", "</weather>", FILE_APPEND);
?>