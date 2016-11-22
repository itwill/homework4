<?
// 1 подключаем файл данных xml
$xml = simplexml_load_file('data.xml');

function orderId($xml)
{
    echo $xml['PurchaseOrderNumber'];
}

function orderDate($xml)
{
    echo $xml['OrderDate'];
}

function getAddr($xml)
{
    foreach ($xml->Address as $addr) {
        echo "<h4>" . $addr->Name . "</h4>";
        echo $addr->Street . ", ";
        echo $addr->City . ", ";
        echo $addr->State . ", ";
        echo $addr->Zip . ", ";
        echo $addr->Country . "<br>";
    }
}

function getNotes($xml)
{
    echo $xml->DeliveryNotes;
}

function getItems($xml)
{
    foreach ($xml->Items->Item as $item) {
        echo "<table><tr style='background: #ccc;'><td>PartNumber</td><td>" . $item['PartNumber'] . "</td></tr>";
        echo "<tr><td>ProductName</td><td>" . $item->ProductName . "</td></tr>";
        echo "<tr><td>Quantity</td><td>" . $item->Quantity . "</td></tr>";
        echo "<tr><td>USPrice</td><td>" . $item->USPrice . "</td></tr>";
        echo "<tr><td>Comment</td><td>" . $item->Comment . "</td></tr>";
        echo "<tr><td>ShipDate</td><td>" . $item->ShipDate . "</td></tr>";
        echo "</table>";

    }
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Получение данных из файла data</title>
</head>
<body>
<h3>Задание 1</h3>
<p>PurchaseOrderNumber: <strong><?php orderId($xml); ?></strong><br> OrderDate:
    <strong><?php orderDate($xml); ?></strong></p>
<p>Shipping Address: <br></p><?php getAddr($xml); ?>
<p>DeliveryNotes: <strong><?php getNotes($xml); ?></strong></p>
<p><?php getItems($xml); ?></p>

<h3>Задание 2</h3>
<?php

// создаем массив с уровнем вложенности не менее одного
$flowers = array(
        "rose" => array(
            "color" => "red",
            "height" => "40",
            "size" => "small",
            "manufacture" => "holland"
        ),
        "pion" => array(
            "color" => "pink",
            "height" => "120",
            "size" => "middle",
            "manufacture" => "russia",
        ),
        "lili" => array(
            "color" => "white",
            "height" => "40",
            "size" => "big",
            "manufacture" => "russia",
        )

);

// преобразуем в json
$json1 = json_encode($flowers);

// выводим в файл
if (file_exists('output.json')) {
    file_put_contents('output.json', $json1);
} else {
    $f = fopen('output.json', 'w+');
    fputs($f, $json1);
    fclose($f);
}

// получаем данные из файла
$flowers2 = json_decode(file_get_contents('output.json'), true);

$random = mt_rand(1, 10);

if ($random > 5) {
    $flowers2["bergras"] = "66666";
    $json2 = json_encode($flowers2);
    file_put_contents('output2.json', $json2);
} else {
    file_put_contents('output2.json', $json1);
}

$out1 = json_decode(file_get_contents('output.json'), true);
$out2 = json_decode(file_get_contents('output2.json'), true);


echo "<pre>";
if ((array_diff($out2, $out1))) {
    echo "Различие: ";
    echo "<pre>";
    print_r(array_diff($out2, $out1));
    echo "</pre>";
} else {
    echo "Одинаковы";
}

?>


</body>
</html>