
<?php

error_reporting(E_ALL|E_ERROR|E_COMPILE_WARNING|E_PARSE|E_USER_NOTICE);
ini_set('display_errors', 1);

$name = 'Елена';
$age = 45;

echo 'Меня зовут ' . $name . ' .<br>';
echo 'Мне ' .$age . ' лет.';

//удаление переменных
unset($name ,$age );

echo 'Меня зовут ' . $name . ' .<br>';
echo 'Мне ' .$age . ' лет.<br>';

//создание константы
define('CITY', 'Новосибирск');

//проверка наличия константы
//print_r(get_defined_constants());
if (defined('CITY')) {
    echo 'константа существует'. '<br>';
}
 else {
    echo 'константы не существует'. '<br>';
}
echo 'Город: ' . CITY. '<br>';

//изменение значения константы
define('CITY', 'Москва');
echo 'Город: ' . CITY. '<br>';

//создание ассоциативного массива

$book=array('title'=>'"Наследники богов"','author'=>'Рик Риордан','pages'=>'300');

echo 'Недавно я прочитала книгу  '. $book['title'] . ',написанную автором  '.$book['author'] .', я осилила '.$book['pages'].' страниц, мне она очень понравилась.<br>';

//создание индексного массива с вложенными ассоциативными массивами


$books = array(
    $book1=['title'=>'"Наследники богов"','author'=>'Рик Риордан','pages'=>'300'],
    $book2=['title'=>'"Два капитана"','author'=>'Вениамин Каверин','pages'=>'200']
    );
    
echo 'Недавно я прочитала книги  '. $books[0]['title'].' и '.$books[1]['title']. ', написанную автороми  '.$books[0]['author'].' и '.$books[1]['author'].', я осилила в сумме '.($books[0]['pages']+$books[1]['pages']).' страниц, не ожидала от себя такого.';

    
?>


