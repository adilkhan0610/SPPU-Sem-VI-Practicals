<?php

require_once __DIR__ . '/db.php';

$errors = [];
$message = '';

$modalMode = '';
$modalData = [
    'EmployeeId' => '',
    'EmployeeName' => '',
    'City' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = $_POST['action'] ?? '';

    $employeeId = trim($_POST['EmployeeId'] ?? '');
    $employeeName = trim($_POST['EmployeeName'] ?? '');
    $city = trim($_POST['City'] ?? '');

    if ($action === 'insert' || $action === 'update') {

        if ($employeeName === '')
            $errors[] = 'Employee name is required.';

        if ($city === '')
            $errors[] = 'City is required.';
    }

    if (empty($errors)) {

        if ($action === 'insert') {

            $stmt = $mysqli->prepare(
                'INSERT INTO employees (EmployeeName, City)
                 VALUES (?, ?)'
            );

            $stmt->bind_param(
                'ss',
                $employeeName,
                $city
            );

            $stmt->execute();

            $message = 'Employee added successfully.';

            $stmt->close();
        }

        elseif ($action === 'update') {

            $stmt = $mysqli->prepare(
                'UPDATE employees
                 SET EmployeeName=?, City=?
                 WHERE EmployeeId=?'
            );

            $stmt->bind_param(
                'ssi',
                $employeeName,
                $city,
                $employeeId
            );

            $stmt->execute();

            $message = 'Employee updated successfully.';

            $stmt->close();
        }
    }
}

if (
    isset($_GET['action']) &&
    $_GET['action'] === 'delete'
) {

    $id = $_GET['EmployeeId'];

    $stmt = $mysqli->prepare(
        'DELETE FROM employees
         WHERE EmployeeId=?'
    );

    $stmt->bind_param('i', $id);

    $stmt->execute();

    $message = 'Employee deleted successfully.';

    $stmt->close();
}

$result = $mysqli->query(
    'SELECT * FROM employees
     ORDER BY EmployeeId DESC'
);

?>

<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Employee CRUD</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>

<div class="container">

<div class="toolbar">

<div>
<h1>Employee Management</h1>
<p>
Manage employee records with insert,
update, view, and delete.
</p>
</div>

<button class="button-primary"
onclick="openModal()">
Add Employee
</button>

</div>

<?php if ($message): ?>
<div class="alert alert-success">
<?php echo $message; ?>
</div>
<?php endif; ?>

<div class="grid">

<?php while($row = $result->fetch_assoc()): ?>

<div class="card">

<h2>
<?php echo $row['EmployeeName']; ?>
</h2>

<p>
ID:
<?php echo $row['EmployeeId']; ?>
</p>

<p>
City:
<?php echo $row['City']; ?>
</p>

<button
class="button-secondary"
onclick="editEmp(
<?php echo $row['EmployeeId']; ?>,
'<?php echo $row['EmployeeName']; ?>',
'<?php echo $row['City']; ?>'
)">
Update
</button>

<a
class="button-danger"
href="?action=delete&EmployeeId=<?php echo $row['EmployeeId']; ?>">
Delete
</a>

</div>

<?php endwhile; ?>

</div>

</div>

<!-- Modal -->

<div id="modal" class="modal-backdrop">

<div class="modal">

<h2 id="modalTitle">
Add Employee
</h2>

<form method="POST">

<input
type="hidden"
name="action"
id="action"
value="insert">

<input
type="hidden"
name="EmployeeId"
id="empId">

<label>Name</label>

<input
type="text"
name="EmployeeName"
id="name"
required>

<label>City</label>

<input
type="text"
name="City"
id="city"
required>

<button
type="submit"
class="button-primary">
Save
</button>

<button
type="button"
onclick="closeModal()">
Cancel
</button>

</form>

</div>

</div>

<script>

function openModal() {
    document.getElementById('modal').style.display='flex';
}

function closeModal() {
    document.getElementById('modal').style.display='none';
}

function editEmp(id,name,city) {

    openModal();

    document.getElementById('action').value='update';
    document.getElementById('empId').value=id;
    document.getElementById('name').value=name;
    document.getElementById('city').value=city;
}

</script>

</body>
</html>
