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
$flowers = [
    "flower" => [
        "rose" => [
            "color" => "red",
            "height" => "40",
            "size" => "small",
            "manufacture" => "holland",
        ],
        "pion" =>[
            "color" => "pink",
            "height" => "",
            "size" => "middle",
            "manufacture" => "russia",
        ],
        "lili" => [
            "color" => "white",
            "height" => "40",
            "size" => "big",
            "manufacture" => "russia",
        ]
    ]
];

//echo "<pre>";
var_dump($flowers);
//echo "</pre>";

// преобразуем в json
$json = json_encode($flowers);
echo "<pre>";
var_dump($json);
echo "</pre>";

// выводим в файл
if (file_exists('output.json')){
    file_put_contents('output.json', $json);
} else {
    $f = fopen('output.json','w+');
    fputs($f, $json);
    fclose($f);
}

// получаем данные из файла
$file = file_get_contents('output.json');
$flowers_new = json_decode($file, true);

$random = rand(1, 10);

if ($random > 5) {
//    echo "Менять";
    $flowers_new["flower"]["rose"]["color"] = "blue";
//    echo "<pre>";
    var_dump($flowers_new);
//    echo "</pre>";
}

// выводим в файл
$json2 = json_encode($flowers_new);
if (file_exists('output2.json')){
    file_put_contents('output2.json', $json2);
} else {
    $f = fopen('output2.json','w+');
    fputs($f, $json2);
    fclose($f);
}
echo "<pre>";
var_dump($json2);
echo "</pre>";

?>


</body>
</html>