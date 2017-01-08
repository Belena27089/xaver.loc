<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


$ini_string = '
[игрушка мягкая "Мишка белый":]
цена = ' . mt_rand(1, 10) . '
количество заказано = ' . mt_rand(1, 10) . '
осталось на складе = ' . mt_rand(0, 10) . '
diskont = ' . mt_rand(0, 2) . '
        
[одежда детская "Куртка синяя (синтепон)":]
цена = ' . mt_rand(1, 10) . '
количество заказано = ' . mt_rand(1, 10) . '
осталось на складе = ' . mt_rand(0, 10) . '
осталось на складе = ' . mt_rand(0, 10) . '
diskont = ' . mt_rand(0, 2) . '
    
[игрушка детская "Велосипед":]
цена = ' . mt_rand(1, 10) . '
количество заказано = ' . mt_rand(1, 10) . '
осталось на складе = ' . mt_rand(0, 10) . '
diskont = ' . mt_rand(0, 2);

$bd = parse_ini_string($ini_string, true);


foreach ($bd as $article => $items) {
    echo "<h3>$article</h3>";
    echo "<ul>";
    foreach ($items as $key => $value) {
        echo "<li> $key =>$value</li>";
    }
    echo "</ul>";
}

$ar = array(); //массив артиклей
foreach ($bd as $article => $items) {

    $ar[] = $article;
}

$lot = array();
foreach ($bd as $article => $items) {
    $lot[] = $items['количество заказано'];
}

$cost = array();
foreach ($bd as $article => $items) {
    $cost[] = $items['цена'];
}

$diskont = array();
foreach ($bd as $article => $items) {
    $diskont[] = $items['diskont'];
}

$count = array();
foreach ($bd as $article => $items) {
    $count[] = $items['осталось на складе'];
}


$lots = array(); //Общее количество положенных в корзину товаров в зависимости от наличия на складе

for ($i = 0; $i < count($count); $i++) {
    $lots[] = ($lot[$i] < $count[$i]) ? $lot[$i] : $count[$i];
}


//Расчёт дополнительной 30% скидки на велосипеды при покупке от 3 шт
If ($lot[2] >= 3) {
    $diskontBike = 30 / 100 * $cost[2];
    $cost[2] = $cost[2] - $diskontBike . '<br>';
} else {
    $diskontBike = 0;
    $cost[2];
}

//Функция расчёта 10% скидки 

function diskonter1($cost) {

    return $cost - (10 / 100 * $cost);
}

//Функция расчёта 20% скидки
function diskonter2($cost) {

    return $cost - (20 / 100 * $cost);
}

//Функция, выводящая уведомление о недостаточном количестве товара
function notification($lot, $count) {
    return $razn = ($lot > $count) ? 'Приносим свои извинения,на складе недостаточно товара , возможно отгрузить только' . $count . ' шт.<br>' : '';
}

echo '<h1>КОРЗИНА ПОКУПАТЕЛЯ</h1>';
echo '<h3>Скидки</h3>';


//вывод скидки
for ($i = 0; $i < count($diskont); $i++) {
    switch ($diskont[$i]) {
        case 2:
            echo 'Ваша цена на ' . $ar[$i] . ' с 20% скидкой составила:' . $cost[$i] = diskonter2($cost[$i]) . ' руб.<br>';
            break;
        case 1:
            echo 'Ваша цена на ' . $ar[$i] . ' с 10% скидкой составила:' . $cost[$i] = diskonter1($cost[$i]) . ' руб.<br>';
            break;

        default:
            echo 'Скидки на ' . $ar[$i] . ' нет<br>';
            break;
    }
}


echo 'Если количество велосипедов равно или больше 3 шт. , вы получаете '
 . 'дополнительно скидку на каждый велосипед 30%<br>'
 . 'Ваша скидка составила: ' . $diskontBike . 'руб.<br>';
echo '<h3>В корзину добавлено:</h3>';


$sum = array(); //суммы к оплате за позицию товара
for ($i = 0; $i < count($count); $i++) {
    if ($lot[$i] > $count[$i]) {
        $sum[] = $count[$i] * $cost[$i];
    } else {
        $sum[] = $lot[$i] * $cost[$i];
    }
}

for ($i = 0; $i < count($ar); $i++) {
    echo $ar[$i] . $lot[$i] . ' шт. '
    . ' по цене ' . $cost[$i] . 'p/шт.<br> '
    . 'Остаток на складе: ' . $count[$i] . ' шт.<br>' . notification($lot[$i], $count[$i]) .
    'Сумма по позиции: ' . $sum[$i] . 'руб.<br><br>';
}

$sumAr = array(); //массив артиклей положенных в корзину
for ($i = 0; $i < count($ar); $i++) {
    if ($lots[$i] != 0) {
        $sumAr[] = $ar[$i];
    } else {
        $sumAr[] = 0;
        unset($sumAr[$i]);
    }
}
//print_r($sumAr);

echo '<h2>Итого:</h2>';
echo 'Наименований товаров заказано: ' . count($sumAr) . ';<br>'
 . 'Количество единиц: ' . array_sum($lots) . ' шт.<br>'
 . 'Общая сумма заказа: ' . array_sum($sum) . 'руб.<br>';
?>



