<?
// 1 подключаем файл данных xml
$xml = simplexml_load_file('data.xml');

function orderId($xml){
    echo $xml['PurchaseOrderNumber'];
}

function orderDate($xml){
    echo $xml['OrderDate'];
}

function getAddr($xml){
    foreach ($xml->Address as $addr){
        echo "<h4>" . $addr->Name . "</h4>";
        echo $addr->Street . ", ";
        echo $addr->City . ", ";
        echo $addr->State . ", ";
        echo $addr->Zip . ", ";
        echo $addr->Country . "<br>";
    }
}

function getNotes($xml){
    echo $xml->DeliveryNotes;
}

function getItems($xml){
    foreach ($xml->Items->Item as $item){
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
<p>PurchaseOrderNumber: <strong><?php orderId($xml);?></strong><br> OrderDate: <strong><?php orderDate($xml);?></strong></p>
<p>Shipping Address: <br></p><?php getAddr($xml);?>
<p>DeliveryNotes: <strong><?php getNotes($xml);?></strong></p>
<p><?php getItems($xml);?></p>


</body>
</html>