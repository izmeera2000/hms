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
                    <!-- <div class="position-relative">
                        <img class="rounded-circle" src="" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div> -->
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $_SESSION['username']; ?></h6>
                        <span>
                            <?php
if ($_SESSION['level'] == 1) { // if user exists
    echo 'ADMIN';

}
if ($_SESSION['level'] == 2) { // if user exists
    echo 'STUDENT';

}
?>
                        </span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link "><i
                            class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Elements</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="button.html" class="dropdown-item">Buttons</a>
                            <a href="typography.html" class="dropdown-item">Typography</a>
                            <a href="element.html" class="dropdown-item">Other Elements</a>
                        </div>
                    </div>
                    <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a>
                    <a href="form.html" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Forms</a>
                    <a href="table.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
                    <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
                    <div class="nav-item dropdown"> -->
                    <?php
if ($_SESSION['level'] == 1) { // if user exists
?>
                    <div class="nav-item dropdown ">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i
                                class="fa fa-home"></i>Hostel</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="hostel.php?h=a" class="dropdown-item">Hostel A</a>
                            <a href="hostel.php?h=b" class="dropdown-item">Hostel B</a>
                            <a href="hostel.php?h=c " class="dropdown-item">Hostel C</a>
                            <a href="hostel.php?h=d" class="dropdown-item">Hostel D</a>
                        </div>
                    </div>
                    <a href="studentlist.php" class="nav-item nav-link "><i
                            class="fa fa-tachometer-alt me-2"></i>Student List</a>
                    <?php
}

?>
                    <!-- <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a> -->
                    <!-- <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item">Blank Page</a>
                        </div> -->
                    <!-- </div> -->
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
                <!-- <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form> -->
                <div class="navbar-nav align-items-center ms-auto">
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div> -->
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div> -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <!-- <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;"> -->
                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['username']; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <!-- <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a> -->
                            <a href="?logout='1'" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <!-- <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Sale</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Sale</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Revenue</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Revenue</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- Sale & Revenue End -->


            <!-- Sales Chart Start -->
            <!-- <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Worldwide Sales</h6>
                                <a href="">Show All</a>
                            </div>
                            <canvas id="worldwide-sales"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Salse & Revenue</h6>
                                <a href="">Show All</a>
                            </div>
                            <canvas id="salse-revenue"></canvas>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- Sales Chart End -->



            <?php
if ($_GET['h'] == 'a') { // if user exists
?>

            <div class="container-fluid pt-4 px-4">
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


                </div>
            </div>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <?php
    $queryc = "SELECT * FROM room WHERE room_num LIKE '%a1__%' ORDER BY room_num DESC  ";
    $resultsc = mysqli_query($db, $queryc);
    while ($rowb = mysqli_fetch_assoc($resultsc)) {



        if ($rowb['occ'] == 0) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="bg-light rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">Empty Room</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            
        }
        if ($rowb['occ'] == 1) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-warning rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-warning">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';


        }
        if ($rowb['occ'] == 2) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-danger rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-danger">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '<h6 class="mb-0">'.$rowb['room_occ2'].' </h6>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }


    }

?>
                </div>
            </div>
        
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <?php
    $queryc = "SELECT * FROM room WHERE room_num LIKE '%a2__%' ORDER BY room_num DESC  ";
    $resultsc = mysqli_query($db, $queryc);
    while ($rowb = mysqli_fetch_assoc($resultsc)) {



        if ($rowb['occ'] == 0) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="bg-light rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">Empty Room</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            
        }
        if ($rowb['occ'] == 1) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-warning rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-warning">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';


        }
        if ($rowb['occ'] == 2) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-danger rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-danger">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '<h6 class="mb-0">'.$rowb['room_occ2'].' </h6>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }


    }

?>
                </div>
            </div>
       
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <?php
    $queryc = "SELECT * FROM room WHERE room_num LIKE '%a3__%' ORDER BY room_num DESC  ";
    $resultsc = mysqli_query($db, $queryc);
    while ($rowb = mysqli_fetch_assoc($resultsc)) {



        if ($rowb['occ'] == 0) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="bg-light rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">Empty Room</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            
        }
        if ($rowb['occ'] == 1) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-warning rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-warning">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';


        }
        if ($rowb['occ'] == 2) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-danger rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-danger">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '<h6 class="mb-0">'.$rowb['room_occ2'].' </h6>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }


    }

