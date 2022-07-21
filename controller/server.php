<?php
session_start();
use setasign\Fpdi\Fpdi;
date_default_timezone_set("Asia/Kuala_Lumpur");


$username = "";
$email = "";
$errors = array();



//$db = mysqli_connect('localhost', 'id19282315_user', 'RLK9LDV&zKHQK~I4', 'id19282315_hms','3306'); //for uploaded to 000webhost
$db = mysqli_connect('localhost', 'root', '', 'id19012707_hms');

if (isset($_POST['reg_user'])) {

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
    $password_3 = mysqli_real_escape_string($db, $_POST['password_3']);



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



    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
        if ($user['username'] === $username) {
            array_push($errors, '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i>Username already exist
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        }

        if ($user['email'] === $email) {
            array_push($errors, '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i>User with the email already exist
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        }

    }


    if (count($errors) == 0) {
        $password = md5($password_1);
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

        $_SESSION['first'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-exclamation-circle me-2"></i>You have successfully signed in for the first time!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
        header('location: index.php');
    }
}

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa fa-exclamation-circle me-2"></i>Username is required
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>');
    }
    if (empty($password)) {
        array_push($errors, '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa fa-exclamation-circle me-2"></i>Password is required
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>');
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
            array_push($errors, '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i>Wrong password
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
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
        $rbed = $row['rbed'];
        $rpillow = $row['rpillow'];
        $rtable = $row['rtable'];
        $rchair = $row['rchair'];
        $rcloset = $row['rcloset'];
        $rclothhanger = $row['rclothhanger'];
        $rtrashcan = $row['rtrashcan'];
        $rmat = $row['rmat'];

        $rtotalprice = $row['rtotalprice'];
        $rpaydate = $row['rpaydate'];
        $rnumber = $row['rnumber'];


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

        $rcondition = $row['rcondition'];
        $rsource = $row['rsource'];

        $b = html_entity_decode('&#10003;', ENT_HTML401, 'ISO-8859-1');
    }

    $pdf = new Fpdi();


    $pdf->setSourceFile('doc/combinepdf3.pdf');

    $pdf->SetTitle($ndp . ' Application Form');
    $pdf->SetCreator('ADTEC Taiping');
    $pdf->SetSubject('Hostel Application Form');

    $templateId = $pdf->importPage(1);

    $pdf->AddPage();

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

    if ($image != '0') {
        $pdf->Image($image, 157, 75, 35, 'JPG');


    }

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

    if ($rkey == 1) {
        $pdf->SetXY(106, 137.5);
        $pdf->Write(8, '/');
    }

    if ($rbed == 1) {
        $pdf->SetXY(106, 142);
        $pdf->Write(8, '/');
    }
    if ($rpillow == 1) {
        $pdf->SetXY(106, 146.5);
        $pdf->Write(8, '/');
    }
    if ($rtable == 1) {
        $pdf->SetXY(106, 151);
        $pdf->Write(8, '/');
    }
    if ($rchair == 1) {
        $pdf->SetXY(106, 155.5);
        $pdf->Write(8, '/');
    }
    if ($rcloset == 1) {
        $pdf->SetXY(106, 160);
        $pdf->Write(8, '/');
    }
    if ($rclothhanger == 1) {
        $pdf->SetXY(106, 164.5);
        $pdf->Write(8, '/');
    }
    if ($rtrashcan == 1) {
        $pdf->SetXY(106, 169);
        $pdf->Write(8, '/');
    }
    if ($rmat == 1) {
        $pdf->SetXY(106, 173.5);
        $pdf->Write(8, '/');
    }

    if ($rtotalprice) {
        $pdf->SetXY(86, 250.5);
        $pdf->Write(8, 'RM' . $rtotalprice);
    }

    if ($rnumber) {
        $pdf->SetXY(86, 255.5);
        $pdf->Write(8, $rnumber);
    }
    if ($rpaydate) {
        $pdf->SetXY(86, 260.5);
        $pdf->Write(8, $rpaydate);
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
    if ($race == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $race);

    }
    $pdf->SetXY(70, 55.3);
    if ($religion == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $religion);

    }
    $pdf->SetXY(70, 63.3);
    if ($fathern == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $fathern);

    }
    $pdf->SetXY(70, 71.3);
    if ($fatherc == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $fatherc);

    }
    $pdf->SetXY(70, 80.3);
    if ($fatherp == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $fatherp);

    }

    $pdf->SetXY(70, 88.3);
    if ($mothern == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $mothern);

    }
    $pdf->SetXY(70, 96.3);
    if ($motherc == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $motherc);

    }
    $pdf->SetXY(70, 104.3);
    if ($motherp == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $motherp);

    }

    if ($address == '0') {
        $pdf->SetXY(70, 112.3);

        $pdf->Write(8, '-');

    }
    else {
        $das = str_split($address, 50);
        $rownumber = count($das);

        if ($rownumber == 3) {
            $pdf->SetXY(70, 112.3);
            $pdf->Write(8, $das[0]);

            $pdf->SetXY(70, 120.3);
            $pdf->Write(8, $das[1]);

            $pdf->SetXY(70, 128.3);
            $pdf->Write(8, $das[2]);
        }
        if ($rownumber == 2) {
            $pdf->SetXY(70, 112.3);
            $pdf->Write(8, $das[0]);

            $pdf->SetXY(70, 120.3);
            $pdf->Write(8, $das[1]);
        }
        if ($rownumber == 1) {
            $pdf->SetXY(70, 112.3);
            $pdf->Write(8, $das[0]);
        }
    }


    $pdf->SetXY(70, 136.3);
    if ($phonen == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $phonen);

    }
    $pdf->SetXY(70, 144.3);
    if ($hphonen == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $hphonen);

    }
    $pdf->SetXY(70, 152.3);
    $pdf->Write(8, $course);
    $pdf->SetXY(70, 160.3);
    $pdf->Write(8, $sem);

    $pdf->SetXY(110, 185.3);
    if ($rcondition == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $rcondition);

    }
    $pdf->SetXY(110, 190.3);
    if ($rsource == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $rsource);

    }
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
        $image = $row['image'];
        $ic = $row['ic'];
        $coursecode = $row['coursecode'];
        $course = $row['course'];
        $session_num = $row['adm_date'];
        $sem = $row['sem'];

        $rkey = $row['rkey'];
        $rbed = $row['rbed'];
        $rpillow = $row['rpillow'];
        $rtable = $row['rtable'];
        $rchair = $row['rchair'];
        $rcloset = $row['rcloset'];
        $rclothhanger = $row['rclothhanger'];
        $rtrashcan = $row['rtrashcan'];
        $rmat = $row['rmat'];

        $rtotalprice = $row['rtotalprice'];
        $rpaydate = $row['rpaydate'];
        $rnumber = $row['rnumber'];


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

        $rcondition = $row['rcondition'];
        $rsource = $row['rsource'];

        $b = html_entity_decode('&#10003;', ENT_HTML401, 'ISO-8859-1');
    }

    $pdf = new Fpdi();


    $pdf->setSourceFile('doc/combinepdf3.pdf');

    $pdf->SetTitle($ndp . ' Application Form');
    $pdf->SetCreator('ADTEC Taiping');
    $pdf->SetSubject('Hostel Application Form');

    $templateId = $pdf->importPage(1);

    $pdf->AddPage();

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
    if ($image != '0') {
        $pdf->Image($image, 157, 75, 35, 'JPG');


    }
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

    if ($rkey == 1) {
        $pdf->SetXY(106, 137.5);
        $pdf->Write(8, '/');
    }

    if ($rbed == 1) {
        $pdf->SetXY(106, 142);
        $pdf->Write(8, '/');
    }
    if ($rpillow == 1) {
        $pdf->SetXY(106, 146.5);
        $pdf->Write(8, '/');
    }
    if ($rtable == 1) {
        $pdf->SetXY(106, 151);
        $pdf->Write(8, '/');
    }
    if ($rchair == 1) {
        $pdf->SetXY(106, 155.5);
        $pdf->Write(8, '/');
    }
    if ($rcloset == 1) {
        $pdf->SetXY(106, 160);
        $pdf->Write(8, '/');
    }
    if ($rclothhanger == 1) {
        $pdf->SetXY(106, 164.5);
        $pdf->Write(8, '/');
    }
    if ($rtrashcan == 1) {
        $pdf->SetXY(106, 169);
        $pdf->Write(8, '/');
    }
    if ($rmat == 1) {
        $pdf->SetXY(106, 173.5);
        $pdf->Write(8, '/');
    }

    if ($rtotalprice) {
        $pdf->SetXY(86, 250.5);
        $pdf->Write(8, 'RM' . $rtotalprice);
    }

    if ($rnumber) {
        $pdf->SetXY(86, 255.5);
        $pdf->Write(8, $rnumber);
    }
    if ($rpaydate) {
        $pdf->SetXY(86, 260.5);
        $pdf->Write(8, $rpaydate);
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
    if ($race == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $race);

    }
    $pdf->SetXY(70, 55.3);
    if ($religion == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $religion);

    }
    $pdf->SetXY(70, 63.3);
    if ($fathern == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $fathern);

    }
    $pdf->SetXY(70, 71.3);
    if ($fatherc == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $fatherc);

    }
    $pdf->SetXY(70, 80.3);
    if ($fatherp == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $fatherp);

    }

    $pdf->SetXY(70, 88.3);
    if ($mothern == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $mothern);

    }
    $pdf->SetXY(70, 96.3);
    if ($motherc == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $motherc);

    }
    $pdf->SetXY(70, 104.3);
    if ($motherp == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $motherp);

    }

    if ($address == '0') {
        $pdf->SetXY(70, 112.3);

        $pdf->Write(8, '-');

    }
    else {
        $das = str_split($address, 50);
        $rownumber = count($das);

        if ($rownumber == 3) {
            $pdf->SetXY(70, 112.3);
            $pdf->Write(8, $das[0]);

            $pdf->SetXY(70, 120.3);
            $pdf->Write(8, $das[1]);

            $pdf->SetXY(70, 128.3);
            $pdf->Write(8, $das[2]);
        }
        if ($rownumber == 2) {
            $pdf->SetXY(70, 112.3);
            $pdf->Write(8, $das[0]);

            $pdf->SetXY(70, 120.3);
            $pdf->Write(8, $das[1]);
        }
        if ($rownumber == 1) {
            $pdf->SetXY(70, 112.3);
            $pdf->Write(8, $das[0]);
        }
    }


    $pdf->SetXY(70, 136.3);
    if ($phonen == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $phonen);

    }
    $pdf->SetXY(70, 144.3);
    if ($hphonen == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $hphonen);

    }
    $pdf->SetXY(70, 152.3);
    $pdf->Write(8, $course);
    $pdf->SetXY(70, 160.3);
    $pdf->Write(8, $sem);

    $pdf->SetXY(110, 185.3);
    if ($rcondition == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $rcondition);

    }
    $pdf->SetXY(110, 190.3);
    if ($rsource == '0') {
        $pdf->Write(8, '-');

    }
    else {
        $pdf->Write(8, $rsource);

    }
    $pdf->Output('I', $ndp . '-form.pdf');
    exit;





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
    $image = 0;
    $address = 0;
    $race = 0;
    $fathern = 0;
    $fatherc = 0;
    $fatherp = 0;
    $mothern = 0;
    $motherc = 0;
    $motherp = 0;
    $hphonen = 0;
    $phonen = 0;
    $religion = 0;

    $name = mysqli_real_escape_string($db, $_POST['name']);
    $ndp = mysqli_real_escape_string($db, $_POST['ndp']);
    $sem = mysqli_real_escape_string($db, $_POST['sem']);
    $ic = mysqli_real_escape_string($db, $_POST['ic']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);
    $coursecode = mysqli_real_escape_string($db, $_POST['coursecode']);
    $course = mysqli_real_escape_string($db, $_POST['course']);
    $session_num = mysqli_real_escape_string($db, $_POST['session_num']);


    if (!empty($_POST['address'])) {
        $address = mysqli_real_escape_string($db, $_POST['address']);
    }
    if (!empty($_POST['religion'])) {
        $religion = mysqli_real_escape_string($db, $_POST['religion']);
    }
    if (!empty($_POST['image'])) {
        $image = mysqli_real_escape_string($db, $_POST['image']);
    }
    if (!empty($_POST['race'])) {
        $race = mysqli_real_escape_string($db, $_POST['race']);
    }
    if (!empty($_POST['phonen'])) {
        $phonen = mysqli_real_escape_string($db, $_POST['phonen']);
    }
    if (!empty($_POST['hphonen'])) {
        $hphonen = mysqli_real_escape_string($db, $_POST['hphonen']);
    }

    if (!empty($_POST['fathern'])) {
        $fathern = mysqli_real_escape_string($db, $_POST['fathern']);
    }
    if (!empty($_POST['fatherc'])) {
        $fatherc = mysqli_real_escape_string($db, $_POST['fatherc']);
    }
    if (!empty($_POST['fatherp'])) {
        $fatherp = mysqli_real_escape_string($db, $_POST['fatherp']);
    }
    if (!empty($_POST['mothern'])) {
        $mothern = mysqli_real_escape_string($db, $_POST['mothern']);
    }
    if (!empty($_POST['motherc'])) {
        $motherc = mysqli_real_escape_string($db, $_POST['motherc']);
    }
    if (!empty($_POST['motherp'])) {
        $motherp = mysqli_real_escape_string($db, $_POST['motherp']);
    }


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
    if (!empty($_POST['condition'])) {
        $rcondition = $_POST['condition'];
    }
    if (!empty($_POST['source'])) {
        $rsource = $_POST['source'];
    }

    $target_dir = "img/application/";
    $target_file = $target_dir . $ndp . ".jpg";

    if (!empty($image)) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

            $query = "INSERT INTO application 
