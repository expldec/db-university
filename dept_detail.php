<?php
require_once __DIR__."/Department.php";
require_once __DIR__."/database.php";

//var_dump($conn);
$id = $_GET["id"];

//prepared statement per sanificare l'input client-side
$statement = $conn->prepare("SELECT * FROM `departments` WHERE `id` =?;");
//con bind_param su un prepared statement, dichiariamo che la wildcard "?" nel prepared statement deve essere un numero intero
// se ci fossero più wildcard la riga sarebbe tipo $statement->bind_param("is",$id, $name);
//ovvero i per intero, s per stinga, e poi le due variabili da "bindare"
$statement->bind_param("i",$id);

//eseguiamo il prepared statemen e salviamo il risultato dentro $result
$statement->execute();
$result = $statement->get_result();

$departments_array = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        //var_dump($row);
        $current_row = new Department($row["id"], $row["name"]);
        $current_row->setDetails($row["address"],$row["phone"],$row["email"],$row["website"],$row["head_of_department"]);
        $departments_array[] = $current_row;
    }
}
elseif ($result) {
    // c'è un risultato, ma è vuoto
}
else {
    // non c'è il risultato c'è un problema con la query
    echo "Errore";
}

//var_dump($departments_array);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department detail</title>
</head>
<body>
<?php 
    foreach ($departments_array as $key => $value) { ?>
        <div>
            <h2>Info <?php echo $value->name; ?></h2>
            <ul>
                <li><strong>Preside: </strong><?php echo $value->head_of_department; ?></li>
                <li><strong>Sede: </strong><?php echo $value->address; ?></li>
                <li><strong>Sito web: </strong><?php echo $value->website; ?></li>
                <li><strong>Email: </strong><?php echo $value->email; ?></li>
                <li><strong>Telefono: </strong><?php echo $value->phone; ?></li>
            </ul>
        </div>
    <?php } ?>
</body>
</html>