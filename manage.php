<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Manager Dashboard</title>
</head>
<body>
    <h1>HR Manager Dashboard</h1>
    <h2>List All EOIs</h2>
    <a href="manage.php?action=listAll">List All EOIs</a>

    <h2>List EOIs for a particular position</h2>
    <form action="manage.php" method="get">
        <label for="job_ref_number">Job Reference Number:</label>
        <input type="text" id="job_ref_number" name="job_ref_number" required>
        <input type="hidden" name="action" value="listPosition">
        <button type="submit">List EOIs</button>
    </form>

    <h2>List EOIs for a particular applicant</h2>
    <form action="manage.php" method="get">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>
        <input type="hidden" name="action" value="listApplicant">
        <button type="submit">List EOIs</button>
    </form>

    <h2>Delete EOIs with a specified job reference number</h2>
    <form action="manage.php" method="get">
        <label for="delete_job_ref_number">Job Reference Number:</label>
        <input type="text" id="delete_job_ref_number" name="delete_job_ref_number" required>
        <input type="hidden" name="action" value="delete">
        <button type="submit">Delete EOIs</button>
    </form>

    <h2>Change the Status of an EOI</h2>
    <form action="manage.php" method="get">
        <label for="eoi_id">EOI ID:</label>
        <input type="text" id="eoi_id" name="eoi_id" required>
        <label for="new_status">New Status:</label>
        <input type="text" id="new_status" name="new_status" required>
        <input type="hidden" name="action" value="changeStatus">
        <button type="submit">Change Status</button>
    </form>

    <?php
        include 'settings.php';

        // Create a connection
        $conn = mysqli_connect($host, $user, $password, $database);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Function to sanitize user inputs
        function sanitize($input) {
            return htmlspecialchars(stripslashes(trim($input)));
        }

        // List all EOIs
        function listAllEOIs($conn) {
            $sql = "SELECT * FROM eoi";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo "<h2>All EOIs</h2>";
                echo "<table border='1'>";
                echo "<tr><th>EOInumber</th><th>Job Reference Number</th><th>First Name</th><th>Last Name</th><th>Status</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['EOInumber'] . "</td>";
                    echo "<td>" . $row['JobReferenceNumber'] . "</td>";
                    echo "<td>" . $row['FirstName'] . "</td>";
                    echo "<td>" . $row['LastName'] . "</td>";
                    echo "<td>" . $row['Gender'] . "</td>";
                    echo "<td>" . $row['StreetAddress'] . "</td>";
                    echo "<td>" . $row['SuburbTown'] . "</td>";
                    echo "<td>" . $row['State'] . "</td>";
                    echo "<td>" . $row['Postcode'] . "</td>";
                    echo "<td>" . $row['Email'] . "</td>";
                    echo "<td>" . $row['PhoneNumber'] . "</td>";
                    echo "<td>" . $row['OtherSkills'] . "</td>";
                    echo "<td>" . $row['Status'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No EOIs found.";
            }
        }

        // List EOIs for a particular position
        function listEOIsForPosition($conn, $jobRefNumber) {
            $sql = "SELECT * FROM eoi WHERE Job_Reference_Number = '$jobRefNumber'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo "<h2>EOIs for Job Reference Number: $jobRefNumber</h2>";
                echo "<table border='1'>";
                echo "<tr><th>EOInumber</th><th>First Name</th><th>Last Name</th><th>Status</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['EOInumber'] . "</td>";
                    echo "<td>" . $row['JobReferenceNumber'] . "</td>";
                    echo "<td>" . $row['FirstName'] . "</td>";
                    echo "<td>" . $row['LastName'] . "</td>";
                    echo "<td>" . $row['Gender'] . "</td>";
                    echo "<td>" . $row['StreetAddress'] . "</td>";
                    echo "<td>" . $row['SuburbTown'] . "</td>";
                    echo "<td>" . $row['State'] . "</td>";
                    echo "<td>" . $row['Postcode'] . "</td>";
                    echo "<td>" . $row['Email'] . "</td>";
                    echo "<td>" . $row['PhoneNumber'] . "</td>";
                    echo "<td>" . $row['OtherSkills'] . "</td>";
                    echo "<td>" . $row['Status'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No EOIs found for the specified position.";
            }
        }

        // List EOIs for a particular applicant
        function listEOIsForApplicant($conn, $firstName, $lastName) {
            $sql = "SELECT * FROM eoi WHERE First_Name = '$firstName' OR Last_Name = '$lastName' OR (First_Name = '$firstName' AND Last_Name = '$lastName')" ;
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo "<h2>EOIs for Applicant: $firstName $lastName</h2>";
                echo "<table border='1'>";
                echo "<tr><th>EOInumber</th><th>Job Reference Number</th><th>Status</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['EOInumber'] . "</td>";
                    echo "<td>" . $row['JobReferenceNumber'] . "</td>";
                    echo "<td>" . $row['FirstName'] . "</td>";
                    echo "<td>" . $row['LastName'] . "</td>";
                    echo "<td>" . $row['Gender'] . "</td>";
                    echo "<td>" . $row['StreetAddress'] . "</td>";
                    echo "<td>" . $row['SuburbTown'] . "</td>";
                    echo "<td>" . $row['State'] . "</td>";
                    echo "<td>" . $row['Postcode'] . "</td>";
                    echo "<td>" . $row['Email'] . "</td>";
                    echo "<td>" . $row['PhoneNumber'] . "</td>";
                    echo "<td>" . $row['OtherSkills'] . "</td>";
                    echo "<td>" . $row['Status'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No EOIs found for the specified applicant.";
            }
        }

        // Delete all EOIs with a specified job reference number
        function deleteEOIs($conn, $jobRefNumberToDelete) {
            $sql = "DELETE FROM eoi WHERE Job_Reference_Number = '$jobRefNumberToDelete'";
            if (mysqli_query($conn, $sql)) {
                echo "<p>EOIs with Job Reference Number '$jobRefNumberToDelete' deleted successfully.</p>";
            } else {
                echo "Error deleting EOIs: " . mysqli_error($conn);
            }
        }

        // Change the Status of an EOI
        function changeStatus($conn, $eoiIdToChangeStatus, $newStatus) {
            $sql = "UPDATE eoi SET Status = '$newStatus' WHERE EOInumber = $eoiIdToChangeStatus";
            if (mysqli_query($conn, $sql)) {
                echo "<p>Status of EOI with ID '$eoiIdToChangeStatus' changed to '$newStatus' successfully.</p>";
            } else {
                echo "Error updating status: " . mysqli_error($conn);
            }
        }

        // Process the queries based on the parameters received
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'listAll':
                        listAllEOIs($conn);
                        break;
                    case 'listPosition':
                        if (isset($_GET['job_ref_number'])) {
                            listEOIsForPosition($conn, sanitize($_GET['job_ref_number']));
                        } else {
                            echo "Job reference number is required.";
                        }
                        break;
                    case 'listApplicant':
                        if (isset($_GET['first_name']) && isset($_GET['last_name'])) {
                            listEOIsForApplicant($conn, sanitize($_GET['first_name']), sanitize($_GET['last_name']));
                        } else {
                            echo "Both first name and last name are required.";
                        }
                        break;
                    case 'delete':
                        if (isset($_GET['job_ref_number'])) {
                            deleteEOIs($conn, sanitize($_GET['job_ref_number']));
                        } else {
                            echo "Job reference number is required.";
                        }
                        break;
                    case 'changeStatus':
                        if (isset($_GET['eoi_id']) && isset($_GET['new_status'])) {
                            changeStatus($conn, sanitize($_GET['eoi_id']), sanitize($_GET['new_status']));
                        } else {
                            echo "Both EOI ID and new status are required.";
                        }
                        break;
                    default:
                        echo "Invalid action.";
                }
            }
        }

        // Close the connection
        mysqli_close($conn);
    ?>

</body>
</html>