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
    $ar[] = $article;//массив артиклей
    $lot[] = $items['количество заказано'];//массив количества заказанных товаров
    $cost[] = $items['цена'];//массив цен на товары
    $diskont[] = $items['diskont'];//массив дисконта на товар
    $count[] = $items['осталось на складе'];//массив остатка на складе
}

 //массив  количества положенных в корзину товаров в зависимости от наличия на складе

for ($i = 0; $i < count($count); $i++) {
    $lots[] = ($lot[$i] < $count[$i]) ? $lot[$i] : $count[$i];
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
$art3 =$ar[2];//'игрушка детская "Велосипед":'
$disbike =diskontThirty($lots[2], $cost[2]);//скидка 30% для велосипеда
function discontBike($ar){
    global $disbike;
    global $art3; 
    if($ar==$art3 ){
        return 'Если количество велосипедов равно или больше 3 шт. , вы получаете '
. 'дополнительно скидку на каждый велосипед 30%<br>' . 'Ваша скидка составила: ' . $disbike . 'руб.<br>';

} else {
    return ''; 
}
}

//Функция расчёта  скидки в зависимости от параметра 'discont'
function diskont($cost,$diskont) {
    if ($diskont == 1) {
        return '10% скидка: '.(10 / 100 * $cost).'руб.';
    } elseif ($diskont == 2) {
        return  '20% скидка: '.(20 / 100 * $cost).'руб.';
    } else {
       return 0; 
    }
}
//массив скидок
for($i=0;$i< count($cost);$i++){
 $diskon[] = diskont($cost[$i],$diskont[$i]);
}
//Функция расчёта цены со скидкой
function diskontCost($cost,$diskont) {
    if ($diskont == 1) {
        return $cost - (10 / 100 * $cost);
    } elseif ($diskont == 2) {
        return $cost - (20 / 100 * $cost);
    }
}

//Функция, выводящая уведомление о недостаточном количестве товара
function notification($lot, $count) {
    return $razn = ($lot > $count) ? 'Приносим свои извинения,на складе недостаточно товара , возможно отгрузить только<br>' . $count . ' шт.<br>' : '';
}

//вывод цены в зависимости от скидки

for ($i = 0; $i < count($diskont); $i++) {
    switch ($diskont[$i]) {
        case 2:
            $cost[$i] = diskontCost($cost[$i],$diskont[$i]);
            break;
        case 1:
             $cost[$i] = diskontCost($cost[$i],$diskont[$i]);
            break;

        default:
            
            break;
    }
}


$cost[2] = diskontLot($lots[2], $cost[2], diskontThirty($lots[2], $cost[2]));//ценв на велосипед с 30% скидкой

//суммы к оплате за позицию товара
for ($i = 0; $i < count($count); $i++) {
    if ($lot[$i] > $count[$i]) {
        $sum[] = $count[$i] * $cost[$i];
    } else {
        $sum[] = $lot[$i] * $cost[$i];
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

echo "<h3>Cводная таблица корзины покупателя</h3>";
$n=1; 
echo '<table style="border:1px solid;">
      <tr style="border:1px solid;">
        <td style="width:60px;" align="center">№ п/п</td>
        <td style="width:90px;" align="center">Наименование товара</td>
        <td style="width:100px;" align="center"> Количество единиц заказано </td>
        <td style="width:100px;" align="center"> Остаток на складе </td>
        <td style="width:80px;" align="center"> Цена </td>
        <td style="width:140px;" align="center"> Нотификация </td>
        <td style="width:170px;" align="center"> Скидка </td>
        <td style="width:100px;" align="center"> Дополнительная скидка </td>
        <td style="width:150px;" align="center"> Сумма </td>
      </tr>';
for ($i = 0; $i < count($ar); $i++) {
  echo '<tr style="border:1px solid;">
        <td style="width:60px;border:1px solid;" align="center">'.$n++.'</td>
        <td style="width:90px;border:1px solid;" align="center">'.$ar[$i].'</td>
        <td style="width:100px;border:1px solid; padding-left:45px;">'.$lot[$i].' шт.</td>
        <td style="width:100px;border:1px solid;" align="center"> '.$count[$i].' шт. </td>
        <td style="width:80px;border:1px solid; " align="center" >'. $cost[$i] .' руб.</td>
        <td style="width:140px;border:1px solid;" align="center">'. notification($lot[$i], $count[$i]).'</td>
        <td style="width:170px;border:1px solid;" align="center">'. $diskon[$i] .'</td>
        <td style="width:100px;border:1px solid;" align="center">'.discontBike($ar[$i]).'</td>
        <td style="width:150px;border:1px solid;" align="center">'.$sum[$i].'руб.</td>
        </tr>';

 }
 echo  ' <tr>
        <td style="width:60px;" align="center"><h3>'.''.'</h3></td>
        <td style="width:90px;" align="center">'.''.'</td>
        <td style="width:100px;" align="center"><h4>Наименованиий товаров заказано</h4></td>
        <td style="width:100px;" align="center">'.''.'</td>
        <td style="width:80px;" align="center">'.''.'</td>
        <td style="width:140px;" align="center"><h4>Общее количество единиц товара</h4> </td>
        <td style="width:170px;" align="center">'.''.'</td>
        <td style="width:100px;" align="center">'.''.'</td>
        <td style="width:150px;" align="center"><h4>Общая сумма заказа </h4></td></tr>';
 echo  ' <tr>
        <td style="width:60px;" align="center"><h3>Итого:</h3></td>
        <td style="width:90px;" align="center">'.''.'</td>
        <td style="width:100px;" align="center"><h4>' . count($sumAr) . '</h4></td>
        <td style="width:100px;" align="center">'.''.'</td>
        <td style="width:80px;" align="center">'.''.'</td>
        <td style="width:140px;" align="center"><h4>' . array_sum($lots) . ' шт.</h4> </td>
        <td style="width:170px;" align="center">'.''.'</td>
        <td style="width:100px;" align="center">'.''.'</td>
        <td style="width:150px;" align="center"><h4>' . array_sum($sum) . 'руб.</h4></td></tr></table>';
?>
