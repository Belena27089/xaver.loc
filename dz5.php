<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);


$new = 'Четыре новосибирские компании вошли в сотню лучших работодателей
Выставка университетов США: открой новые горизонты
Оценку «неудовлетворительно» по качеству получает каждая 5-я квартира в новостройке
Студент-изобретатель раскрыл запутанное преступление
Хоккей: «Сибирь» выстояла против «Ак Барса» в пятом матче плей-офф
Здоровое питание: вегетарианская кулинария
День святого Патрика: угощения, пивной теннис и уличные гуляния с огнем
«Красный факел» пустит публику на ночные экскурсии за кулисы и по закоулкам столетнего здания
Звезды телешоу «Голос» Наргиз Закирова и Гела Гуралиа споют в «Маяковском»';



// Функция вывода всего списка новостей.
// Функция вывода конкретной новости.
// Точка входа.
// Если новость присутствует - вывести ее на сайте, иначе мы выводим весь список
// Был ли передан id новости в качестве параметра?
// если параметр не был передан - выводить 404 ошибку
// http://php.net/manual/ru/function.header.php
// Функция вывода всего списка новостей.

$news = explode("\n", $new);

// Функция вывода всего списка новостей.
function show_list($news) {
    echo '<html>';
    echo '<head>';
    echo '<title>Последние новости</title>';
    echo '</head>';
    echo '<body>';
    echo '<ul>';

    for ($i = 0; $i < count($news); $i++) {
        echo '<li>';
        echo '<a href="/index.php?id=' . ($i + 1) . '">';
        echo $news[$i];
        echo '</a>';
        echo '</li>';
    }
    echo '</ul>';
    echo '</body>';
    echo '</html>';
}

// Функция вывода конкретной новости.
function show_item($news, $id) {
    echo '<html>';
    echo '<head>';
    echo "<title>Новость #$id</title>";
    echo '</head>';
    echo '<body>';
    echo '<a href="index.php">Вернуться к списку новостей</a><br>';
    echo '<b>';
    echo $news[$id - 1].'<br>';
    echo '</b>';
    echo '</body>';
    echo '</html>';
}

print_r($_GET);
// Точка входа.

// Был ли передан id новости в качестве параметра?
if ($_GET['id'] > count($news)) {
    header("HTTP/1.0 404 Not Found");
    echo '<h1 style="color:red;">Страница не найдена 404</h1><br>';
}
if (isset($_GET['id'])) {
    show_item($news, $_GET['id']);
}


echo '</head>
<body>
<div>';
if ($_POST['id'] > count($news)) {
    header("HTTP/1.0 404 Not Found");
    echo '<h1 style="color:red;">Страница не найдена 404</h1><br>';
}
if (isset($_POST['id'])) {

    $id = $_POST['id'];
    show_item($news, $_POST['id']);
    echo "Ваш Id: $id <br> ";
} else {

    show_list($news);
}

echo '</div>
<h3>Найти новость</h3>
<form method="POST">
    Введите ID: <input type="text" name="id" /><br><br>
    <br>
    <input type="submit" value="Отправить">
</form>
</body>
</html>';

print_r($_POST);
?>