?>
                </div>
            </div>
       
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <?php
    $queryc = "SELECT * FROM room WHERE room_num LIKE '%a4__%' ORDER BY room_num DESC  ";
    $resultsc = mysqli_query($db, $queryc);
    while ($rowb = mysqli_fetch_assoc($resultsc)) {


        if ($rowb['occ'] == 0) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="bg-light rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">Empty Room</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            
        }
        if ($rowb['occ'] == 1) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-warning rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-warning">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';


        }
        if ($rowb['occ'] == 2) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-danger rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-danger">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '<h6 class="mb-0">'.$rowb['room_occ2'].' </h6>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }


    }

?>
                </div>
            </div>
       
            <?php
}
?>

<?php
if ($_GET['h'] == 'b') { // if user exists
?>

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-home fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Hostel B</p>
                                <?php
    $query1b = "SELECT room_num FROM room WHERE room_num LIKE '%b___%' AND occ='1' ";
    $results1b = mysqli_query($db, $query1b);
    $row1b = mysqli_num_rows($results1b);
    $totalb = 0 + $row1b;


    $query2b = "SELECT room_num FROM room WHERE room_num LIKE '%b___%' AND occ='2' ";
    $results2b = mysqli_query($db, $query2b);
    $row2b = mysqli_num_rows($results2b);
    $totalb = $totalb + ($row2b * 2);

    echo '<h6 class="mb-0">' . $totalb . '/100</h6>';
?>


                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <?php
    $queryb = "SELECT * FROM room WHERE room_num LIKE '%b1__%' ORDER BY room_num DESC  ";
    $resultsb = mysqli_query($db, $queryb);
    while ($rowb = mysqli_fetch_assoc($resultsb)) {



        if ($rowb['occ'] == 0) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="bg-light rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">Empty Room</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            
        }
        if ($rowb['occ'] == 1) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-warning rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-warning">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';


        }
        if ($rowb['occ'] == 2) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-danger rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-danger">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '<h6 class="mb-0">'.$rowb['room_occ2'].' </h6>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }

    }

?>
                </div>
            </div>
        
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <?php
    $queryc = "SELECT * FROM room WHERE room_num LIKE '%b2__%' ORDER BY room_num DESC  ";
    $resultsc = mysqli_query($db, $queryc);
    while ($rowb = mysqli_fetch_assoc($resultsc)) {



        if ($rowb['occ'] == 0) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="bg-light rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">Empty Room</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            
        }
        if ($rowb['occ'] == 1) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-warning rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-warning">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';


        }
        if ($rowb['occ'] == 2) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-danger rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-danger">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '<h6 class="mb-0">'.$rowb['room_occ2'].' </h6>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }


    }

?>
                </div>
            </div>
        
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <?php
    $queryc = "SELECT * FROM room WHERE room_num LIKE '%b3__%' ORDER BY room_num DESC  ";
    $resultsc = mysqli_query($db, $queryc);
    while ($rowb = mysqli_fetch_assoc($resultsc)) {



        if ($rowb['occ'] == 0) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="bg-light rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">Empty Room</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            
        }
        if ($rowb['occ'] == 1) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-warning rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-warning">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';


        }
        if ($rowb['occ'] == 2) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-danger rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-danger">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '<h6 class="mb-0">'.$rowb['room_occ2'].' </h6>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }


    }

?>
                </div>
            </div>
        
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <?php
    $queryc = "SELECT * FROM room WHERE room_num LIKE '%b4__%' ORDER BY room_num DESC  ";
    $resultsc = mysqli_query($db, $queryc);
    while ($rowb = mysqli_fetch_assoc($resultsc)) {



        if ($rowb['occ'] == 0) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="bg-light rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">Empty Room</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            
        }
        if ($rowb['occ'] == 1) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-warning rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-warning">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';


        }
        if ($rowb['occ'] == 2) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-danger rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-danger">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '<h6 class="mb-0">'.$rowb['room_occ2'].' </h6>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }

    }

