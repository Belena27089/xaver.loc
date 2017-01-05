<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


$ini_string = '
[игрушка мягкая мишка белый]
цена = ' . mt_rand(1, 10) . '
количество заказано = ' . mt_rand(1, 10) . '
осталось на складе = ' . mt_rand(0, 10) . '
diskont = diskont' . mt_rand(0, 2) . '
        
[одежда детская куртка синяя синтепон]
цена = ' . mt_rand(1, 10) . '
количество заказано = ' . mt_rand(1, 10) . '
осталось на складе = ' . mt_rand(0, 10) . '
осталось на складе = ' . mt_rand(0, 10) . '
diskont = diskont' . mt_rand(0, 2) . '
    
[игрушка детская велосипед]
цена = ' . mt_rand(1, 10) . '
количество заказано = ' . mt_rand(1, 10) . '
осталось на складе = ' . mt_rand(0, 10) . '
diskont = diskont' . mt_rand(0, 2);

$bd = parse_ini_string($ini_string, true);
print_r($bd);

$lot1 = $bd['игрушка мягкая мишка белый']['количество заказано'];
$lot2 = $bd['одежда детская куртка синяя синтепон']['количество заказано'];
$lot3 = $bd['игрушка детская велосипед']['количество заказано'];
$cost1 = $bd['игрушка мягкая мишка белый']['цена'];
$cost2 = $bd['одежда детская куртка синяя синтепон']['цена'];
$cost3 = $bd['игрушка детская велосипед']['цена'];
$diskont1 = $bd['игрушка мягкая мишка белый']['diskont'];
$diskont2 = $bd['одежда детская куртка синяя синтепон']['diskont'];
$diskont3 = $bd['игрушка детская велосипед']['diskont'];
$count1 = $bd['игрушка мягкая мишка белый']['осталось на складе'];
$count2 = $bd['одежда детская куртка синяя синтепон']['осталось на складе'];
$count3 = $bd['игрушка детская велосипед']['осталось на складе'];

//Функция вывода количества положенного в корзину товара в зависимости от наличия на складе
function sLots($lot, $count) {
    return $lots = ($lot > $count) ? $count : $lot;
}

;
$sLots1 = sLots($lot1, $count1) . '<br>';
$sLots2 = sLots($lot2, $count2) . '<br>';
$sLots3 = sLots($lot3, $count3) . '<br>';
$sumLot = $sLots1 + $sLots2 + $sLots3; //Общее количество положенных в корзину товаров
//Расчёт дополнительной 30% скидки на велосипеды при покупке от 3 шт
If ($lot3 >= 3) {
    $diskontBike = 30 / 100 * $cost3;
    $cost3 = $cost3 - $diskontBike . '<br>';
} else {
    $diskontBike = 0;
    $cost3;
};

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
switch ($diskont1) {
    case 'diskont2' :
        echo 'Ваша цена на мишку с 20% скидкой составила:' . $cost1 = diskonter2($cost1) . ' руб.<br>';
        break;
    case 'diskont1' :
        echo 'Ваша цена на мишку с 10% скидкой составила:' . $cost1 = diskonter1($cost1) . ' руб.<br>';
        break;

    default:
        echo 'Скидки на мишку нет<br>';
        break;
}
switch ($diskont2) {
    case 'diskont2' :
        echo 'Ваша цена на куртку с 20% скидкой составила:' . $cost2 = diskonter2($cost2) . ' руб.<br>';
        break;
    case 'diskont1' :
        echo 'Ваша цена на куртку с 10% скидкой составила:' . $cost2 = diskonter1($cost2) . ' руб.<br>';
        break;

    default:
        echo 'Скидки на куртку нет<br>';
        break;
}
switch ($diskont3) {
    case 'diskont2' :
        echo 'Ваша цена на велосипед с 20% скидкой составила:' . $cost3 = diskonter2($cost3) . ' руб.<br>';
        break;
    case 'diskont1' :
        echo 'Ваша цена на велосипед с 10% скидкой составила:' . $cost3 = diskonter1($cost3) . ' руб.<br>';
        break;

    default:
        echo 'Скидки на велосипед нет<br>';
        break;
}
echo 'Если количество велосипедов равно или больше 3 шт. , вы получаете '
 . 'дополнительно скидку на каждый велосипед 30%<br>'
 . 'Ваша скидка составила: ' . $diskontBike . 'руб.<br>';
echo '<h3>В корзину добавлено:</h3>';

//Функция расчёта суммы к оплате за позицию товара
function sum($lot, $cost, $count) {
    if ($lot > $count) {
        return $count * $cost;
        
    } else {
        return $lot * $cost;
    }
}

$sum1 = sum($lot1, $cost1, $count1);
$sum2 = sum($lot2, $cost2, $count2);
$sum3 = sum($lot3, $cost3, $count3);
$total = $sum1 + $sum2 + $sum3; //Итоговая сумма к оплате за весь товар в корзине

echo 'Игрушка мягкая: "Мишка белый" ' . $lot1 . ' шт. '
 . ' по цене ' . $cost1 . 'p/шт.<br> '
 . 'Остаток на складе: ' . $count1 . ' шт.<br>' . notification($lot1, $count1) .
 'Сумма по позиции: ' . $sum1 . 'руб.<br>';
echo 'Oдежда детская: "Куртка синяя (синтепон)" ' . $lot2 . ' шт. '
 . ' по цене ' . $cost2 . 'p/шт.<br>'
 . ' Остаток на складе: ' . $count2 . ' шт.<br>' . notification($lot2, $count2) .
 'Сумма по позиции: ' . $sum2 . 'руб.<br>';
echo 'Игрушка детская: "Bелосипед" ' . $lot3 . ' шт. '
 . ' по цене ' . $cost3 . 'p/шт.<br>'
 . ' Остаток на складе: ' . $count3 . ' шт.<br>' . notification($lot3, $count3) .
 'Сумма по позиции: ' . $sum3 . 'руб.<br>';

echo '<h2>Итого:</h2>';
echo 'Наименований товаров заказано: ' . count($bd) . ';<br>'
 . 'Количество единиц: ' . $sumLot . ' шт.<br>'
 . 'Общая сумма заказа: ' . $total . 'руб.<br>';
?>
