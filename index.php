<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<?php
//sample usage of the Nepali Language library for PHP
//by virtualanup (virtualanup.com)
include("neplang.php");

echo "The value of pi in nepali is ".NepLang::englishToNepali(M_PI).
    " and in english is ".NepLang::nepaliToEnglish(NepLang::englishToNepali(M_PI))."<br/>";

echo NepLang::numberToWord(434373487.043344000)."<br/>";

echo NepLang::numberToWord(NepLang::englishToNepali(434373487.043344000),true)."<br/>";

for($i = 0;$i <= 1000; $i++)
{
    echo $i." - ".NepLang::englishToNepali($i)." - ".NepLang::numberToWord($i)."<br/>";
}
?>
</body>
</html>