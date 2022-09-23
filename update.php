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



    $ptid = $_REQUEST['patientId'];

    $sql1 = "SELECT * FROM patients WHERE patientId=$ptid";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute();
    $patients =   $stmt1->fetch();
    // print_r($patients);



    ?>

    <main>
        <div class="container px-4 py-5 ">
            <div class="row align-items-center g-lg-5 py-5 justify-content-between">
                <div class="col-lg-5 text-center text-lg-start p-2 mb-2 p-lg-5 pe-lg-0" id="text">
                    <h1 class="text-center display-4 fw-bold lh-1 mb-3">Edit <?php echo $patients['patientName'] ?>'s info</h1>
                    <a href="index.php" class="btn btn-light w-50" style="background-color:#e4d9d7; border:none; display:block; margin:5% auto"><i class="fa-solid fa-angle-left"></i> Patients Records</a>
                </div>
                <div class="col-md-10 mx-auto col-lg-5">
                    <form class="p-4 p-md-5 border rounded-3 bg-light" action="updatefunc.php" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="ptname" id="pt-name" placeholder="John Doe" value="<?php echo $patients['patientName'] ?>" required />
                            <label for="pt-name" class="form-label">Patient Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" name="ptage" id="pt-age" placeholder="30" value="<?php echo $patients['patientAge'] ?>" required />
                            <label for="pt-age" class="form-label">Patient Age</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="ptaddress" id="pt-address" placeholder="City name" value="<?php echo $patients['patientAddress'] ?>" required />
                            <label for="pt-address" class="form-label">Patient Address</label>
                        </div>
                        <div class="mb-3">
                            <label for="pt-physician" class="form-label">Patient Physician</label>
                            <select id="pt-physician" name="ptphysician" class="form-select" aria-label="Default select example" required>

                                <?php
                                foreach ($physicians as $physician) {
                                ?>
                                    <option value=" <?php echo $physician['physicianid'] ?>" <?php if ($patients['physicianid'] == $physician['physicianid']) { ?> selected <?php } ?> )>
                                        <?php echo $physician['physicianname'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <input type="text" hidden name="ptid" value="<?php echo $ptid ?> ">
                        <button type="submit" name="submit" class="btn btn-large w-100 " style="background-color: #75312D; border:none; color: white">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </main>









    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>

</html>