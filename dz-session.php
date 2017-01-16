<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);


session_start();
echo "Имя сессии: " . session_name() . " Идентификатор сессии: " . session_id();

if (isset($_POST['go'])) {
    $_SESSION['nick'][] = $_POST;
 //берем с POST массива значение отправленное с формы, присваиваем 
    //redirect на эту же страницу, преодолеваем проблему повторной отправки формы POST
    header("Location: index.php");
}

$citys = array('641780' => 'Новосибирск', '641490' => 'Барабинск', '641510' => 'Бердск', '641600' => 'Искитим', '641630' => 'Колывань', '641680' => 'Краснообск', '641710' => 'Куйбышев',
    '641760' => 'Мошково', '641790' => 'Обь', '641800' => 'Ордынское', '641970' => 'Черепаново');
$metros = array('2028' => 'Берёзовая роща', '2018' => 'Гагаринская', '2017' => 'Заельцовская', '2029' => 'Золотая Нива', '2019' => 'Красный проспект', '2027' => 'Маршала Покрышкина', '2021' => 'Октябрьская',
    '2025' => 'Площадь Гарина-Михайловского', '2020' => 'Площадь Ленина', '2024' => 'Площадь Маркса', '2022' => 'Речной вокзал', '2026' => 'Сибирская', '2023' => 'Студенческая');
$roads = array('56' => 'Бердское шоссе', '57' => 'Гусинобродское шоссе', '53' => 'Дачное шоссе', '55' => 'Краснояровское шоссе', '54' => 'Мочищенское шоссе', '52' => 'Ордынское шоссе', '58' => 'Советское шоссе');
$categories = array('Транспорт' => array('9' => 'Автомобили с пробегом', '109' => 'Новые автомобили', '14' => 'Мотоциклы и мототехника', '81' => 'Грузовики и спецтехника', '11' => 'Водный транспорт', '10' => 'Запчасти и аксессуары'), 'Недвижимость' => array('24' => 'Квартиры', '23' => 'Комнаты', '25' => 'Дома,дачи,коттеджи', '26' => 'Земельные участки', '85' => 'Гаражи и машиноместа', '42' => 'Коммерческая недвижимость', '86' => 'Недвижимость за рубежом'));

