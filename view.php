<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    <?php
    include 'connect.php';




    $ptid = $_REQUEST['patientId'];

    $sql1 = "SELECT * FROM patients WHERE patientId=$ptid";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute();
    $patients =   $stmt1->fetch();
    // print_r($patients);

    // $sql = "SELECT patients.physicianid, physicians.physicianname, physicians.department
    // FROM patients
    // INNER JOIN physicians
    // ON patients.physicianid = physicians.physicianid;";

    $sql = "SELECT * FROM physicians";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $physicians =   $stmt->fetchAll();

    // print_r($physicians);
    ?>

    <div class="container my-5">
        <div class="row p-4  pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg justify-content-around">
            <div class="col-4">
                <img src="./images/Lifesavers - Waiting.png" alt="">
            </div>
            <div id="ptcard" class="col-6">
                <h1 style="border-bottom: 1px solid grey;">Patient Record for id: <?php echo $patients['patientId']; ?></h1>
                <h3>Name: <?php echo $patients['patientName']; ?> </h3>
                <h3>Age: <?php echo $patients['patientAge']; ?> </h3>
                <h3>Address: <?php echo $patients['patientAddress']; ?> </h3>
                <?php
                foreach ($physicians as $physician) {

                    if ($physician['physicianid'] == $patients['physicianid']) {

                ?>

                        <h3>Physician:
                            <?php
                            echo $physician['physicianname'];
                            ?>
                        </h3>
                        <h3>Department:
                        <?php
                        echo $physician['department'];
                    } ?>
                        </h3>
                    <?php

                }
                    ?>
            </div>

        </div>
        <a href="index.php" class="btn btn-primary w-25" style="background-color:#686089; border:none; display:block; margin:5% auto"><i class="fa-solid fa-angle-left"></i> Patients Records</a>
    </div>
</body>

</html>