?>
                </div>
            </div>
        
         
         <?php
}
?>

<?php
if ($_GET['h'] == 'c') { // if user exists
?>

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-home fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Hostel C</p>
                                <?php
    $query1c = "SELECT room_num FROM room WHERE room_num LIKE '%c___%' AND occ='1' ";
    $results1c = mysqli_query($db, $query1c);
    $row1c = mysqli_num_rows($results1c);
    $totalc = 0 + $row1c;


    $query2c = "SELECT room_num FROM room WHERE room_num LIKE '%c___%' AND occ='2' ";
    $results2c = mysqli_query($db, $query2c);
    $row2c = mysqli_num_rows($results2c);
    $totalc = $totalc + ($row2c * 2);

    echo '<h6 class="mb-0">' . $totalc . '/100</h6>';
?>


                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <?php
    $queryc = "SELECT * FROM room WHERE room_num LIKE '%c1__%' ORDER BY room_num DESC  ";
    $resultsc = mysqli_query($db, $queryc);
    while ($rowb = mysqli_fetch_assoc($resultsc)) {


        if ($rowb['occ'] == 0) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="bg-light rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">Empty Room</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            
        }
        if ($rowb['occ'] == 1) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-warning rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-warning">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';


        }
        if ($rowb['occ'] == 2) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-danger rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-danger">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '<h6 class="mb-0">'.$rowb['room_occ2'].' </h6>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }


    }

?>
                </div>
            </div>
            
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <?php
    $queryc = "SELECT * FROM room WHERE room_num LIKE '%c2__%' ORDER BY room_num DESC  ";
    $resultsc = mysqli_query($db, $queryc);
    while ($rowb = mysqli_fetch_assoc($resultsc)) {



        if ($rowb['occ'] == 0) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="bg-light rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">Empty Room</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            
        }
        if ($rowb['occ'] == 1) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-warning rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-warning">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';


        }
        if ($rowb['occ'] == 2) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-danger rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-danger">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '<h6 class="mb-0">'.$rowb['room_occ2'].' </h6>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }

    }

?>
                </div>
            </div>
           
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <?php
    $queryc = "SELECT * FROM room WHERE room_num LIKE '%c3__%' ORDER BY room_num DESC  ";
    $resultsc = mysqli_query($db, $queryc);
    while ($rowb = mysqli_fetch_assoc($resultsc)) {


        if ($rowb['occ'] == 0) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="bg-light rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">Empty Room</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            
        }
        if ($rowb['occ'] == 1) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-warning rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-warning">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';


        }
        if ($rowb['occ'] == 2) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-danger rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-danger">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '<h6 class="mb-0">'.$rowb['room_occ2'].' </h6>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }


    }

?>
                </div>
            </div>
           
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <?php
    $queryc = "SELECT * FROM room WHERE room_num LIKE '%c4__%' ORDER BY room_num DESC  ";
    $resultsc = mysqli_query($db, $queryc);
    while ($rowb = mysqli_fetch_assoc($resultsc)) {


        if ($rowb['occ'] == 0) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="bg-light rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">Empty Room</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            
        }
        if ($rowb['occ'] == 1) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-warning rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-warning">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';


        }
        if ($rowb['occ'] == 2) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-danger rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-danger">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '<h6 class="mb-0">'.$rowb['room_occ2'].' </h6>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }


    }

?>
                </div>
            </div>
           
            <?php
}
?>


<?php
if ($_GET['h'] == 'd') { // if user exists
?>

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-home fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Hostel D</p>
                                <?php
    $query1d = "SELECT room_num FROM room WHERE room_num LIKE '%d___%' AND occ='1' ";
    $results1d = mysqli_query($db, $query1d);
    $row1d = mysqli_num_rows($results1d);
    $totald = 0 + $row1d;


    $query2d = "SELECT room_num FROM room WHERE room_num LIKE '%d___%' AND occ='2' ";
    $results2d = mysqli_query($db, $query2d);
    $row2d = mysqli_num_rows($results2d);
    $totald = $totald + ($row2d * 2);

    echo '<h6 class="mb-0">' . $totald . '/100</h6>';
?>


                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <?php
    $queryd = "SELECT * FROM room WHERE room_num LIKE '%d1__%' ORDER BY room_num DESC  ";
    $resultsd = mysqli_query($db, $queryd);
    while ($rowb = mysqli_fetch_assoc($resultsd)) {
        if ($rowb['occ'] == 0) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="bg-light rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">Empty Room</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            
        }
        if ($rowb['occ'] == 1) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-warning rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-warning">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';


        }
        if ($rowb['occ'] == 2) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-danger rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-danger">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '<h6 class="mb-0">'.$rowb['room_occ2'].' </h6>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }




    }

