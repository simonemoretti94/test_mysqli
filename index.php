<?php
$title = 'index';
// db connections

//1.
define('DB_SERVERNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', '1_pt_university');

//2.
$connection = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

//3. 
if ($connection && $connection->connect_error) {
    echo 'Dataabase Connection Faild' . $connection->connect_error;
    die;
}

if (empty($_POST['name'])) {
    $sql = "SELECT * FROM `departments`";
    $result = $connection->query($sql);
}

if (!empty($_POST['name'])) {
    $name = $_POST['name'];
    $sql = "SELECT * FROM `departments` WHERE `name` = '$name'";
    var_dump($sql);
    // die;
    $result = $connection->query($sql);
}

var_dump($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require_once './components/header.php';
    ?>

<body>

    <form action="" method="post">
        <style>
            form {
                display: flex;

                >input {
                    flex: 60%;
                }

                & button {
                    flex: 20%;
                }

                & a {
                    flex: 20%;
                    text-align: center;
                }
            }
        </style>
        <input type="text" name="name" id="name" placeholder="search a department by name" required>
        <button type="submit">search</button>
        <a href="/">reset</a>
    </form>

    <?php while ($row = $result->fetch_assoc()) :
        ['id' => $id, 'name' => $name, 'website' => $website] = $row; ?>

        <hr style="margin-top: .5rem;">
        <div>
            <p>name: <strong><?php echo $name ?></strong></p>
            <p>website: <strong><?php echo $website ?></strong></p>
        </div>
        <hr>

    <?php endwhile; ?>

    <?php if ($result->num_rows === 0) : ?>

        <p><b><i>No results</i></b></p>

    <?php endif; ?>

</body>

</html>