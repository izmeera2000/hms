<?php
session_start();
use setasign\Fpdi\Fpdi;
date_default_timezone_set("Asia/Kuala_Lumpur");

// initializing variables
$username = "";
$email = "";
$errors = array();


// connect to the database
//$db = mysqli_connect('localhost', 'id19282315_user', 'RLK9LDV&zKHQK~I4', 'id19282315_hms','3306'); //for uploaded to 000webhost
$db = mysqli_connect('localhost', 'root', '', 'id19012707_hms');
// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
    $password_3 = mysqli_real_escape_string($db, $_POST['password_3']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user) { // if user exists
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($user['email'] === $email) {
            array_push($errors, "email already exists");
        }

    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1); //encrypt the password before saving in the database
        if ($password_3 == "adtectaiping33") {
            $level = '1';
        }
        else {
            $level = '2';

        }
        $query = "INSERT INTO users (level, username, email, password) 
  			  VALUES(' $level','$username', '$email', '$password')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['level'] = $level;

        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
    }
}
// LOGIN USER
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password' ";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            while ($row = mysqli_fetch_assoc($results)) {

                $_SESSION['level'] = $row['level'];


            }
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        }
        else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}

if (isset($_POST['pdf'])) {
    require_once('lib/fpdf/fpdf.php');
    require_once('lib/fpdi/src/autoload.php');

    $username = $_SESSION['username'];
    $query = "SELECT * FROM application WHERE username='$username'  ";
    $results = mysqli_query($db, $query);
    while ($row = mysqli_fetch_assoc($results)) {



        $room_number = $row['room_num'];
        $bed_number = $row['bed_num'];
        $ndp = $row['ndp'];
        $name = $row['name'];
        $image = $row['image'];
        $ic = $row['ic'];
        $coursecode = $row['coursecode'];
        $course = $row['course'];
        $session_num = $row['adm_date'];        
        $sem = $row['sem'];
        $rkey = $row['rkey'];



        $gender = $row['rgender'];
        $race = $row['rrace'];
        $religion = $row['rreligion'];


        $fathern = $row['rfname'];
        $fatherc = $row['rfcareer'];
        $fatherp = $row['rfphonenum'];

        $mothern = $row['rmname'];
        $motherc = $row['rmcareer'];
        $motherp = $row['rmphonenum'];

        $address = $row['raddress'];

        $phonen = $row['rphonenum'];
        $hphonen = $row['rhomephonenum'];        
        $b = html_entity_decode('&#10003;', ENT_HTML401,'ISO-8859-1');
    }
    // initiate FPDI
    $pdf = new Fpdi();

    // get the page count
    $pdf->setSourceFile('doc/combinepdf3.pdf');
    // iterate through all pages
    $pdf->SetTitle($ndp . ' Application Form');
    $pdf->SetCreator('ADTEC Taiping');
    $pdf->SetSubject('Hostel Application Form');

    $templateId = $pdf->importPage(1);

    $pdf->AddPage();
    // use the imported page and adjust the page size
    $pdf->useTemplate($templateId, ['adjustPageSize' => true]);

    $pdf->SetFont('Arial', '', 11);

    $pdf->SetXY(58, 71.3);
    if ($room_number == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $room_number);

    }
    $pdf->SetXY(132, 71.3);

    if ($bed_number == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $bed_number);

    }
    $pdf->Image($image, 157, 75, 35, 'JPG');

    $pdf->SetXY(58, 79);
    $pdf->Write(8, $ndp);

    $pdf->SetXY(58, 87);
    $pdf->Write(8, $name);

    $pdf->SetXY(58, 94.5);
    $pdf->Write(8, $ic);

    $pdf->SetXY(58, 102.5);
    $pdf->Write(8, $coursecode);

    $pdf->SetXY(132, 102.5);
    $pdf->Write(8, $session_num);

    if ($rkey== 1) {
        $pdf->SetXY(106, 137.5);
        $pdf->Write(8, '/');
    }




    $templateId = $pdf->importPage(2);
    $pdf->AddPage();
    $pdf->useTemplate($templateId, ['adjustPageSize' => true]);

    $pdf->SetFont('Arial', '', 11);

    $pdf->SetXY(70, 31.3);
    $pdf->Write(8, $name);

    $pdf->SetXY(70, 39.3);
    $pdf->Write(8, $gender);

    $pdf->SetXY(70, 47.3);
    $pdf->Write(8, $race);

    $pdf->SetXY(70, 55.3);
    $pdf->Write(8, $religion);

    $pdf->SetXY(70, 63.3);
    $pdf->Write(8, $fathern);

    $pdf->SetXY(70, 71.3);
    $pdf->Write(8, $fatherc);

    $pdf->SetXY(70, 80.3);
    $pdf->Write(8, $fatherp);


    $pdf->SetXY(70, 88.3);
    $pdf->Write(8, $mothern);

    $pdf->SetXY(70, 96.3);
    $pdf->Write(8, $motherc);

    $pdf->SetXY(70, 104.3);
    $pdf->Write(8, $motherp);


    $pdf->SetXY(70, 111.3);
    $pdf->Write(8, $address);

    $pdf->SetXY(70, 136.3);
    $pdf->Write(8, $phonen);

    $pdf->SetXY(70, 144.3);
    $pdf->Write(8, $hphonen);

    $pdf->SetXY(70, 152.3);
    $pdf->Write(8, $course);
    $pdf->SetXY(70, 160.3);
    $pdf->Write(8, $sem);


    $pdf->Output('I', $ndp . '-form.pdf');
    exit;




}

