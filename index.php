<?php
include('controller/server.php');

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: signin.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: signin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Hostel Management System</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="manifest" href="manifest.json">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-home"></i>HMS</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $_SESSION['username']; ?></h6>
                        <span>
                            <?php
if ($_SESSION['level'] == 1) {
    echo 'ADMIN';

}
if ($_SESSION['level'] == 2) {
    echo 'STUDENT';

}
?>
                        </span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link active"><i
                            class="fa fa-tachometer-alt me-2"></i>Dashboard</a>

                    <?php
if ($_SESSION['level'] == 1) {
?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-home"></i>Hostel</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="hostel.php?h=a" class="dropdown-item">Hostel A</a>
                            <a href="hostel.php?h=b" class="dropdown-item">Hostel B</a>
                            <a href="hostel.php?h=c " class="dropdown-item">Hostel C</a>
                            <a href="hostel.php?h=d" class="dropdown-item">Hostel D</a>
                        </div>
                    </div>
                    <a href="studentlist.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Student
                        List</a>
                    <?php
}

?>

                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-home"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>

                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['username']; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="?logout='1'" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->





            <?php
if ($_SESSION['level'] == 1) {

?>


            <div class="container-fluid pt-4 px-4">
                <?php if (isset($_SESSION['first'])) {
        echo $_SESSION['first'];
        unset($_SESSION['first']);
    }
?>
                <?php include('errors.php'); ?>

                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-home fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Hostel A</p>
                                <?php
    $query1a = "SELECT room_num FROM room WHERE room_num LIKE '%a___%' AND occ='1' ";
    $results1a = mysqli_query($db, $query1a);
    $row1a = mysqli_num_rows($results1a);
    $totala = 0 + $row1a;


    $query2a = "SELECT room_num FROM room WHERE room_num LIKE '%a___%' AND occ='2' ";
    $results2a = mysqli_query($db, $query2a);
    $row2a = mysqli_num_rows($results2a);
    $totala = $totala + ($row2a * 2);

    echo '<h6 class="mb-0">' . $totala . '/100</h6>';
?>


                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-home fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Hostel B</p>
                                <?php
    $query1a = "SELECT room_num FROM room WHERE room_num LIKE '%b___%' AND occ='1' ";
    $results1a = mysqli_query($db, $query1a);
    $row1a = mysqli_num_rows($results1a);
    $totala = 0 + $row1a;


    $query2a = "SELECT room_num FROM room WHERE room_num LIKE '%b___%' AND occ='2' ";
    $results2a = mysqli_query($db, $query2a);
    $row2a = mysqli_num_rows($results2a);
    $totala = $totala + ($row2a * 2);

    echo '<h6 class="mb-0">' . $totala . '/100</h6>';
?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-home fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Hostel C</p>
                                <?php
    $query1a = "SELECT room_num FROM room WHERE room_num LIKE '%c___%' AND occ='1' ";
    $results1a = mysqli_query($db, $query1a);
    $row1a = mysqli_num_rows($results1a);
    $totala = 0 + $row1a;


    $query2a = "SELECT room_num FROM room WHERE room_num LIKE '%c___%' AND occ='2' ";
    $results2a = mysqli_query($db, $query2a);
    $row2a = mysqli_num_rows($results2a);
    $totala = $totala + ($row2a * 2);

    echo '<h6 class="mb-0">' . $totala . '/100</h6>';
?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-home fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Hostel D</p>
                                <?php
    $query1a = "SELECT room_num FROM room WHERE room_num LIKE '%d___%' AND occ='1' ";
    $results1a = mysqli_query($db, $query1a);
    $row1a = mysqli_num_rows($results1a);
    $totala = 0 + $row1a;


    $query2a = "SELECT room_num FROM room WHERE room_num LIKE '%d___%' AND occ='2' ";
    $results2a = mysqli_query($db, $query2a);
    $row2a = mysqli_num_rows($results2a);
    $totala = $totala + ($row2a * 2);

    echo '<h6 class="mb-0">' . $totala . '/100</h6>';
?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Sale & Revenue End -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">

                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Recent Application</h6>
                        <!-- <a href="">Show All</a> -->
                    </div>

                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">#</th>
                                    <th scope="col-lg-4 col-sm-4">Student</th>
                                    <th scope="col-lg-2 col-sm-2">NDP</th>
                                    <th scope="col-lg-2 col-sm-2">Course</th>
                                    <th scope="col">Application</th>
                                    <th scope="col">Payment</th>
                                    <th scope="col">Approval</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
    $query = "SELECT * FROM application WHERE phase='2'";
    $results = mysqli_query($db, $query);

    if (mysqli_num_rows($results) > 0) {
        while ($row = mysqli_fetch_assoc($results)) {


            echo '<tr>';
            echo '<td>' . $row["id"] . '</td>';
            echo '<td>' . $row["name"] . '</td>';
            echo '<td>' . $row["ndp"] . '</td>';
            echo '<td>' . $row["course"] . '</td>';
            echo '<td><form method="post" action="index.php"><input class="form-check-input m-0" value="' . $row["id"] . '" name="id" type="hidden">
                <button class="btn btn-sm btn-primary" type="submit" name="pdf2">Detail</button></form></td>';
            echo '<td><a href="' . $row["rpayment"] . '"><button class="btn btn-sm btn-primary" >Detail</button><a/>    </td>';

             echo '<td><button type="button" class="btn btn-primary  m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Approve</button></td>';

            echo '</tr>';


            echo '<form method="post" action="index.php#approve1" enctype="multipart/form-data">';
            echo '<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Approval Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<div class="form-floating mb-3">';
            echo '<input type="hidden" name="ndp" value="' . $row["ndp"] . '">';
            echo '<input name="number" type="text" class="form-control" id="floating4" required>';
            echo '<label for="floating4">Receipt Num.</label>';
            echo '</div>';

            echo '<div class="form-floating mb-3">';
            echo '<input name="tpaid" type="text" class="form-control" id="floating41" required>';
            echo '<label for="floating41">Total Paid (RM)</label>';
            echo '</div>';


            echo '<div class="form-floating mb-3">';
            echo '<select class="form-select" name="room_num" id="floatingSelect"';
            echo 'aria-label="Floating label select example">';
            $query15 = "SELECT room_num FROM room WHERE occ='1' OR occ='0' ORDER BY room_num ASC";
            $results15 = mysqli_query($db, $query15);
            echo '<option value=""></option>';

            if (mysqli_num_rows($results15) > 0) {
                while ($row15 = mysqli_fetch_assoc($results15)) {
                    echo '<option value="' . $row15['room_num'] . '">' . $row15['room_num'] . '</option>';

                }
            }
            echo '</select>';
            echo '<label for="floatingSelect">Room Number (optional)</label>';
            echo '</div>';

            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button class="btn btn-sm btn-primary" type="submit" name="approve">Save changes</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</form>';

        }
    }



?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Recent Final Application</h6>
                     </div>

                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">#</th>
                                    <th scope="col-lg-4 col-sm-4">Student</th>
                                    <th scope="col-lg-2 col-sm-2">NDP</th>
                                    <th scope="col-lg-2 col-sm-2">Course</th>
                                    <th scope="col">Application</th>
                                    <th scope="col">Approval</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
    $query = "SELECT * FROM application WHERE phase='4'";
    $results = mysqli_query($db, $query);

    if (mysqli_num_rows($results) > 0) {
        while ($row = mysqli_fetch_assoc($results)) {


            echo '<tr>';
            echo '<td>' . $row["id"] . '</td>';
            echo '<td>' . $row["name"] . '</td>';
            echo '<td>' . $row["ndp"] . '</td>';
            echo '<td>' . $row["course"] . '</td>';
            echo '<td><form method="post" action="index.php"><input class="form-check-input m-0" value="' . $row["id"] . '" name="id" type="hidden">
                <button class="btn btn-sm btn-primary" type="submit" name="pdf">Detail</button></form></td>';

            echo '<td><form method="post" action="index.php"><input class="form-check-input m-0" value="' . $row["ndp"] . '" name="ndp" type="hidden">
                <button class="btn btn-sm btn-primary" type="submit" name="approve2">Approve</button></form></td>';



        }
    }



?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
}
?>
            <!-- Recent Sales End -->

            <!-- modal start-->


            <!-- Widgets Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">



                    <?php
