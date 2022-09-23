<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel=" stylesheet" href=" ./style.css">

</head>

<body class="pb-5">
    <!-- Header -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="margin-bottom:90px;">
        <div class="container">
            <a class="navbar-brand" href="#">Hospital Manager</a>
        </div>
    </nav>

    <!-- Hero -->
    <div class="container my-5">
        <div class="row p-4  pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg justify-content-around">
            <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                <h1 class="display-4 fw-bold lh-1">Welcome Back!</h1>
                <p class="lead">View the patients records, add new patients and manage them! Don't forget your coffee!</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                    <a href="#records"><button type="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold" style="background-color: #75312D; border:none;">View Patients</button></a>
                    <a href="./create.php"><button type="button" class="btn btn-outline-secondary btn-lg px-4">Add Patient</button></a>
                    <a href="./physicians.php"><button type="button" class="btn btn-outline-secondary btn-lg px-4">Physicians</button></a>
                </div>
            </div>
            <div class="col-lg-4   p-0 overflow-hidden">
                <img class="rounded-lg-3 w-100 " src="./images/hero.svg" alt="">
            </div>
        </div>
    </div>

    <?php
    include 'connect.php';
    $stmt = $conn->prepare(
        "SELECT * FROM patients"
    );
    $stmt->execute();
    $patients = $stmt->fetchAll();
    $ptcount = 0;

    foreach ($patients as $pt) {
        $ptcount++;
    }

    $stmt = $conn->prepare(
        "SELECT * FROM physicians"
    );
    $stmt->execute();
    $physicians = $stmt->fetchAll();
    $phcount = 0;

    foreach ($physicians as $ph) {
        $phcount++;
    }
    ?>
    <!-- stats -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Patients Number</h5>
                                <span class="h2 font-weight-bold mb-0"><?php echo $ptcount ?></span>
                            </div>
                            <div class="col-auto">
                                <i class="fa-sharp fa-solid fa-hospital-user fa-2xl"></i>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Physicians Number</h5>
                                <span class="h2 font-weight-bold mb-0"><?php echo $phcount ?></span>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-user-doctor fa-2xl"></i>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Divider -->
    <div class="divider div-transparent div-dot mb-5"></div>
    <h2 class="text-center">Patients Records</h2>


    <!-- Table -->
    <div id="records" class=" container mt-5 mb-5">
        <div class="row">
            <div class="col-md-offset-1 col-md-10" style="margin: auto">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="row justify-content-around">
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <a href="create.php" class="btn btn-sm btn-primary pull-left"><i class="fa fa-plus-circle"></i> Add New</a>

                            </div>
                            <a href="index.php" class="col-lg-1 btn btn-sm btn-success" style="width:4%; border-radius:10px"><i class="fa-solid fa-arrows-rotate"></i></a>
                            <form class="col-lg-4  col-sm-12 col-xs-12 d-flex" role="search" method="post" action="index.php">
                                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success" name="submit" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                    <div class="panel-body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Action</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php


                                foreach ($patients as $pt) {
                                    if (isset($_POST['submit'])) {
                                        $searchname = $_POST['search'];
                                        if ($searchname == $pt['patientName'] || $searchname == $pt['patientAge'] || $searchname == $pt['patientId'] || $searchname == $pt['patientAddress']) {


                                ?>
                                            <tr>
                                                <td><?php echo $pt['patientId']; ?></td>
                                                <td><?php echo $pt['patientName']; ?></td>
                                                <td><?php echo $pt['patientAge']; ?></td>
                                                <td>
                                                    <ul class="action-list">
                                                        <li><a href="./update.php?patientId=<?php echo $pt['patientId']; ?>" class="btn btn-primary" style="background-color:#1e2367; border:none"><i class="fa fa-pencil-alt"></i></a></li>
                                                        <li><a href="./delete.php?patientId=<?php echo $pt['patientId']; ?>" class="btn btn-danger" style="background-color:#75312D; border:none"><i class="fa fa-times"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><a href="./view.php?patientId=<?php echo $pt['patientId']; ?>" class="btn btn-sm btn-success"><i class="fa-solid fa-eye"></i></a></td>

                                            </tr>

                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td><?php echo $pt['patientId']; ?></td>
                                            <td><?php echo $pt['patientName']; ?></td>
                                            <td><?php echo $pt['patientAge']; ?></td>
                                            <td>
                                                <ul class="action-list">
                                                    <li><a href="./update.php?patientId=<?php echo $pt['patientId']; ?>" class="btn btn-primary" style="background-color:#1e2367; border:none"><i class="fa fa-pencil-alt"></i></a></li>
                                                    <li><a href="./delete.php?patientId=<?php echo $pt['patientId']; ?>" class="btn btn-danger" style="background-color:#75312D; border:none"><i class="fa fa-times"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><a href="./view.php?patientId=<?php echo $pt['patientId']; ?>" class="btn btn-sm btn-success"><i class="fa-solid fa-eye"></i></a></td>

                                        </tr>
                                <?php
                                    }
                                } ?>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>



</body>

</html>