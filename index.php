<?php
require_once __DIR__."/Department.php";
require_once __DIR__."/database.php";

//var_dump($conn);

$sql = "SELECT `id`, `name` FROM `departments`";
$result = $conn->query($sql);

$departments_array = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        //var_dump($row);
        $current_row = new Department($row["id"], $row["name"]);
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
    <title>Dipartimenti Uni</title>
</head>
<body>
    <h1>Elenco Dipartimenti</h1>
    <?php 
    foreach ($departments_array as $key => $value) { ?>
        <div>
            <h2><?php echo $value->name; ?></h2>
            <a href="dept_detail.php?id=<?php echo $value->id;?>">Più informazioni</a>
        </div>
    <?php } ?>

</body>
</html>