(username,phase, ndp,image, sem,room_num,bed_num,name,rgender,rrace,rreligion,rfname,rfcareer,rfphonenum,rmname,rmcareer,rmphonenum,raddress,rhomephonenum,rphonenum,ic,course,coursecode,adm_Date,rkey,rbed,rpillow,rtable,rchair,rcloset,rclothhanger,rtrashcan,rmat,rcondition,rsource) 
        VALUES('$username', '1','$ndp','$target_file', '$sem', '$room_number', '$bed_number', '$name', '$gender', '$race', '$religion', '$fathern', '$fatherc', '$fatherp', '$mothern', '$motherc', '$motherp', '$address', '$hphonen', '$phonen', '$ic', '$course','$coursecode', '$session_num', '$rkey', '$rbed', '$rpillow', '$rtable', '$rchair', '$rcloset', '$rhanger', '$rtrashcan', '$rmat', '$rcondition', '$rsource')";
            if (mysqli_query($db, $query)) {

                array_push($errors, '<div class="alert alert-sucess alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i>Successful
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
                header('location: index.php');


            }
            else {


                array_push($errors, '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i>Error sending to database
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');


            }


        }
        else {

            array_push($errors, '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa fa-exclamation-circle me-2"></i>Error sending to database
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>');


        }
    }    
    else {

        $query = "INSERT INTO application 
    (username,phase, ndp,image, sem,room_num,bed_num,name,rgender,rrace,rreligion,rfname,rfcareer,rfphonenum,rmname,rmcareer,rmphonenum,raddress,rhomephonenum,rphonenum,ic,course,coursecode,adm_Date,rkey,rbed,rpillow,rtable,rchair,rcloset,rclothhanger,rtrashcan,rmat,rcondition,rsource) 
            VALUES('$username', '1','$ndp','$image', '$sem', '$room_number', '$bed_number', '$name', '$gender', '$race', '$religion', '$fathern', '$fatherc', '$fatherp', '$mothern', '$motherc', '$motherp', '$address', '$hphonen', '$phonen', '$ic', '$course','$coursecode', '$session_num', '$rkey', '$rbed', '$rpillow', '$rtable', '$rchair', '$rcloset', '$rhanger', '$rtrashcan', '$rmat', '$rcondition', '$rsource')";
        if (mysqli_query($db, $query)) {

            array_push($errors, '<div class="alert alert-sucess alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle me-2"></i>Successful
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
            header('location: index.php');


        }
        else {


            array_push($errors, '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i>Error sending to database 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');


        }





    
}







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

    $room_num1 = $_POST['room_num'];


    $ndp = $_POST['ndp'];
    $tpaid = $_POST['tpaid'];
    $date = date("d/m/Y");

    if ($room_num1) {
        $query5 = "SELECT * FROM application WHERE ndp='$ndp'";

        $results5 = mysqli_query($db, $query5);

        while ($row5 = mysqli_fetch_assoc($results5)) {
            $query3 = "SELECT * FROM room WHERE room_num='$room_num1'  ORDER BY `room_num` LIMIT 1;";
            $results3 = mysqli_query($db, $query3);

            while ($row3 = mysqli_fetch_assoc($results3)) {

                $occ1 = $row3['occ'];

                if ($occ1 == '0') {

                    $query2 = "UPDATE application SET phase='3' ,room_num='$room_num1', rnumber='$receipt', rtotalprice='$tpaid', rpaydate='$date' WHERE ndp='$ndp'";

                    $query6 = "UPDATE room SET room_occ1='$ndp', occ='1' WHERE room_num='$room_num1'";


                    if (mysqli_query($db, $query2)) {
                        if (mysqli_query($db, $query6)) {
                            array_push($errors, '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle me-2"></i>Sucessfully approved!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
                        }

                    }
                }
                if ($occ1 == '1') {

                    $query2 = "UPDATE application SET phase='3' ,room_num='$room_num1', rnumber='$receipt', rtotalprice='$tpaid', rpaydate='$date' WHERE ndp='$ndp'";

                    $query6 = "UPDATE room SET room_occ2='$ndp', occ='2' WHERE room_num='$room_num1'";

                    if (mysqli_query($db, $query2)) {
                        if (mysqli_query($db, $query6)) {
                            array_push($errors, '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle me-2"></i>Sucessfully approved!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
                        }

                    }
                }
                if ($occ1 == '2') {

                    array_push($errors, '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle me-2"></i>Room is full
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');

                }


            }
        }
    }
    else {
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

                        $occ1 = $row3['occ'];

                        if ($occ1 == '0') {

                            $query2 = "UPDATE application SET phase='3' ,room_num='$room_number', rnumber='$receipt', rtotalprice='$tpaid', rpaydate='$date' WHERE ndp='$ndp'";

                            $query6 = "UPDATE room SET room_occ1='$ndp', occ='1' WHERE room_num='$room_number'";


                            if (mysqli_query($db, $query2)) {
                                if (mysqli_query($db, $query6)) {
                                    array_push($errors, '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa fa-exclamation-circle me-2"></i>Sucessfully approved!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>');
                                }

                            }
                        }

                        if ($occ1 == '1') {

                            $query2 = "UPDATE application SET phase='3' ,room_num='$room_number', rnumber='$receipt', rtotalprice='$tpaid', rpaydate='$date' WHERE ndp='$ndp'";

                            $query6 = "UPDATE room SET room_occ2='$ndp', occ='2' WHERE room_num='$room_number'";


                            if (mysqli_query($db, $query2)) {
                                if (mysqli_query($db, $query6)) {
                                    array_push($errors, '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa fa-exclamation-circle me-2"></i>Sucessfully approved!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>');
                                }

                            }
                        }
                        if ($occ1 == '2') {

                            array_push($errors, '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle me-2"></i>Room is full
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');

                        }

                    }
                }
                else if (strpos($course, 'DKM') !== false) {
                    $query3 = "SELECT * FROM room WHERE `room_num` LIKE '%b%' AND (`room_occ1`='0' OR `room_occ2`='0') ORDER BY `room_num` LIMIT 1;";
                    $results3 = mysqli_query($db, $query3);

                    while ($row3 = mysqli_fetch_assoc($results3)) {
                        $room_number = $row3['room_num'];

                        $occ1 = $row3['occ'];


                        if ($occ1 == '0') {

                            $query2 = "UPDATE application SET phase='3' ,room_num='$room_number', rnumber='$receipt', rtotalprice='$tpaid', rpaydate='$date' WHERE ndp='$ndp'";

                            $query6 = "UPDATE room SET room_occ1='$ndp', occ='1' WHERE room_num='$room_number'";


                            if (mysqli_query($db, $query2)) {
                                if (mysqli_query($db, $query6)) {
                                    array_push($errors, '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa fa-exclamation-circle me-2"></i>Sucessfully approved!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>');
                                }

                            }
                        }

                        if ($occ1 == '1') {

                            $query2 = "UPDATE application SET phase='3' ,room_num='$room_number', rnumber='$receipt', rtotalprice='$tpaid', rpaydate='$date' WHERE ndp='$ndp'";

                            $query6 = "UPDATE room SET room_occ2='$ndp', occ='2' WHERE room_num='$room_number'";


                            if (mysqli_query($db, $query2)) {
                                if (mysqli_query($db, $query6)) {
                                    array_push($errors, '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa fa-exclamation-circle me-2"></i>Sucessfully approved!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>');
                                }

                            }
                        }
                        if ($occ1 == '2') {

                            array_push($errors, '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle me-2"></i>Room is full
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');

                        }


                    }
                }
                else {
                    array_push($errors, '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle me-2"></i>Is not DTK nor DKM, please manually select room number
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
                }

            }

            if ($rgender == 'Female') {

                if (strpos($course, 'DTK') !== false) {
                    $query3 = "SELECT * FROM room WHERE `room_num` LIKE '%c%' AND (`room_occ1`='0' OR `room_occ2`='0') ORDER BY `room_num` LIMIT 1;";
                    $results3 = mysqli_query($db, $query3);

                    while ($row3 = mysqli_fetch_assoc($results3)) {
                        $room_number = $row3['room_num'];

                        $occ1 = $row3['occ'];


                        if ($occ1 == '0') {

                            $query2 = "UPDATE application SET phase='3' ,room_num='$room_number', rnumber='$receipt', rtotalprice='$tpaid', rpaydate='$date' WHERE ndp='$ndp'";

                            $query6 = "UPDATE room SET room_occ1='$ndp', occ='1' WHERE room_num='$room_number'";


                            if (mysqli_query($db, $query2)) {
                                if (mysqli_query($db, $query6)) {
                                    array_push($errors, '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa fa-exclamation-circle me-2"></i>Sucessfully approved!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>');
                                }

                            }
                        }

                        if ($occ1 == '1') {

                            $query2 = "UPDATE application SET phase='3' ,room_num='$room_number', rnumber='$receipt', rtotalprice='$tpaid', rpaydate='$date' WHERE ndp='$ndp'";

                            $query6 = "UPDATE room SET room_occ2='$ndp', occ='2' WHERE room_num='$room_number'";


                            if (mysqli_query($db, $query2)) {
                                if (mysqli_query($db, $query6)) {
                                    array_push($errors, '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa fa-exclamation-circle me-2"></i>Sucessfully approved!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>');
                                }

                            }
                        }
                        if ($occ1 == '2') {

                            array_push($errors, '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle me-2"></i>Room is full
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');

                        }


                    }
                }
                else if (strpos($course, 'DKM') !== false) {
                    $query3 = "SELECT * FROM room WHERE `room_num` LIKE '%d%' AND (`room_occ1`='0' OR `room_occ2`='0') ORDER BY `room_num` LIMIT 1;";
                    $results3 = mysqli_query($db, $query3);

                    while ($row3 = mysqli_fetch_assoc($results3)) {
                        $room_number = $row3['room_num'];

                        $occ1 = $row3['occ'];


                        if ($occ1 == '0') {

                            $query2 = "UPDATE application SET phase='3' ,room_num='$room_number', rnumber='$receipt', rtotalprice='$tpaid', rpaydate='$date' WHERE ndp='$ndp'";

                            $query6 = "UPDATE room SET room_occ1='$ndp', occ='1' WHERE room_num='$room_number'";


                            if (mysqli_query($db, $query2)) {
                                if (mysqli_query($db, $query6)) {
                                    array_push($errors, '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa fa-exclamation-circle me-2"></i>Sucessfully approved!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>');
                                }

                            }
                        }

                        if ($occ1 == '1') {

                            $query2 = "UPDATE application SET phase='3' ,room_num='$room_number', rnumber='$receipt', rtotalprice='$tpaid', rpaydate='$date'  WHERE ndp='$ndp'";

                            $query6 = "UPDATE room SET room_occ2='$ndp', occ='2' WHERE room_num='$room_number'";


                            if (mysqli_query($db, $query2)) {
                                if (mysqli_query($db, $query6)) {
                                    array_push($errors, '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa fa-exclamation-circle me-2"></i>Sucessfully approved!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>');
                                }

                            }
                        }
                        if ($occ1 == '2') {

                            array_push($errors, '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle me-2"></i>Room is full
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');

                        }

                    }
                }
                else {
                    array_push($errors, '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle me-2"></i>Is not DTK nor DKM, please manually select room number
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
                }

            }
        }
    }






























}

if (isset($_POST['approve2'])) {




    $ndp1 = $_POST['ndp'];


    $query5 = "SELECT * FROM application WHERE ndp='$ndp1'";

    $results5 = mysqli_query($db, $query5);

    while ($row5 = mysqli_fetch_assoc($results5)) {

        $username = $row5['username'];
        $image = $row5['image'];
        $ndp = $row5['ndp'];
        $sem = $row5['sem'];
        $room_num = $row5['room_num'];
        $bed_num = $row5['bed_num'];
        $name = $row5['name'];
        $rgender = $row5['rgender'];
        $rrace = $row5['rrace'];
        $rreligion = $row5['rreligion'];
        $rfname = $row5['rfname'];
        $rfcareer = $row5['rfcareer'];
        $rfphonenum = $row5['rfphonenum'];
        $rmname = $row5['rmname'];
        $rmcareer = $row5['rmcareer'];
        $rmphonenum = $row5['rmphonenum'];
        $raddress = $row5['raddress'];
        $rhomephonenum = $row5['rhomephonenum'];
        $rphonenum = $row5['rphonenum'];
        $ic = $row5['ic'];
        $course = mysqli_real_escape_string($db, $row5['course']);
        $coursecode = $row5['coursecode'];
        $adm_date = $row5['adm_date'];


        $user_check_query = "SELECT * FROM student WHERE ndp='$ndp1' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        if ($user) {

            array_push($errors, '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i>Student already exist
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');




        }
        else {

            $query = "INSERT INTO student (username, image, ndp , sem, room_num, bed_num,name , rgender, rrace, rreligion,
        rfname, rfcareer, rfphonenum, rmname, rmcareer, rmphonenum, raddress, rhomephonenum, rphonenum, ic , course ,coursecode ,adm_date) 
                                VALUES('$username','$image','$ndp','$sem','$room_num','$bed_num','$name','$rgender','$rrace','$rreligion','$rfname','$rfcareer','$rfphonenum','$rmname','$rmcareer','$rmphonenum','$raddress','$rhomephonenum','$rphonenum','$ic','$course',
        '$coursecode','$adm_date')";
            if (mysqli_query($db, $query)) {

                $query2 = "UPDATE application SET phase='5'  WHERE ndp='$ndp1'";
                if (mysqli_query($db, $query2)) {

                    array_push($errors, '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i>Success 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');

                }
                else {
                    array_push($errors, '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i>Error sending to database
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');

                }
            }
            else

                array_push($errors, '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa fa-exclamation-circle me-2"></i> Error sending to database
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>');


        }
    }
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






    $username = $_SESSION['username'];



    $query2 = "UPDATE application SET phase='4',bed_num ='$bed_number', rkey='$roomkey', rbed='$bed',rpillow='$pillow',rtable='$table',rchair='$chair',rcloset='$closet',rclothhanger='$hanger',rtrashcan='$trashcan',rmat='$mat' WHERE username='$username'";

    if (mysqli_query($db, $query2)) {

        header('location: index.php');


    }




    else {
        array_push($errors, '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa fa-exclamation-circle me-2"></i>Error sending to database
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>');


    }






}

?>