<!DOCTYPE html>
<html lang="en">
<link href="index.css" rel="stylesheet">
<head>
    <meta charset="UTF-8">
    <title>4 лаба 14 вариант</title>
</head>
<body>

<?php

if(isset($_GET['filepath'])) $filepath = $_GET['filepath']; //объявляем переменную и присваиваем переданное GET-запросом значение
else $filepath = 'test.txt'; //объявляем переменную и присваиваем стандартное значение
if(isset($_GET['text'])) $text = $_GET['text']; //объявляем переменную и присваиваем переданное GET-запросом значение
else $text = '
    some@email.com
    not_email@test another@junk @@ bsuir@mail.ru
    @var notvar@@
    some random text
    '; //объявляем переменную и присваиваем стандартное значение

if(!((!(file_exists($filepath)) && is_writable($filepath)) || (file_exists($filepath) && is_writable($filepath))))//если файл не существует, но можно записать ИЛИ если файл существует, и можно записать
{
    echo '<div align="center">
    <form action="laba4_var14.php" method="get">
        Текст: <textarea name="text" cols="40" rows="5">some@email.com
                                                        not_email@test another@junk @@ bsuir@mail.ru
                                                        @var notvar@@
                                                        some random text</textarea>
        Путь к файлу: <input type="text" name="filepath" class="error_red" value="test.txt"><br><br>
        <input type="submit" name="submit" value="Отправить">
    </form>
</div>';
    echo '<div align=\"center\">";
    <h2>Файла не существует и(или) он защищен от записи. Попробуйте еще раз</h2>";
</div>';
    return;
}
                                                                                                                    //если файл существует
    echo '<div align="center">
    <form action="laba4_var14.php" method="get">
        Текст: <textarea name="text" cols="40" rows="5">some@email.com
                                                        not_email@test another@junk @@ bsuir@mail.ru
                                                        @var notvar@@
                                                        some random text</textarea>
        Путь к файлу: <input type="text" name="filepath" value="test.txt"><br><br>
        <input type="submit" name="submit" value="Отправить">
    </form>
</div>';

$emails = array();
$emails = parsing($text);

file_put_contents($filepath, null);

foreach ($emails as $email) file_put_contents($filepath, $email . PHP_EOL, FILE_APPEND);

echo '<br><div align="center">';
echo '<h2>Отфильтрованные email-ы:</h2>';
echo '<table border="1" align=\"center\">';
foreach ($emails as $email)
{
    echo '<tr><td>' . '<a href="mailto:' . $email . '">' . $email . '</a></td></tr>';
}
echo '</table></div>';



function parsing($text)
{
    $pattern = '~[a-z0-9_]+(\.[a-z0-9_-]+)*@([0-9a-z][0-9a-z]*\.)+([a-z]){2,4}~'; //'~[a-zA-Z][a-zA-Z0-9_-\.]+@([a-zA-Z0-9_-]\.)+[a-zA-Z]{2,5}~';
    $output = array();

    preg_match_all($pattern, trim($text), $matches);

    foreach ($matches[0] as $key => $val)
    {
        $email = filter_var($val, FILTER_VALIDATE_EMAIL);
        if ($email) $output[] = $email;
    }

    return $output;
}

?>

</body>
</html>
