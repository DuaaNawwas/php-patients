<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel=" stylesheet" href=" ./style.css">
</head>

<body>
    <?php
    include 'connect.php';

    $sql1 = "SELECT * FROM patients";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute();
    $patients =   $stmt1->fetchAll();


    $sql = "SELECT * FROM physicians";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $physicians =   $stmt->fetchAll();

    // print_r($physicians);
    ?>
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
    <!-- Hero -->
    <div class="container my-5">
        <div class="row p-4  pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg justify-content-around">
            <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                <h1 class="display-5 fw-bold lh-1">Physicians</h1>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Department</th>
                            <th scope="col">Patients</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($physicians as $physician) {
                        ?>

                            <tr>
                                <th scope="row"><?php echo $physician['physicianid'] ?></th>
                                <td><?php echo $physician['physicianname'] ?></td>
                                <td><?php echo $physician['department'] ?></td>
                                <td>
                                    <?php
                                    foreach ($patients as $pt) {
                                        if ($pt['physicianid'] == $physician['physicianid']) {
                                            echo $pt['patientName'] . ". ";
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4   p-0 overflow-hidden">
                <img class="rounded-lg-3 " src="./images/Lifesavers - Front Desk.png" alt="">
            </div>
        </div>
    </div>

    <!-- divider -->
    <div class="divider div-transparent div-dot mb-5" id="blue"></div>

    <!-- form -->
    <div class="container">
        <h2 class="text-center">Add a new physician</h2>
        <form class="p-4 p-md-5 border rounded-3 bg-light w-50 my-5" style="margin: auto" action="physicians.php" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="phname" id="ph-name" placeholder="John Doe" required />
                <label for="ph-name" class="form-label">Physician Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="phdep" id="ph-dep" placeholder="cardiology" required />
                <label for="ph-dep" class="form-label">Physician Department</label>
            </div>


            <button type="submit" name="submit" class="btn btn-large w-100 " style="background-color: #334c82; border:none; color: white">Submit</button>

        </form>
    </div>


    <?php
    if (isset($_POST['submit'])) {

        try {


            // Create prepared statement
            $sql = "INSERT INTO physicians (physicianname, department) VALUES (:phname, :phdep)";
            $stmt = $conn->prepare($sql);

            // Bind parameters to statement
            $stmt->bindParam(':phname', $_REQUEST['phname']);
            $stmt->bindParam(':phdep', $_REQUEST['phdep']);

            // Execute the prepared statement
            $stmt->execute();
            echo "Records inserted successfully.";
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
    }

    ?>
</body>

</html>