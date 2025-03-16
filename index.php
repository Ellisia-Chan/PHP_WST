<?php
// Initialize variables
$name = $address = $email = "";
$nameErr = $addressErr = $emailErr = "";

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate the inputs
    if (empty($_POST["name"])) {
        $nameErr = "Name is Required!";
    } else {
        $name = $_POST["name"];
    }

    if (empty($_POST["address"])) {
        $addressErr = "Address is Required!";
    } else {
        $address = $_POST["address"];
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is Required!";
    } else {
        $email = $_POST["email"];
    }
}

?>

<style>
    .error {
        color: red;
    }
</style>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="text" name="name" value="<?php echo $name; ?>"> <br>
    <span class="error"><?php echo $nameErr; ?></span> <br>

    <input type="text" name="address" value="<?php echo $address; ?>"> <br>
    <span class="error"><?php echo $addressErr; ?></span> <br>

    <input type="text" name="email" value="<?php echo $email; ?>"> <br>
    <span class="error"><?php echo $emailErr; ?></span> <br>

    <input type="submit" value="Submit">
</form>

<hr>

<?php

include("connections.php");
    if ($name && $address && $email) {
        $query = mysqli_query($connections, "INSERT INTO mytbl (name, address, email) VALUES ('$name', '$address', '$email')");
        
        echo "<script language='javascript'>alert('New Record has been inserted!');</script>";
        echo "<script> window.location.href = 'index.php'; </script>";
    }

    $view_query = mysqli_query($connections, "SELECT * FROM mytbl");

    echo "<style>
            table {
                border-collapse: collapse;
                width: 50%;
            }
            
            th, td {
                border: 1px solid black;
                padding 10px;
                text-align: left;
                width 33.33%;
            }
        </style>";

    echo "<table>";
    echo "<tr>
            <th>Name</th>
            <th>Address</th>
            <th>Email</th>

            <td>Option</td>
        </tr>";

    while ($row = mysqli_fetch_assoc($view_query)) {
        $user_id = $row['id'];

        $db_name = $row['name'];
        $db_address = $row['address'];
        $db_email = $row['email'];

        echo "<tr>
                <td>$db_name</td>
                <td>$db_address</td>
                <td>$db_email</td>

                <td>
                    <a href='edit.php?id=$user_id'>Update</a>
                    &nbsp;
                    <a href='coNfirmdelete.php?id=$user_id'>Delete</a>
                </td>
            </tr>";
    }

    echo "</table>"
?>