if (isset($_POST['pdf2'])) {
    require_once('lib/fpdf/fpdf.php');
    require_once('lib/fpdi/src/autoload.php');

    $id = $_POST['id'];
    $query = "SELECT * FROM application WHERE id='$id'  ";
    $results = mysqli_query($db, $query);
    while ($row = mysqli_fetch_assoc($results)) {

        $room_number = $row['room_num'];
        $bed_number = $row['bed_num'];
        $ndp = $row['ndp'];
        $name = $row['name'];
        $ic = $row['ic'];
        $course = $row['course'];
        $session_num = $row['adm_date'];

        $gender = $row['rgender'];
        $race = $row['rrace'];
        $religion = $row['rreligion'];


        $fathern = $row['rfname'];
        $fatherc = $row['rfcareer'];
        $fatherp = $row['rfphonenum'];

        $mothern = $row['rmname'];
        $motherc = $row['rmcareer'];
        $motherp = $row['rmphonenum'];

        $address = $row['raddress'];

        $phonen = $row['rphonenum'];
        $hphonen = $row['rhomephonenum'];

    }
    // initiate FPDI
    $pdf = new Fpdi();

    // get the page count
    $pdf->setSourceFile('doc/combinepdf2.pdf');
    // iterate through all pages

    $templateId = $pdf->importPage(1);

    $pdf->AddPage();
    // use the imported page and adjust the page size
    $pdf->useTemplate($templateId, ['adjustPageSize' => true]);

    $pdf->SetFont('Arial', '', 11);

    $pdf->SetXY(70, 71.3);
    $pdf->Write(8, $room_number);
    $pdf->SetXY(145, 71.3);
    $pdf->Write(8, $bed_number);

    $pdf->SetXY(70, 79);
    $pdf->Write(8, $ndp);

    $pdf->SetXY(70, 87);
    $pdf->Write(8, $name);

    $pdf->SetXY(70, 94.5);
    $pdf->Write(8, $ic);

    $pdf->SetXY(70, 102.5);
    $pdf->Write(8, $course);

    $pdf->SetXY(145, 102.5);
    $pdf->Write(8, $session_num);

    $pdf->SetXY(145, 102.5);
    $pdf->Write(8, $session_num);

    $templateId = $pdf->importPage(2);
    $pdf->AddPage();
    $pdf->useTemplate($templateId, ['adjustPageSize' => true]);

    $pdf->SetFont('Arial', '', 11);

    $pdf->SetXY(70, 31.3);
    $pdf->Write(8, $name);

    $pdf->SetXY(70, 39.3);
    $pdf->Write(8, $gender);

    $pdf->SetXY(70, 47.3);
    $pdf->Write(8, $race);

    $pdf->SetXY(70, 55.3);
    $pdf->Write(8, $religion);

    $pdf->SetXY(70, 63.3);
    $pdf->Write(8, $fathern);

    $pdf->SetXY(70, 71.3);
    $pdf->Write(8, $fatherc);

    $pdf->SetXY(70, 80.3);
    $pdf->Write(8, $fatherp);


    $pdf->SetXY(70, 88.3);
    $pdf->Write(8, $mothern);

    $pdf->SetXY(70, 96.3);
    $pdf->Write(8, $motherc);

    $pdf->SetXY(70, 104.3);
    $pdf->Write(8, $motherp);


    $pdf->SetXY(70, 111.3);
    $pdf->Write(8, $address);

    $pdf->SetXY(70, 136.3);
    $pdf->Write(8, $phonen);

    $pdf->SetXY(70, 144.3);
    $pdf->Write(8, $hphonen);

    $pdf->SetXY(70, 152.3);
    $pdf->Write(8, $course);
    $pdf->SetXY(70, 160.3);
    $pdf->Write(8, $session_num);
    // Output the new PDF
    $pdf->Output();
}
if (isset($_POST['upload'])) {



    $rkey = 0;
    $rbed = 0;
    $rpillow = 0;
    $rtable = 0;
    $rchair = 0;
    $rcloset = 0;
    $rhanger = 0;
    $rtrashcan = 0;
    $rmat = 0;
    $rcondition = 0;
    $rsource = 0;
    $rdate = 0;
    $rdate2 = 0;
    $room_number = '0';
    $bed_number = 0;

    $image = mysqli_real_escape_string($db, $_POST['address']);
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $ndp = mysqli_real_escape_string($db, $_POST['ndp']);
    $sem = mysqli_real_escape_string($db, $_POST['sem']);
    $phonen = mysqli_real_escape_string($db, $_POST['phonen']);
    $hphonen = mysqli_real_escape_string($db, $_POST['hphonen']);
    $ic = mysqli_real_escape_string($db, $_POST['ic']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);
    $race = mysqli_real_escape_string($db, $_POST['race']);
    $religion = mysqli_real_escape_string($db, $_POST['religion']);
    $coursecode = mysqli_real_escape_string($db, $_POST['coursecode']);
    $course = mysqli_real_escape_string($db, $_POST['course']);
    $session_num = mysqli_real_escape_string($db, $_POST['session_num']);
    $address = mysqli_real_escape_string($db, $_POST['address']);


    // $room_number = mysqli_real_escape_string($db, $_POST['room_number']);
    // $bed_number = mysqli_real_escape_string($db, $_POST['bed_number']);

    $fathern = mysqli_real_escape_string($db, $_POST['fathern']);
    $fatherc = mysqli_real_escape_string($db, $_POST['fatherc']);
    $fatherp = mysqli_real_escape_string($db, $_POST['fatherp']);
    $mothern = mysqli_real_escape_string($db, $_POST['mothern']);
    $motherc = mysqli_real_escape_string($db, $_POST['motherc']);
    $motherp = mysqli_real_escape_string($db, $_POST['motherp']);
    $username = $_SESSION['username'];

    if (!empty($_POST['roomkey'])) {
        $rkey = $_POST['roomkey'];
    }
    if (!empty($_POST['bed'])) {
        $rbed = $_POST['bed'];
    }
    if (!empty($_POST['piilow'])) {
        $rpillow = $_POST['pillow'];
    }
    if (!empty($_POST['table'])) {
        $rtable = $_POST['table'];
    }
    if (!empty($_POST['chair'])) {
        $rchair = $_POST['chair'];
    }
    if (!empty($_POST['closet'])) {
        $rcloset = $_POST['closet'];
    }
    if (!empty($_POST['hanger'])) {
        $rhanger = $_POST['hanger'];
    }
    if (!empty($_POST['trashcan'])) {
        $rtrashcan = $_POST['trashcan'];
    }
    if (!empty($_POST['mat'])) {
        $rmat = $_POST['mat'];
    }

    $target_dir = "img/application/";
    $target_file = $target_dir . $ndp . ".jpg";
    $uploadOk = 1;
    // $rcondition = "";
    // $rsource = "";
    // $rdate = "";
    // $rdate2 = "";
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

        $query = "INSERT INTO application 
(username,phase, ndp,image, sem,room_num,bed_num,name,rgender,rrace,rreligion,rfname,rfcareer,rfphonenum,rmname,rmcareer,rmphonenum,raddress,rhomephonenum,rphonenum,ic,course,coursecode,adm_Date,rkey,rbed,rpillow,rtable,rchair,rcloset,rclothhanger,rtrashcan,rmat,rcondition,rsource) 
        VALUES('$username', '1','$ndp','$target_file', '$sem', '$room_number', '$bed_number', '$name', '$gender', '$race', '$religion', '$fathern', '$fatherc', '$fatherp', '$mothern', '$motherc', '$motherp', '$address', '$hphonen', '$phonen', '$ic', '$course','$coursecode', '$session_num', '$rkey', '$rbed', '$rpillow', '$rtable', '$rchair', '$rcloset', '$rhanger', '$rtrashcan', '$rmat', '$rcondition', '$rsource')";
        if (mysqli_query($db, $query)) {
            // echo "New record created successfully";
            header('location: index.php');


        }
        else {

            echo $query;
            echo '<script> $("#error").show();</script>';

        }

    // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    }
    else {
        echo 'failb';
        echo '<script> $("#error").show();</script>';


    }

// else {
//     echo "Error: " . $query . "<br>" . mysqli_error($db);
// }


}

