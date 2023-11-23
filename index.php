<?php
// DB connection info
// TODO: Update the values for $host, $user, $pwd, and $db //using the values you retrieved earlier from the Azure Portal. $host = "value of Data Source";
$host = "s1marjanovic-server.mysql.database.azure.com";
$user = "ybipyeftul";
$pwd = "E24Q3VFDRQ5DS07M$";
$db = "s1marjanovic-database";
// Connect to database.
$conn = mysqli_connect($host, $user, $pwd, $db);

if (mysqli_connect_errno()) {
    echo "<h3>Failed to connect to MySQL:</h3> " . mysqli_connect_error();
} else {
    // echo '<h3>Connected successfully</h3>'; 
    // Insert registration info
    if (!empty($_POST)) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $date = date("Y-m-d");

        // Insert data
        $sql_insert = "INSERT INTO registration_tbl (name, email, date) VALUES ('$name','$email','$date')";

        if ($conn->query($sql_insert) === TRUE) {
            echo "<h3>You're registered!</h3>";

            // Retrieve data
            $sql_select = "SELECT * FROM registration_tbl";
            $registrants = $conn->query($sql_select);

            if ($registrants->num_rows > 0) {
                echo "<h2>People who are registered:</h2>";
                echo "<table>";
                echo "<tr><th>Name</th>";
                echo "<th>Email</th>";
                echo "<th>Date</th></tr>";

                while ($registrant = $registrants->fetch_assoc()) {
                    echo "<tr><td>{$registrant['name']}</td>";
                    echo "<td>{$registrant['email']}</td>";
                    echo "<td>{$registrant['date']}</td></tr>";
                }

                echo "</table>";
            } else {
                echo "<h3>No one is currently registered.</h3>";
            }
        } else {
            echo "Insert Failed";
        }
    }
}
?>