?>
                </div>
            </div>
            
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <?php
    $queryd = "SELECT * FROM room WHERE room_num LIKE '%d2__%' ORDER BY room_num DESC  ";
    $resultsd = mysqli_query($db, $queryd);
    while ($rowb = mysqli_fetch_assoc($resultsd)) {
        if ($rowb['occ'] == 0) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="bg-light rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">Empty Room</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            
        }
        if ($rowb['occ'] == 1) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-warning rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-warning">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';


        }
        if ($rowb['occ'] == 2) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-danger rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-danger">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '<h6 class="mb-0">'.$rowb['room_occ2'].' </h6>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }




    }

?>
                </div>
            </div>
            
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <?php
    $queryd = "SELECT * FROM room WHERE room_num LIKE '%d3__%' ORDER BY room_num DESC  ";
    $resultsd = mysqli_query($db, $queryd);
    while ($rowb = mysqli_fetch_assoc($resultsd)) {
        if ($rowb['occ'] == 0) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="bg-light rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">Empty Room</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            
        }
        if ($rowb['occ'] == 1) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-warning rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-warning">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';


        }
        if ($rowb['occ'] == 2) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-danger rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-danger">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '<h6 class="mb-0">'.$rowb['room_occ2'].' </h6>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }




    }

?>
                </div>
            </div>
            
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <?php
    $queryd = "SELECT * FROM room WHERE room_num LIKE '%d4__%' ORDER BY room_num DESC  ";
    $resultsd = mysqli_query($db, $queryd);
    while ($rowb = mysqli_fetch_assoc($resultsd)) {
        if ($rowb['occ'] == 0) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="bg-light rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">Empty Room</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            
        }
        if ($rowb['occ'] == 1) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-warning rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-warning">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';


        }
        if ($rowb['occ'] == 2) {
            echo '<div class="col-sm-6 col-xl-3 ">';
            echo '<div class="btn-danger rounded d-flex align-items-center justify-content-between p-4" data-bs-toggle="modal" data-bs-target="#exampleModal-'.$rowb['room_num'].' "> ';
            echo '<div class="ms-3 ">';
            echo '<p class="mb-0">' . $rowb['room_num'] . '</p>';
            echo '<h6 class="mb-0">' . $rowb['occ'] . '</h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="modal fade" id="exampleModal-'.$rowb['room_num'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header bg-danger">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Room '.$rowb['room_num'].' Details</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h6 class="mb-0">'.$rowb['room_occ1'].' </h6>';
            echo '<h6 class="mb-0">'.$rowb['room_occ2'].' </h6>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }




    }

?>
                </div>
            </div>
            
            <?php
}
?>



<?php 


?>

            <!-- Recent Sales End -->


            <!-- Widgets Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <!-- <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="mb-0">Messages</h6>
                                <a href="">Show All</a>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center pt-3">
                                <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Calender</h6> -->
                    <!-- <a href="">Show All</a> -->
                    <!-- </div>
                            <div id="calender"></div>
                        </div>
                    </div> -->


                    <!-- <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">To Do List</h6>
                                <a href="">Show All</a>
                            </div>
                            <div class="d-flex mb-2">
                                <input class="form-control bg-transparent" type="text" placeholder="Enter task">
                                <button type="button" class="btn btn-primary ms-2">Add</button>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Short task goes here...</span>
                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Short task goes here...</span>
                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox" checked>
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span><del>Short task goes here...</del></span>
                                        <button class="btn btn-sm text-primary"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Short task goes here...</span>
                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center pt-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Short task goes here...</span>
                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    
                </div>

            </div>
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