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
    $ar[] = $article; //массив артиклей
    $lot[] = $items['количество заказано'] . ' шт.'; //массив количества заказанных товаров
    $cost[] = $items['цена'] . ' руб.'; //массив цен на товары
    $diskont[] = $items['diskont']; //массив дисконта на товар
    $count[] = $items['осталось на складе'] . ' шт.'; //массив остатка на складе
}


for ($i = 0; $i < count($ar); $i++) {
    $diskon[] = diskont($cost[$i], $diskont[$i]); //массив скидок
    $notification[] = notification($lot[$i], $count[$i]); //массив нотификаций    
    $lots[] = ($lot[$i] < $count[$i]) ? $lot[$i] : $count[$i]; //массив  количества положенных в корзину товаров в зависимости от наличия на складе
}


//расчёт дополнительной 30% скидки на велосипеды при покупке от 3 шт

$think = 3; //количество шт. товара задающее скидку
//функция рвсчёта 30% скидки в зависимостищ от количества товара

function diskontThirty($lots, $cost) {
    global $think;
    If ($lots >= $think) {
        return $diskontThirty = 30 / 100 * $cost;
    } else {
        return $diskontThirty = 0;
    }
}

//функция расчёта цены с 30% скидкой в зависимостищ от количества товара 
function diskontLot($lots, $cost, $diskontThirty) {
    global $think;
    If ($lots >= $think) {
        return $cost = $cost - $diskontThirty . '<br>';
    } else {

        return $cost;
    }
}

//функция расчёта дополнительной скидки 30% для велосипеда
$art3 = $ar[2]; //'игрушка детская "Велосипед":'
$disbike = diskontThirty($lots[2], $cost[2]); //скидка 30% для велосипеда

function discontBike($ar) {
    global $disbike;
    global $art3;
    if ($ar == $art3) {
        return 'Если количество велосипедов равно или больше 3 шт. , вы получаете '
                . 'дополнительно скидку на каждый велосипед 30%<br>' . 'Ваша скидка составила: ' . $disbike . 'руб.<br>';
    } else {
        return '';
    }
}

for ($i = 0; $i < count($ar); $i++) {
    $discontBike[] = discontBike($ar[$i]); //массив дополнительных скидок  
}

//Функция расчёта  скидки в зависимости от параметра 'discont'
function diskont($cost, $diskont) {
    if ($diskont == 1) {
        return '10% скидка: ' . (10 / 100 * $cost) . 'руб.';
    } elseif ($diskont == 2) {
        return '20% скидка: ' . (20 / 100 * $cost) . 'руб.';
    } else {
        return 0;
    }
}

//Функция расчёта цены со скидкой
function diskontCost($cost, $diskont) {
    if ($diskont == 1) {
        return $cost - (10 / 100 * $cost) . ' руб.';
    } elseif ($diskont == 2) {
        return $cost - (20 / 100 * $cost) . ' руб.';
    }
}

//Функция, выводящая уведомление о недостаточном количестве товара
function notification($lot, $count) {
    return ($lot > $count) ? 'Приносим свои извинения,на складе недостаточно товара , возможно отгрузить только<br>' . $count . ' шт.<br>' : '';
}

//вывод цены в зависимости от скидки

for ($i = 0; $i < count($diskont); $i++) {
    switch ($diskont[$i]) {
        case 2:
            $cost[$i] = diskontCost($cost[$i], $diskont[$i]);
            break;
        case 1:
            $cost[$i] = diskontCost($cost[$i], $diskont[$i]);
            break;

        default:

            break;
    }
}


$cost[2] = diskontLot($lots[2], $cost[2], diskontThirty($lots[2], $cost[2])); //ценв на велосипед с 30% скидкой
//суммы к оплате за позицию товара
for ($i = 0; $i < count($count); $i++) {
    if ($lot[$i] > $count[$i]) {
        $sum[] = $count[$i] * $cost[$i] . ' руб.';
    } else {
        $sum[] = $lot[$i] * $cost[$i] . ' руб.';
    }
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


//////////////////////////////////////////////////////////////////


echo '<h1>КОРЗИНА ПОКУПАТЕЛЯ</h1>';

echo '<table style="border:1px solid;">
        <tbody><h3>Cводная таблица корзины покупателя</h3>
      <tr>';
$bn = array('Наименование товара', 'Количество единиц заказано', 'Остаток на складе', 'Цена', 'Нотификация', 'Скидка', 'Дополнительная скидка', 'Сумма');
for ($i = 0; $i < count($bn); $i++) {
    echo ' <td style="width:100px;" align="center"> ' . $bn [$i] . ' </td>';
}
echo '</tr>';
$ba = array($ar, $lot, $count, $cost, $notification, $diskon, $discontBike, $sum);
for ($i = 0; $i < count($ar); $i++) {
    echo '<tr>';
    for ($j = 0; $j < count($ba); $j++) {
        echo '<td style="width:100px;border:1px solid;" align="center"> ' . $ba[$j][$i] . ' </td>';
    }

    echo '</tr>';
}
echo '<tr>';
$bc = array('', '<h4>Наименованиий товаров заказано</h4>', '', '', '<h4>Общее количество единиц товара</h4>', '', '', '<h4>Общая сумма заказа </h4>');
for ($i = 0; $i < count($bc); $i++) {
    echo ' <td style="width:100px;" align="center"> ' . $bc [$i] . ' </td>';
}

echo ' <tr>';
$bi = array('<h3>Итого:</h3>', '<h4>' . count($sumAr) . '</h4>', '', '', '<h4>' . array_sum($lots) . ' шт.</h4>', '', '', '<h4>' . array_sum($sum) . 'руб.</h4>');
for ($i = 0; $i < count($bi); $i++) {
    echo ' <td style="width:140px;" align="center"> ' . $bi [$i] . ' </td>';
}

echo'</tr><tbody></table>';
?>