function show_form() {
    global $citys;
    global $metros;
    global $roads;
    global $categories;

    echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>    

<form action="index.php" method="post">

<div class="form-row-indented">
     <label class="form-label-radio">
        <input type="radio" checked="" value="1" name="private">Частное лицо
     </label>
    <label class="form-label-radio">
        <input type="radio" value="0" name="private">Компания</label>
</div><br>

<div class="form-row">
    <label for="fld_seller_name" class="form-label"><b id="your-name">Ваше Имя</b></label>
        <input type="text" maxlength="40" class="form-input-text" value="" name="seller_name" id="fld_seller_name">
</div><br>

<div class="form-row">
    <label for="fld_email" class="form-label">Электронная почта</label>
        <input type="text" class="form-input-text" value="" name="email" id="fld_email">
</div><br>
<div class="form-row-indented"> 
    <label class="form-label-checkbox" for="allow_mails"> 
        <input type="checkbox" value="1" name="allow_mails" id="allow_mails" class="form-input-checkbox">
            <span class="form-text-checkbox">Я не хочу получать вопосы по объявлению по e-mail</span> 
    </label>
</div><br>
<div class="form-row"> 
    <label id="fld_phone_label" for="fld_phone" class="form-label">Номер телефона</label> 
        <input type="text" class="form-input-text" value="" name="phone" id="fld_phone">
</div><br>';

    function show_city_block($city = '') {
        global $citys;
        $gorod = $citys[$_SESSION['nick'][$_GET['id']]['location_id']];


        echo '<select title="Выберите Ваш город" name="location_id" id="region" class="form-input-select"> 
                <option value="">-- Выберите город --</option>
                <option class="opt-group" disabled="disabled">-- Города --</option>';


        foreach ($citys as $number => $city) {
            $selected = ($number == $gorod) ? 'selected=""' : ''; //если мы передали в функцию город который нужно выставить в списке то мы ставим специальную метку в селектор
            echo '<option data-coords=",," ' . $selected . ' value="' . $number . '">' . $city . '</option>';
        }


        echo '<option id="select-region" value="0">Выбрать другой...</option>
        </select>';
    }

    echo '<div id="f_location_id" class="form-row form-row-required"> 
    <label for="region" class="form-label">Город</label>';


    show_city_block();

    function show_metro_block($metro = '') {
        global $metros;
        $station = $_SESSION['nick'][$_GET['id']]['metro_id'];
        echo'<select title="Выберите станцию метро" name="metro_id" id="fld_metro_id" class="form-input-select"> 
            <option value="">-- Выберите станцию метро --</option>';
        foreach ($metros as $number => $metro) {
            $selected = ($number == $station) ? 'selected=""' : ''; //если мы передали в функцию город который нужно выставить в списке то мы ставим специальную метку в селектор
            echo '<option ' . $selected . '  value="' . $number . '">' . $metro . '</option>';
        }
        echo '</select>';
    }

    echo '<div id="f_metro_id">';

    show_metro_block();

    echo '</div><br>     
    </div><br>';

    function show_road_block($road = '') {
        global $roads;
        $path = $_SESSION['nick'][$_GET['id']]['road_id'];
        echo' <select title="Выберите направление" name="road_id" id="fld_road_id" class="form-input-select" style="display: 
        block;"> 
            <option value="">-- Выберите направление --</option>';
        foreach ($roads as $number => $road) {
            $selected = ($number == $path) ? 'selected=""' : ''; //если мы передали в функцию город который нужно выставить в списке то мы ставим специальную метку в селектор
            echo '<option ' . $selected . ' value="' . $number . '">' . $road . '</option>';
        }
        echo '</select>';
    }

    echo '<div id="f_road_id">';

    show_road_block();
    echo '</div><br> 
</div><br>';

    function show_category_block($type = '') {
        global $categories;
        $category = $_SESSION['nick'][$_GET['id']]['category_id'];
        echo' <select title="Выберите категорию" name="category_id" id="fld_category_id" class="form-input-select"> 
        <option value="">-- Выберите категорию --</option>';
        foreach ($categories as $optgroup => $cat) {
            echo '<optgroup label="' . $optgroup . '">';
            foreach ($cat as $namber => $type) {
                $selected = ($number = $category) ? 'selected=""' : ''; //если мы передали в функцию город который нужно выставить в списке то мы ставим специальную метку в селектор
                echo '<option' . $selected . ' value="' . $namber . '">' . $type . '</option>';
            }
        }
        echo '</optgroup></select>';
    }

    echo '<div class="form-row"> 
    <label for="fld_category_id" class="form-label">Категория</label>';

    show_category_block();
    echo '</div><br>

   <!--  -->
<div id="f_title" class="form-row f_title"> 
    <label for="fld_title" class="form-label">Название объявления</label> 
        <input type="text" maxlength="50" class="form-input-text-long" value="" name="title" id="fld_title"> 
</div><br>
<div class="form-row"> 
    <label for="fld_description" class="form-label" id="js-description-label">Описание объявления</label> 
        <textarea maxlength="3000" name="description" id="fld_description" class="form-input-textarea"></textarea> 
</div><br>
<div id="price_rw" class="form-row rl"> 
    <label id="price_lbl" for="fld_price" class="form-label"></label>Цена
        <input type="text" maxlength="9" class="form-input-text-short" value="0" name="price" id="fld_price">&nbsp;<span id="fld_price_title">руб.</span> 
            <a class="link_plain grey right_price c-2 icon-link" id="js-price-link" href="/info/pravilnye_ceny?plain"><span>Правильно уакзывайте цену</span></a> 
</div><br>

<div id="f_images" class="form-row"> 
    <label for="fld_images" class="form-label"><span id="js-photo-label">Фотографии</span><span class="js-photo-count" style="display: none;"></span></label> <input type="file" value="image" id="fld_images" name="image" accept="image/*" class="form-input-file"> <span style="line-height:22px;color: gray; display: none;" id="fld_images_toomuch">Вы добавили максимально возможное количество фотографий</span> <span style="display: none;" id="fld_images_overhead"></span> 
</div><br> 
<div style="display: none; margin-top: 0px;" class="form-row-indented images" id="files">
    <div style="display: none;" id="progress"> <table><tbody><tr><td> <div><div></div></div> </td></tr></tbody></table> </div> </div>

<div class="form-row-indented form-row-submit b-vas-submit" id="js_additem_form_submit">
    <div class="vas-submit-button pull-left"> 
            <span class="vas-submit-border"></span> 
            <span class="vas-submit-triangle"></span> 
            <input type="submit" value="Далее" id="form_submit" name="go" class="vas-submit-input"> 
    </div><br>
</div>
</form>
</body>
</html>';
    $tb = array('Название', 'Цена', 'Имя', 'Удалить');
    echo '<table style="border:2px solid;border-collapse:collapse">';
    for ($i = 0; $i < count($tb); $i++) {
        echo '<td style="width:120px;border:1px solid">' . $tb[$i] . '</td>';
    }
    foreach ($_SESSION['nick'] as $key => $value) {

        foreach ($value as $k => $val) {
            
        }

        echo '<tr>'
        . '<td style="width:120px;border:1px solid"><a href="?action=show&id=' . $key . '">' . $value['title'] . '</a></td>'
        . '<td style="width:120px;border:1px solid">' . $value['price'] . '</td>'
        . '<td style="width:120px;border:1px solid">' . $value['seller_name'] . '</td>'
        . '<td style="width:120px;border:1px solid"><a href="?action=delete&id=' . $key . '">' . 'Удалить' . '</a></td>'
        . '</tr>';
    }
    echo '</table>';
}

