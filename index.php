<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<?php
//sample usage of the Nepali Language library for PHP
//by virtualanup (virtualanup.com)
include("neplang.php");

echo NepLang::numberToWord(4384343734837.043344000);
for($i = 0;$i <= 1000; $i++)
{
    echo $i." - ".NepLang::englishToNepali($i)." - ".NepLang::numberToWord($i)."<br/>";
}
?>
</body>
</html>