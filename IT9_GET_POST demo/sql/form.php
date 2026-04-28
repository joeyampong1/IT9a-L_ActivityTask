<?php

include "connection.php"; // your database connection



// --- DELETE FUNCTIONALITY ---

if (isset($_GET['delete'])) {

  $deleteId = $_GET['delete'];

  $sql = "DELETE FROM patient WHERE PatientId='$deleteId'";

  mysqli_query($conn, $sql);

  echo "Patient deleted successfully!<br><br>";

}



// --- EDIT FUNCTIONALITY ---

$editId = $_GET['edit'] ?? '';

$PatientName = '';

$PatientAddress = '';

$ContactNumber = '';



if ($editId) {

  $result_edit = mysqli_query($conn, "SELECT * FROM patient WHERE PatientId='$editId'");

  $row_edit = mysqli_fetch_assoc($result_edit);

  $PatientName = $row_edit['PatientName'];

  $PatientAddress = $row_edit['PatientAddress'];

  $ContactNumber = $row_edit['ContactNumber'];

}



// --- ADD OR UPDATE ---

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $PatientName = $_POST['PatientName'];

  $PatientAddress = $_POST['PatientAddress'];

  $ContactNumber = $_POST['ContactNumber'];



  if (!empty($editId)) {

    // UPDATE

    $sql = "UPDATE patient SET 

          PatientName='$PatientName',

          PatientAddress='$PatientAddress',

          ContactNumber='$ContactNumber'

        WHERE PatientId='$editId'";

    mysqli_query($conn, $sql);

    echo "Patient updated successfully!<br><br>";

    $editId = ''; 

  } else {

    // ADD

    $sql = "INSERT INTO patient (PatientName, PatientAddress, ContactNumber)

        VALUES ('$PatientName', '$PatientAddress', '$ContactNumber')";

    mysqli_query($conn, $sql);

    echo "Patient added successfully!<br><br>";

  }

  header("Location: " . $_SERVER['PHP_SELF']);

  exit;

}



// --- GET ALL PATIENTS ---

$result = mysqli_query($conn, "SELECT * FROM patient");

?>



<!-- HTML FORM -->

<form method="POST">

  <label>Patient Name:</label>

  <input type="text" name="PatientName" value="<?php echo $PatientName; ?>" required><br>



  <label>Patient Address:</label>

  <input type="text" name="PatientAddress" value="<?php echo $PatientAddress; ?>" required><br>



  <label>Contact Number:</label>

  <input type="text" name="ContactNumber" value="<?php echo $ContactNumber; ?>" required><br>



  <button type="submit"><?php echo $editId ? 'Update Patient' : 'Add Patient'; ?></button>

</form>



<!-- PATIENT TABLE -->

<h2>All Patients</h2>

<table border="1" cellpadding="5" cellspacing="0">

  <tr>

    <th>ID</th>

    <th>Name</th>

    <th>Address</th>

    <th>Contact Number</th>

    <th>Actions</th>

  </tr>



  <?php

  if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

      echo "<tr>";

      echo "<td>".$row['PatientId']."</td>";

      echo "<td>".$row['PatientName']."</td>";

      echo "<td>".$row['PatientAddress']."</td>";

      echo "<td>".$row['ContactNumber']."</td>";

      echo "<td>

          <a href='?edit=".$row['PatientId']."'>Edit</a> | 

          <a href='?delete=".$row['PatientId']."' onclick='return confirm(\"Are you sure?\")'>Delete</a>

         </td>";

      echo "</tr>";

    }

  } else {

    echo "<tr><td colspan='5'>No patients found</td></tr>";

  }

  ?>

</table>

Type Message