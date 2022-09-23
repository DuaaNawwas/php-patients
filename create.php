<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <link rel="stylesheet" href="./style.css">

</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="./index.php">Hospital Manager</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Form -->
    <?php
    include 'connect.php';
    $sql = "SELECT * FROM physicians";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $physicians =   $stmt->fetchAll();
    ?>

    <main id="createmain">
        <div class="container px-4 py-5 ">
            <div class="row align-items-center g-lg-5 py-5 justify-content-between">
                <div class="col-lg-5 text-center text-lg-start p-2 mb-2 p-lg-5 pe-lg-0" id="text">
                    <h1 class="display-4 fw-bold lh-1 mb-3">Add a new patient to the system</h1>
                    <p class="col-lg-10 fs-4">Fill in the required information to add new patients records to the hospital database</p>
                    <a href="index.php" class="btn btn-light w-50" style="background-color:#e4d9d7; border:none; display:block; margin-left: 20% "><i class=" fa-solid fa-angle-left"></i> Patients Records</a>
                </div>
                <div class="col-md-10 mx-auto col-lg-5">
                    <form class="p-4 p-md-5 border rounded-3 bg-light" action="create.php" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="ptname" id="pt-name" placeholder="John Doe" required />
                            <label for="pt-name" class="form-label">Patient Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" name="ptage" id="pt-age" placeholder="30" required />
                            <label for="pt-age" class="form-label">Patient Age</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="ptaddress" id="pt-address" placeholder="City name" required />
                            <label for="pt-address" class="form-label">Patient Address</label>
                        </div>
                        <div class="mb-3">
                            <label for="pt-physician" class="form-label">Patient Physician</label>
                            <select id="pt-physician" name="ptphysician" class="form-select" aria-label="Default select example" required>
                                <option selected></option>
                                <?php
                                foreach ($physicians as $physician) {
                                ?>
                                    <option value="<?php echo $physician['physicianid'] ?>"><?php echo $physician['physicianname'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-large w-100 " style="background-color: #75312D; border:none; color: white">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </main>



    <?php
    if (isset($_POST['submit'])) {

        try {


            // Create prepared statement
            $sql = "INSERT INTO patients (patientname, patientage, patientaddress, physicianid) VALUES (:ptname, :ptage, :ptaddress, :ptphysician)";
            $stmt = $conn->prepare($sql);

            // Bind parameters to statement
            $stmt->bindParam(':ptname', $_REQUEST['ptname']);
            $stmt->bindParam(':ptage', $_REQUEST['ptage']);
            $stmt->bindParam(':ptaddress', $_REQUEST['ptaddress']);
            $stmt->bindParam(':ptphysician', $_REQUEST['ptphysician']);

            // Execute the prepared statement
            $stmt->execute();
            echo "Records inserted successfully.";
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
    }

    ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>

</html>