show_form();

function show_advertisement($id) {
    echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>    

<form action="index.php" method="get">

<div class="form-row-indented">
     <label class="form-label-radio">';
    if ($_SESSION['nick'][$_GET['id']]['private'] == 1) {
        echo '<input type="radio" checked="" value="' . $_SESSION['nick'][$_GET['id']]['private'] . '" name="private">Частное лицо</label>
        <label class="form-label-radio">
        <input type="radio" value="0" name="private">Компания</label>';
    }
    if ($_SESSION['nick'][$_GET['id']]['private'] == 0) {
        echo '<label class="form-label-radio">
        <input type="radio" value="1" name="private">Частное лицо</label>
        <input type="radio" checked="" value="' . $_SESSION['nick'][$_GET['id']]['private'] . '" name="private">Компания</label>';
    }

    echo '</div><br>


<div class="form-row">
    <label for="fld_seller_name" class="form-label"><b id="your-name">Ваше Имя</b></label>
        <input type="text" maxlength="40" class="form-input-text" value="' . $_SESSION['nick'][$_GET['id']]['seller_name'] . '" name="seller_name" id="fld_seller_name">
</div><br>

<div class="form-row">
    <label for="fld_email" class="form-label">Электронная почта</label>
        <input type="text" class="form-input-text" value="' . $_SESSION['nick'][$_GET['id']]['email'] . '" name="email" id="fld_email">
</div><br>
<div class="form-row-indented"> 
    <label class="form-label-checkbox" for="allow_mails"> 
        <input type="checkbox" value="1" name="allow_mails" id="allow_mails" class="form-input-checkbox">
            <span class="form-text-checkbox">Я не хочу получать вопосы по объявлению по e-mail</span> 
    </label>
</div><br>
<div class="form-row"> 
    <label id="fld_phone_label" for="fld_phone" class="form-label">Номер телефона</label> 
        <input type="text" class="form-input-text" value="' . $_SESSION['nick'][$_GET['id']]['phone'] . '" name="phone" id="fld_phone">
</div><br>

<div id="f_location_id" class="form-row form-row-required"> 
    <label for="region" class="form-label">Город</label>
 <select title="Выберите Ваш город" name="location_id" id="region" class="form-input-select">';
    global $citys;
    echo '<option data-coords=",,"  value="">' . $citys[$_SESSION['nick'][$_GET['id']]['location_id']] . '</option>    
      </select>
<div id="f_metro_id">
 <select title="Выберите станцию метро" name="metro_id" id="fld_metro_id" class="form-input-select">';
    global $metros;
    echo '<option   value="">' . $metros[$_SESSION['nick'][$_GET['id']]['metro_id']] . '</option>
</select></div><br>     
    </div><br>

<div id="f_road_id">';
    global $roads;
    echo' <select title="Выберите направление" name="road_id" id="fld_road_id" class="form-input-select" style="display: 
        block;">    
        <option  value="">' . $roads[$_SESSION['nick'][$_GET['id']]['road_id']] . '</option>
</select>
</div><br> 


<div class="form-row"> 
    <label for="fld_category_id" class="form-label">Категория</label>';
    global $categories;

    echo' <select title="Выберите категорию" name="category_id" id="fld_category_id" class="form-input-select"> 

           <option value="">' . $categories[array_keys($categories)[0]][$_SESSION['nick'][$_GET['id']]['category_id']]
    . $categories[array_keys($categories)[1]][$_SESSION['nick'][$_GET['id']]['category_id']] . ' </option>   
    </select>
</div><br>
   
<div id="f_title" class="form-row f_title"> 
    <label for="fld_title" class="form-label">Название объявления</label> 
        <input type="text" maxlength="50" class="form-input-text-long" value="' . $_SESSION['nick'][$_GET['id']]['title'] . '" name="title" id="fld_title"> 
</div><br>
<div class="form-row"> 
    <label for="fld_description" class="form-label" id="js-description-label">Описание объявления</label> 
        <textarea maxlength="3000" name="description" id="fld_description" class="form-input-textarea">' . $_SESSION['nick'][$_GET['id']]['description'] . '</textarea> 
</div><br>
<div id="price_rw" class="form-row rl"> 
    <label id="price_lbl" for="fld_price" class="form-label"></label>Цена
        <input type="text" maxlength="9" class="form-input-text-short" value="' . $_SESSION['nick'][$_GET['id']]['price'] . '" name="price" id="fld_price">&nbsp;<span id="fld_price_title">руб.</span> 
            <a class="link_plain grey right_price c-2 icon-link" id="js-price-link" href="/info/pravilnye_ceny?plain"><span>Правильно уакзывайте цену</span></a> 
</div><br>

<div id="f_images" class="form-row"> 
    <label for="fld_images" class="form-label"><span id="js-photo-label">Фотографии</span><span class="js-photo-count" style="display: none;"></span></label> <input type="file" value="image" id="fld_images" name="image" accept="image/*" class="form-input-file"> <span style="line-height:22px;color: gray; display: none;" id="fld_images_toomuch">Вы добавили максимально возможное количество фотографий</span> <span style="display: none;" id="fld_images_overhead"></span> 
</div><br> 
<div style="display: none; margin-top: 0px;" class="form-row-indented images" id="files">
    <div style="display: none;" id="progress"> <table><tbody><tr><td> <div><div></div></div> </td></tr></tbody></table> </div> </div>
<button style="font-size:20px;width:150px;hight:50px;background-color:red"><a href="index.php">Вернуться</a></button>

</div>
</form>
</body>
</html>';
}

if ($_GET ['action']) {
    switch ($_GET['action']) {
        case 'delete':

            $id = $_GET['id'];
            if (isset($_SESSION['nick'][$id])) {
                unset($_SESSION['nick'][$id]);
            }
            break;
        case 'show':
            $id = $_GET['id'];
            if (isset($_SESSION['nick'][$id])) {
                show_advertisement($_SESSION['nick'][$id]);
            }
            break;
    }
}


//unset($_SESSION['nick']);  
?>