if (isset($_POST['uploadpayment'])) {

    $username = $_SESSION['username'];
    $query = "SELECT ndp FROM application WHERE username='$username'  ";

    $results = mysqli_query($db, $query);
    while ($row = mysqli_fetch_assoc($results)) {

        $ndp = $row['ndp'];

        $target_dir = "img/proof/";
        if ($_FILES["image"]["type"] == 'application/pdf') {
            $target_file = $target_dir . $ndp . ".pdf";

        }
        if ($_FILES["image"]["type"] == 'image/jpeg') {
            $target_file = $target_dir . $ndp . ".jpg";

        }
        if ($_FILES["image"]["type"] == 'image/png') {
            $target_file = $target_dir . $ndp . ".png";

        }
        // $rcondition = "";
        // $rsource = "";
        // $rdate = "";
        // $rdate2 = "";
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

            $query2 = "UPDATE application SET phase='2' , rpayment= '$target_file' WHERE username='$username'";

            if (mysqli_query($db, $query2)) {
                echo "New record created successfully";
                header('location: index.php');

            }

        }

    }
}




if (isset($_POST['approve'])) {



    $receipt = $_POST['number'];

    $ndp = $_POST['ndp'];
    $tpaid = $_POST['tpaid'];
    $date = date("d-m-Y");

    $query5 = "SELECT * FROM application WHERE ndp='$ndp'";

    $results5 = mysqli_query($db, $query5);

    while ($row5 = mysqli_fetch_assoc($results5)) {

        $rgender = $row5['rgender'];
        $course = $row5['course'];
        if ($rgender == 'Male') {

            if (strpos($course, 'DTK') !== false) {
                $query3 = "SELECT * FROM room WHERE `room_num` LIKE '%a%' AND (`room_occ1`='0' OR `room_occ2`='0') ORDER BY `room_num` LIMIT 1;";
                $results3 = mysqli_query($db, $query3);

                while ($row3 = mysqli_fetch_assoc($results3)) {
                    $room_number = $row3['room_num'];

                    $occ1 = $row3['room_occ1'];
                    $occ2 = $row3['room_occ2'];

                    if ($occ1 == '0') {

                        $query2 = "UPDATE application SET phase='3' ,room_num='$room_number', rnumber='$receipt', rtotalprice='$tpaid', rpaydate='$date' WHERE ndp='$ndp'";

                        $query6 = "UPDATE room SET room_occ1='$ndp', occ='1' WHERE room_num='$room_number'";


                        if (mysqli_query($db, $query2)) {
                            if (mysqli_query($db, $query6)) {

                            }

                        }
                    }

                    else {

                        $query2 = "UPDATE application SET phase='3' ,room_num='$room_number', rnumber='$receipt', rtotalprice='$tpaid', rpaydate='$date' WHERE ndp='$ndp'";

                        $query6 = "UPDATE room SET room_occ2='$ndp', occ='2' WHERE room_num='$room_number'";


                        if (mysqli_query($db, $query2)) {
                            if (mysqli_query($db, $query6)) {

                            }

                        }
                    }


                }
            }
            if (strpos($course, 'DKM') !== false) {
                $query3 = "SELECT * FROM room WHERE `room_num` LIKE '%b%' AND (`room_occ1`='0' OR `room_occ2`='0') ORDER BY `room_num` LIMIT 1;";
                $results3 = mysqli_query($db, $query3);

                while ($row3 = mysqli_fetch_assoc($results3)) {
                    $room_number = $row3['room_num'];

                    $occ1 = $row3['room_occ1'];
                    $occ2 = $row3['room_occ2'];

                    if ($occ1 == '0') {

                        $query2 = "UPDATE application SET phase='3' ,room_num='$room_number', rnumber='$receipt', rtotalprice='$tpaid', rpaydate='$date' WHERE ndp='$ndp'";

                        $query6 = "UPDATE room SET room_occ1='$ndp', occ='1' WHERE room_num='$room_number'";


                        if (mysqli_query($db, $query2)) {
                            if (mysqli_query($db, $query6)) {

                            }

                        }
                    }

                    else {

                        $query2 = "UPDATE application SET phase='3' ,room_num='$room_number', rnumber='$receipt', rtotalprice='$tpaid', rpaydate='$date' WHERE ndp='$ndp'";

                        $query6 = "UPDATE room SET room_occ2='$ndp', occ='2' WHERE room_num='$room_number'";


                        if (mysqli_query($db, $query2)) {
                            if (mysqli_query($db, $query6)) {

                            }

                        }
                    }


                }
            }

        }

        if ($rgender == 'Female') {

            if (strpos($course, 'DTK') !== false) {
                $query3 = "SELECT * FROM room WHERE `room_num` LIKE '%c%' AND (`room_occ1`='0' OR `room_occ2`='0') ORDER BY `room_num` LIMIT 1;";
                $results3 = mysqli_query($db, $query3);

                while ($row3 = mysqli_fetch_assoc($results3)) {
                    $room_number = $row3['room_num'];

                    $occ1 = $row3['room_occ1'];
                    $occ2 = $row3['room_occ2'];

                    if ($occ1 == '0') {

                        $query2 = "UPDATE application SET phase='3' ,room_num='$room_number', rnumber='$receipt', rtotalprice='$tpaid', rpaydate='$date' WHERE ndp='$ndp'";

                        $query6 = "UPDATE room SET room_occ1='$ndp', occ='1' WHERE room_num='$room_number'";


                        if (mysqli_query($db, $query2)) {
                            if (mysqli_query($db, $query6)) {

                            }

                        }
                    }

                    else {

                        $query2 = "UPDATE application SET phase='3' ,room_num='$room_number', rnumber='$receipt', rtotalprice='$tpaid', rpaydate='$date' WHERE ndp='$ndp'";

                        $query6 = "UPDATE room SET room_occ2='$ndp', occ='2' WHERE room_num='$room_number'";


                        if (mysqli_query($db, $query2)) {
                            if (mysqli_query($db, $query6)) {

                            }

                        }
                    }


                }
            }
            if (strpos($course, 'DKM') !== false) {
                $query3 = "SELECT * FROM room WHERE `room_num` LIKE '%d%' AND (`room_occ1`='0' OR `room_occ2`='0') ORDER BY `room_num` LIMIT 1;";
                $results3 = mysqli_query($db, $query3);

                while ($row3 = mysqli_fetch_assoc($results3)) {
                    $room_number = $row3['room_num'];

                    $occ1 = $row3['room_occ1'];
                    $occ2 = $row3['room_occ2'];

                    if ($occ1 == '0') {

                        $query2 = "UPDATE application SET phase='3' ,room_num='$room_number', rnumber='$receipt', rtotalprice='$tpaid', rpaydate='$date' WHERE ndp='$ndp'";

                        $query6 = "UPDATE room SET room_occ1='$ndp', occ='1' WHERE room_num='$room_number'";


                        if (mysqli_query($db, $query2)) {
                            if (mysqli_query($db, $query6)) {

                            }

                        }
                    }

                    else {

                        $query2 = "UPDATE application SET phase='3' ,room_num='$room_number', rnumber='$receipt', rtotalprice='$tpaid', rpaydate='$date'  WHERE ndp='$ndp'";

                        $query6 = "UPDATE room SET room_occ2='$ndp', occ='2' WHERE room_num='$room_number'";


                        if (mysqli_query($db, $query2)) {
                            if (mysqli_query($db, $query6)) {

                            }

                        }
                    }


                }
            }


        }
    }




// $room_number = $row['room_num'];
// $bed_number = $row['bed_num'];
// $ndp = $row['ndp'];
// $name = $row['name'];
// $ic = $row['ic'];
// $course = $row['course'];
// $session_num = $row['adm_date'];

// $gender = $row['rgender'];
// $race = $row['rrace'];
// $religion = $row['rreligion'];


// $fathern = $row['rfname'];
// $fatherc = $row['rfcareer'];        
// $fatherp = $row['rfphonenum'];

// $mothern = $row['rmname'];
// $motherc = $row['rmcareer'];        
// $motherp = $row['rmphonenum'];

// $address = $row['raddress'];

// $phonen = $row['rphonenum'];
// $hphonen = $row['rhomephonenum'];



}