if ($_SESSION['level'] == 2) {
    include('errors.php')

?>
                    <?php if (isset($_SESSION['first'])) {
        echo $_SESSION['first'];
        unset($_SESSION['first']);
    }
?>


                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">To Do List</h6>
                            </div>
                            <?php

    $username2 = $_SESSION['username'];
    $query = "SELECT * FROM application WHERE username= '$username2' ";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {

        while ($row = mysqli_fetch_assoc($results)) {

            $phase = $row['phase'];


            if ($phase == 1) {

                array_push($errors, '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i>Success
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');




?>
                            <form method="post" action="applyform.php">

                                <div class="d-flex align-items-center border-bottom py-2">
                                    <input class="form-check-input m-0" disabled="disabled" checked="checked"
                                        type="checkbox">
                                    <div class="w-100 ms-3">
                                        <div class="d-flex w-100 align-items-center justify-content-between">
                                            <span>Apply for Hostel</span>
                                            <button name="pdf" type="submit" class="btn btn-sm btn-primary">See
                                                PDF</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" disabled="disabled" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Pay for Hostel</span>
                                        <a name="pay" class="btn btn-sm btn-primary" href="payment.php">
                                            Pay
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" disabled="disabled" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Approved</span>
                                    </div>
                                </div>
                            </div>
                            <?php

            }

            if ($phase == 2) {
?>
                            <form method="post" action="applyform.php">

                                <div class="d-flex align-items-center border-bottom py-2">
                                    <input class="form-check-input m-0" disabled="disabled" checked="checked"
                                        type="checkbox">
                                    <div class="w-100 ms-3">
                                        <div class="d-flex w-100 align-items-center justify-content-between">
                                            <span>Apply for Hostel</span>
                                            <button name="pdf" type="submit" class="btn btn-sm btn-primary">See
                                                PDF</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" disabled="disabled" type="checkbox"
                                    checked="checked">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Pay for Hostel</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" disabled="disabled" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Approved</span>
                                    </div>
                                </div>
                            </div>
                            <?php


            }

            if ($phase == 3) {
?>

                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" disabled="disabled" checked="checked"
                                    type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Apply for Hostel</span>

                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" disabled="disabled" type="checkbox"
                                    checked="checked">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Pay for Hostel</span>
                                    </div>
                                </div>
                            </div>
                            <form method="post" action="#form">

                                <div class="d-flex align-items-center border-bottom py-2">
                                    <input class="form-check-input m-0" disabled="disabled" checked="checked"
                                        type="checkbox">
                                    <div class="w-100 ms-3">
                                        <div class="d-flex w-100 align-items-center justify-content-between">
                                            <span>Approved</span>
                                            <button name="pdf" type="submit" class="btn btn-sm btn-primary">See
                                                PDF</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form method="post" action="#form">

                                <div class="d-flex align-items-center border-bottom py-2">
                                    <input class="form-check-input m-0" disabled="disabled" type="checkbox">
                                    <div class="w-100 ms-3">
                                        <div class="d-flex w-100 align-items-center justify-content-between">
                                            <span>Room Details</span>
                                            <a name="roomdetails" class="btn btn-sm btn-primary"
                                                href="roomdetails.php">Insert</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php


            }
            if ($phase == 4) {
?>

                <div class="d-flex align-items-center border-bottom py-2">
                    <input class="form-check-input m-0" disabled="disabled" checked="checked" type="checkbox">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <span>Apply for Hostel</span>

                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center border-bottom py-2">
                    <input class="form-check-input m-0" disabled="disabled" type="checkbox" checked="checked">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <span>Pay for Hostel</span>
                        </div>
                    </div>
                </div>
                <form method="post" action="#form">

                    <div class="d-flex align-items-center border-bottom py-2">
                        <input class="form-check-input m-0" disabled="disabled" checked="checked" type="checkbox">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <span>Approved</span>
                                <button name="pdf" type="submit" class="btn btn-sm btn-primary">See
                                    PDF</button>
                            </div>
                        </div>
                    </div>
                </form>
                <form method="post" action="#form">

                    <div class="d-flex align-items-center border-bottom py-2">
                        <input class="form-check-input m-0" disabled="disabled" checked="checked" type="checkbox">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <span>Room Details</span>
                                <a name="roomdetails" class="btn btn-sm btn-primary" href="roomdetails.php">Update</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php


            }
            if ($phase == 5) {
?>

    <div class="d-flex align-items-center border-bottom py-2">
        <input class="form-check-input m-0" disabled="disabled" checked="checked" type="checkbox">
        <div class="w-100 ms-3">
            <div class="d-flex w-100 align-items-center justify-content-between">
                <span>Apply for Hostel</span>

            </div>
        </div>
    </div>

    <div class="d-flex align-items-center border-bottom py-2">
        <input class="form-check-input m-0" disabled="disabled" type="checkbox" checked="checked">
        <div class="w-100 ms-3">
            <div class="d-flex w-100 align-items-center justify-content-between">
                <span>Pay for Hostel</span>
            </div>
        </div>
    </div>
    <form method="post" action="#form">

        <div class="d-flex align-items-center border-bottom py-2">
            <input class="form-check-input m-0" disabled="disabled" checked="checked" type="checkbox">
            <div class="w-100 ms-3">
                <div class="d-flex w-100 align-items-center justify-content-between">
                    <span>Approved</span>
                    <button name="pdf" type="submit" class="btn btn-sm btn-primary">See
                        PDF</button>
                </div>
            </div>
        </div>
    </form>
    <form method="post" action="#form">

        <div class="d-flex align-items-center border-bottom py-2">
            <input class="form-check-input m-0" disabled="disabled" checked="checked" type="checkbox">
            <div class="w-100 ms-3">
                <div class="d-flex w-100 align-items-center justify-content-between">
                    <span>Room Details</span>
                </div>
            </div>
        </div>
    </form>
    </div>
    </div>
    </div>
    <?php


            }
        }
    }
    else {
?>
    <div class="d-flex align-items-center border-bottom py-2">
        <input class="form-check-input m-0" disabled="disabled" type="checkbox">
        <div class="w-100 ms-3">
            <div class="d-flex w-100 align-items-center justify-content-between">
                <span>Apply for Hostel</span>
                <a class="btn btn-sm btn-primary" href="applyform.php">Detail</a>
            </div>
        </div>
    </div>
    <?php
    }



?>




    </div>

    </div>



    </div>

    </div>


    <?php
}
?>
    <!-- Widgets End -->





    <!-- Footer Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded-top p-4">
            <div class="row">
                <div class="col-12 col-sm-6 text-center text-sm-start">
                    &copy; <a href="#">HMS</a>, All Right Reserved.
                </div>
                <div class="col-12 col-sm-6 text-center text-sm-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Designed By <a href="#">FourA's</a>
                    </br>
                    Distributed By <a class="border-bottom" href="#" target="_blank">Impeccable Vision</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
    </div>
    <!-- Content End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>

</html>