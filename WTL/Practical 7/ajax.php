<?php

header('Content-Type: application/json');

try {

include 'db.php';

$action = isset($_POST['action'])
          ? $_POST['action']
          : '';

if ($action == 'fetch') {

    $sql = "SELECT * FROM employees";

    $result = $conn->query($sql);

    $employees = [];

    while($row = $result->fetch_assoc()) {

        $employees[] = $row;

    }

    echo json_encode([
        'success' => true,
        'data' => $employees
    ]);
}

elseif ($action == 'insert') {

    $name =
    $conn->real_escape_string($_POST['name']);

    $city =
    $conn->real_escape_string($_POST['city']);

    $sql =
    "INSERT INTO employees(name,city)
     VALUES('$name','$city')";

    $conn->query($sql);

    echo json_encode([
        'success' => true
    ]);
}

elseif ($action == 'update') {

    $id = intval($_POST['id']);

    $name =
    $conn->real_escape_string($_POST['name']);

    $city =
    $conn->real_escape_string($_POST['city']);

    $sql =
    "UPDATE employees
     SET name='$name',
     city='$city'
     WHERE id=$id";

    $conn->query($sql);

    echo json_encode([
        'success' => true
    ]);
}

elseif ($action == 'delete') {

    $id = intval($_POST['id']);

    $sql =
    "DELETE FROM employees
     WHERE id=$id";

    $conn->query($sql);

    echo json_encode([
        'success' => true
    ]);
}

$conn->close();

}
catch (Exception $e) {

echo json_encode([
    'success' => false,
    'error' => $e->getMessage()
]);

}

?>