if (isset($_POST['roomdetails'])) {


    $bed_number = 0;
    $roomkey = 0;
    $bed = 0;
    $pillow = 0;
    $table = 0;
    $chair = 0;
    $closet = 0;
    $hanger = 0;
    $trashcan = 0;
    $mat = 0;

    $bed_number = mysqli_real_escape_string($db, $_POST['bednum']);

    if (!empty($_POST['roomkey'])) {
        $roomkey = mysqli_real_escape_string($db, $_POST['roomkey']);
    }
    if (!empty($_POST['bed'])) {
        $bed = mysqli_real_escape_string($db, $_POST['bed']);
    }
    if (!empty($_POST['pillow'])) {
        $pillow = mysqli_real_escape_string($db, $_POST['pillow']);
    }
    if (!empty($_POST['table'])) {
        $table = mysqli_real_escape_string($db, $_POST['table']);
    }
    if (!empty($_POST['chair'])) {
        $chair = mysqli_real_escape_string($db, $_POST['chair']);
    }
    if (!empty($_POST['closet'])) {
        $closet = mysqli_real_escape_string($db, $_POST['closet']);
    }
    if (!empty($_POST['hanger'])) {
        $hanger = mysqli_real_escape_string($db, $_POST['hanger']);
    }
    if (!empty($_POST['trashcan'])) {
        $trashcan = mysqli_real_escape_string($db, $_POST['trashcan']);
    }
    if (!empty($_POST['mat'])) {
        $mat = mysqli_real_escape_string($db, $_POST['mat']);
    }


    // $room_number = mysqli_real_escape_string($db, $_POST['room_number']);
    // $bed_number = mysqli_real_escape_string($db, $_POST['bed_number']);


    $username = $_SESSION['username'];



    $query2 = "UPDATE application SET phase='4',bed_num ='$bed_number', rkey='$roomkey', rbed='$bed',rpillow='$pillow',rtable='$table',rchair='$chair',rcloset='$closet',rclothhanger='$hanger',rtrashcan='$trashcan',rmat='$mat' WHERE username='$username'";

    if (mysqli_query($db, $query2)) {
        // echo "New record created successfully";
        header('location: index.php');


    }


    // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

    else {
        echo 'failb';
        echo '<script> $("#error").show();</script>';


    }

// else {
//     echo "Error: " . $query . "<br>" . mysqli_error($db);
// }


}

?>