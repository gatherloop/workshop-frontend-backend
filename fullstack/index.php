<?php require_once('db.php'); $conn = connectToDB(); session_start(); ?>

<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form action="insert_student.php" method="POST">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="lname">Age:</label><br>
    <input type="number" id="age" name="age"><br>
    <label for="address">Address:</label><br>
    <textarea id="address" name="address"></textarea><br>
    <label for="phone">Phone Number:</label><br>
    <input type="text" id="phone" name="phone"><br><br>
    <input type="submit" id="submit" name="submit" value="Submit">
</form>

<?php
    if (isset($_SESSION['alert'])) { ?>
        <p><?= $_SESSION['alert'] ?></p>
    <?php unset($_SESSION['alert']);
    }
?>

<br>

<table border="1px">
    <tr>
        <td>NO</td>
        <td>Name</td>
        <td>Age</td>
        <td>Address</td>
        <td>Phone Number</td>
        <td>Action</td>
    </tr>
    <?php
        $data = $conn->query("SELECT * FROM students");
        $no = 1;

        if ($data->num_rows == 0) { ?>
            <tr>
                <td colspan="6" style="text-align: center">Tidak Ada Dta</td>
            </tr>
        <?php } else {
            while($row = $data->fetch_assoc()) { ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['age'] ?></td>
                    <td><?= $row['address'] ?></td>
                    <td><?= $row['phone'] ?></td>
                    <td>
                        <a href="delete_student.php?id=<?=$row['id']?>" id="delete" name="delete">Delete</a>
                    </td>
                </tr>
                <?php $no++; }
        }
    ?>
</table>

</body>
</html>
