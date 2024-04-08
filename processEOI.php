<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name = "description" content="Creating Web Application Lab 10"/>
    <meta name="Keywords" content="PHP, MySQL"/>
    <title>EOI Record</title>
</head>

<body>
    <?php
        require_once ("settings.php"); // require the file contains database connection information //
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db); // establish a connection to the mysql database server //

        function sanitizeInput($input){ // define sanitizeInput function //
            $input = trim($input);
            $input = stripcslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }

        if(!$conn) {
            echo "<p>Database connection failure</p>";
        } else {
            $jobnum = sanitizeInput($_POST["job-num"]);
            $firstname = sanitizeInput($_POST["first-name"]);
            $lastname = sanitizeInput($_POST["last-name"]);
            $dob = sanitizeInput($_POST["dob"]);
            $gender = sanitizeInput($_POST["gender"]);
            $street = sanitizeInput($_POST["street-add"]);
            $suburb = sanitizeInput($_POST["suburb/town"]);
            $state = sanitizeInput($_POST["state"]);
            $postcode = sanitizeInput($_POST["postcode"]);
            $email = sanitizeInput($_POST["email"]);
            $phone = sanitizeInput($_POST["phone"]);
            $skill1 = sanitizeInput($_POST["skill-list1"]);
            $skill2 = sanitizeInput($_POST["skill-list2"]);
            $skill3 = sanitizeInput($_POST["skill-list3"]);
            $otherskills = sanitizeInput($_POST["other-skills"]);
            

            $error = array(); // initializes an empty array used to store error messages //

            // if the variable does not match the pattern, an error message will be stored in the array //
            if (!preg_match("/^[A-Za-z0-9]{5}/", $jobnum)) { 
                $error[] = "Job reference number must be exactly 5 alphanumeric characters";
            }
        
            // if the variable does not match the pattern, an error message will be stored in the array //
            if (!preg_match("/^[A-Za-z]{1, 20}/", $firstname)) { 
                $error[] = "First name must be maximum 20 alphabetic characters";
            }

            // if the variable does not match the pattern, an error message will be stored in the array //
            if (!preg_match("/^[A-Za-z]{1, 20}/", $lastname)) { 
                $error[] = "Last name must be maximum 20 alphabetic characters";
            }

            // if the variable does not match the pattern, an error message will be stored in the array //
            if (!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\ /(0[1-9]|1[0-2])\ /(19[4-9][0-9]|200[0-9])$", $dob)) { 
                $error[] = "Date of birth must be in dd/mm/yyyy format and you must be between 15 and 80 years old";
            }

            // if the variable does not match the pattern, an error message will be stored in the array //
            if (!preg_match("/^[A-Za-z]{1, 40}/", $street)) { 
                $error[] = "Street address must be maximum 40 alphabetic characters";
            }

            // if the variable does not match the pattern, an error message will be stored in the array //
            if (!preg_match("/^[A-Za-z]{1, 40}/", $suburb)) { 
                $error[] = "Suburb / Town must be maximum 40 alphabetic characters";
            }

            $validstates = array("VIC", "NSW", "QLD", "NT", "WA", "SA", "TAS", "ACT"); // initializes an array that holds the state values //
            if (!in_array($state, $validstates)){ // if the variable does not match the values inside the array above, an error message will be stored in the array //
                $error[] = "Please select a valid state";
            }

            if (!preg_match("/^[0-9]{4}/", $postcode)) { // if the variable does not match the pattern, an error message will be stored in the array //
                $error[] =" Postcode must be exactly 4 digits";
            } else {
                $postcodelist = array( // initializes an array that holds state postcode values //
                    "VIC" => "/^3/",
                    "NSW" => "/^2/",
                    "QLD" => "/^4/",
                    "NT" => "/^08/",
                    "WA" => "/^6/",
                    "SA" => "/^5/",
                    "TAS" => "/^7/",
                    "ACT" => "/^02/",
                );
                if (!preg_match($postcodelist[$state], $postcode)) { // if the variable does not match the pattern, an error message will be stored in the array //
                    $error[] = "Postcode does not match the selected state";
                }
            }

            // if the variable does not match the pattern, an error message will be stored in the array //
            if (!preg_match("/[0-9 ]{8-12}$/", $phone)) {
                $error[] = "Phone number must be 8 to 12 digits or spaces";
            }

            if (isset($_POST["checkbox"]) && empty($otherskills)) { // if a checkbox is checked and if the input field is empty, an error message will be stored in the array //
                $error[] = "Please provide other skills";
            }

            if (empty($error)) { // if there is no error message, the code below will be execute // 
                $sql_table = "EOI"; // assigns the name of the SQL table to the variable $sql_table //
                // insert data into a table //
                $query = "INSERT INTO $sql_table (JobReferenceNumber, FirstName, LastName, StreetAddress, SuburbTown, State, Postcode, Email, PhoneNumber, Skill1, Skill2, Skill3, OtherSkill) 
                           VALUES ('$jobref', '$firstname', '$lastname', '$street', '$suburb', '$state', '$postcode', '$email', '$phone', '$skill1', '$skill2', '$skill3', '$otherskill')";
                $result = mysqli_query($conn, $query); //executes an SQL query on the database connection //
                
                if (!$result) { // if there was an error in executing the query, the error message will be printed //
                    echo "<p class=\"wrong\">Something is wrong with ", $query, "</p>";
                } else { // if not, the code below will be executed //
                    $eoinum = mysqli_insert_id($conn); // retrieves the auto-generated EOI number // 
                    echo "<p class =\"ok\">EOI record is successfully added. Your EOI number is:" ,$eoinum,".<p>"; // prints a success message //
                }
            } else { // if there is any error messages, the code below will be executed //
                foreach($error as $error){ // a foreach loop that iterates over each element in the $errors array //
                    echo $error . "<br>"; // print each error message //
                }
            }

        }
        mysqli_close($conn); // close the connection to the mysql database //
    ?>    
</body>
</html>