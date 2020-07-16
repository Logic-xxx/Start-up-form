<?php
session_start();
$date=" ";
$error1=$error2=$error3=$error4=" ";
$tdate=$tsize=$purpose=$type=" ";
if (empty($_SESSION['getEmail']))
{
    $v = "";
}
else {
    $v = $_SESSION['getEmail']." "."<a href='logout.php' style=\"cursor:pointer\" class=\"w3-bar-item w3-button\" >SIGN OUT</a>";
}
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];
$servername = "localhost";
$username = "root";
$password = "";

$name=$logo=$email=$cost=$project=" ";
try {
    $pdo = new PDO("mysql:host=$servername;dbname=last", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<?php
$so =" ";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["submitAll"])) {
        $date = $_POST["teamDate"];
        function myException($exception)
        {
            echo "<b>Exception:</b> " . $exception->getMessage();
        }

// Set user-defined exception handler function
        set_exception_handler("myException");
        if ($date > "2021-01-01") {
// Throw exception
            throw new Exception("Show a real date!!!");
            die();
        }

        function myErrorHandler($errno, $errstr, $errfile, $errline)
        {
            echo "<b>Form error:</b> [$errno] $errstr<br>";
            echo " Error on line $errline in $errfile<br>";
            die();
        }

// Set user-defined error handler function
        set_error_handler("myErrorHandler");

        $test = $_POST['teamWork'];

// Trigger error
        if (strlen($test) > 20) {
            trigger_error("Please follow requirements");
            die();
        }

// Restore previous error handler
        restore_error_handler();

        class customException extends Exception
        {
            public function errorMessage()
            {
                //error message
                $errorMsg = "<br>" . "<br>" . "<br>" . "<br>" . "<br>" . "<br>" . ' In ' . $this->getFile()
                    . ': <b>' . $this->getMessage() . '</b> is not a valid E-Mail address';
                return $errorMsg;
            }
        }

        $object = new customException();
        $email = $_POST['teamEmail'];

        try {
            //check if
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
                //throw exception if email is not valid
                throw new customException($email);
                die();
            }
        } catch (customException $e) {
            //display custom message
            echo $e->errorMessage();
        } finally {
            echo " Please write your real email";
        }
//        function checkNumber($x) {
//            if (!is_int($x)) {
//                throw new Exception('Enter in right format');
//            }
//        }
//        try {
//            echo checkNumber($_POST["needMoney"]) . "\n";
//        } catch (Exception $en) {
//            echo 'Поймано исключение: ',  $en->getMessage(), "\n";
//            die();
//        } finally {
//            header("Location:index.php");
//
//        }


        $target_dir = "images/";
        if (!(file_exists($target_dir))) {
            mkdir("images");
        }
        $target_file = $target_dir . basename($_FILES["userImage"]["tmp_name"]);

        if (move_uploaded_file($_FILES['userImage']['tmp_name'], $target_file)) {
//    $imgData = addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
//    $imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
//    $so=fopen($_FILES["userImage"]["tmp_name"], 'r');
            $filePath = realpath($_FILES["userImage"]["tmp_name"]);
            $get = $fp = fopen($target_file, "r");
        }

        $name = $_POST["teamName"];
        $logo = $target_file;
        $email = $_POST["teamEmail"];
        $cost = $_POST["needMoney"];
        $project = $_POST["projectName"];
        $tdate = $_POST["teamDate"];
        $tsize = $_POST["teamSize"];
        $purpose = $_POST["purpose"];
        $type = $_POST["ordinary"];
        if (!empty($name)||!empty($email)||!empty($cost)||!empty($project)||!empty($tdate)||!empty($tsize)||!empty($purpose)||!empty($type)) {
            $sql = 'INSERT INTO application(logo,name,email,project,cost,tdate,tsize,purpose,type) VALUES(:logo,:name,:email,:project,:cost,:tdate,:tsize,:purpose,:type )';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['logo' => $logo, 'name' => $name, 'email' => $email, 'project' => $project, 'cost' => $cost, 'tdate' => $tdate, 'tsize' => $tsize, 'purpose' => $purpose, 'type' => $type]);
        }
    }
}

?>
<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="Style.css">
<style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}

    body, html {
        height: 100%;
        line-height: 1.8;
    }

    /* Full height image header */
    .bgimg-1 {
        background-position: center;
        background-size: cover;
        background-image: url("https://wylsa.com/wp-content/uploads/2020/05/macbook-air-2020.jpg");
        min-height: 100%;
    }

    .w3-bar .w3-button {
        padding: 16px;
    }
</style>

<script>
    $(document).ready(function(){
        $("#team").click(function(){
            $("#div2").show();
            $("#div1").hide();
        });
        $("#indi").click(function(){
            $("#div2").hide();
            $("#div1").show();
        });

    });
</script>
<body>
<div id="myNav" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="overlay-content">
        <a href="#">Sign In</a>
        <input type="text" style="width: 200px" placeholder="Enter email"><br>
        <input style="margin-top: 5px;width: 200px" type="password" placeholder="Enter password"><br>
        <input style="margin-top: 10px" type="submit" value="Sign In" >
    </div>
</div>

<!-- Navbar (sit on top) -->
<div class="w3-top">
    <div class="w3-bar w3-white w3-card" id="myNavbar">
        <a href="#home" class="w3-bar-item w3-button w3-wide"><img src="https://i.pinimg.com/originals/f4/7a/11/f47a11f6f2fcd5cc64888d90637d45e5.gif" style="width: 60px"> </a>
        <!-- Right-sided navbar links -->
        <div class="w3-right w3-hide-small">
            <a href="index.php" class="w3-bar-item w3-button">HOME</a>
            <a href="#team" class="w3-bar-item w3-button"><i class="fa fa-user"></i> TEAM</a>
            <a href="#work" class="w3-bar-item w3-button"><i class="fa fa-th"></i> WORK</a>
            <a href="#pricing" class="w3-bar-item w3-button"><i class="fa fa-usd"></i> PRICING</a>
            <a href="#contact" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> CONTACT</a>
            <a class="w3-bar-item w3-button"><?php echo $v ?></a>

        </div>
        <!-- Hide right-floated links on small screens and replace them with a menu icon -->

        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
    <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button">ABOUT</a>
    <a href="#team" onclick="w3_close()" class="w3-bar-item w3-button">SIGN IN</a>
    <a href="#work" onclick="w3_close()" class="w3-bar-item w3-button">WORK</a>
    <a href="#pricing" onclick="w3_close()" class="w3-bar-item w3-button">PRICING</a>
    <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button">CONTACT</a>
</nav>


<h1 style="text-align: center;margin-top: 100px"><b>Application form</b></h1>
<form name="frmImage" enctype="multipart/form-data" action="" method="post" class="frmImageUpload">
    <div style="margin-left: 10%;border: black 2px">
        <fieldset style="width: 88%">
    <p> Project type:</p>

            <input type="checkbox" id="indi" name="typeWork" value="Individual">Individual
            <input type="checkbox" id="team" name="typeWork" value="Team">Team

                <div id="div1">
                <h3>Individual</h3>
                <input type="text" name="singleName" placeholder="Your name"><br>
                <input style="margin-top: 5px" type="date" name="singleDate" placeholder="Your birth date"><br>
                <input style="margin-top: 5px" type="text" name="singleEmail" placeholder="Your email"><br>
                <input style="margin-top: 5px" type="text" name="singleNumber" placeholder="Your cell number"><br>
                    <p>Your dream:</p>
                    <input style="margin-top: 5px;width: 50%;height: 100px" type="text"  name="dream" placeholder="No more than 20 symbols">
            </div>
            <div id="div2">
                <h3>Team</h3>
                <input type="text" name="teamName" placeholder="Team  name"><br>
                <p>When your team is created?</p>
                <input style="margin-top: 5px" type="date" name="teamDate" placeholder="Your birth date"><br>
                <input style="margin-top: 5px" type="text" name="teamEmail" placeholder="Team email"><br>
                <input style="margin-top: 5px" type="number" name="teamSize" placeholder="Team size"><br>
                <p>Describe your teamwork in three words:</p>
                <input style="margin-top: 5px;width: 50%;height: 100px" type="text" name="teamWork"  placeholder="No more than 30 symbols">
            </div>
            <div id="div4">
                <h3>Startup</h3>
                <input type="text" id="" name="projectName" placeholder="Project name">
                <p>Which industry/sector classification applies best to your Startup?</p>
                <select name="ordinary">
                    <option>Please Select</option>
                    <option value="IT Tools">IT Tools</option>
                    <option value="Transportation">Transportation</option>
                    <option value="Media">Media</option>
                    <option value="Education">Education</option>
                    <option value="eCommerce">eCommerce</option>
                </select>
                <p>Project goal:</p>
                <input style="margin-top: 5px;width: 40%" name="purpose" placeholder="Your purpose" type="text">
            </div>
            <div id="div5">
                <h3>The Basics</h3>
                <p>In your opinion, how much money is needed to implement a project into a product on the market?</p>
                <input style="margin-top: 5px" placeholder="0" name="needMoney" type="text">
                <p>Any other wishes for us:</p>
                <input style="margin-top: 5px;width: 50%;height: 100px" placeholder="We would be glad to hear wishes and opinions from future partners..." type="text">
            </div>
            <label>Upload Image File:</label><br/>
            <input name="userImage" type="file" class="inputFile"/><br><br>

            <input type="checkbox"> I agree to receive communications<br>
            <input type="checkbox"> I have read and understand with Privacy Policy<br><br>


            <input type="submit" value="Submit" name="submitAll" class="btnSubmit"/>
        </fieldset>
    </div>
</form><br>
<footer class="w3-center w3-black w3-padding-64" style="margin-top: 40px">

    <div class="w3-xlarge w3-section">
        <i class="fa fa-facebook-official w3-hover-opacity"></i>
        <i class="fa fa-instagram w3-hover-opacity"></i>
        <i class="fa fa-snapchat w3-hover-opacity"></i>
        <i class="fa fa-pinterest-p w3-hover-opacity"></i>
        <i class="fa fa-twitter w3-hover-opacity"></i>
        <i class="fa fa-linkedin w3-hover-opacity"></i>
    </div>
    <p>Powered by <a href="https://vk.com/aaniiq"  title="W3.CSS" target="_self" class="w3-hover-text-green">Alber Adilov</a></p>
</footer>
<?php echo $so ?>
<script>
    function openNav() {
        document.getElementById("myNav").style.height = "100%";
    }

    function closeNav() {
        document.getElementById("myNav").style.height = "0%";
    }
</script>
<script>
    $("input:checkbox").on('click', function() {
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        if ($box.is(":checked")) {
            // the name of the box is retrieved using the .attr() method
            // as it is assumed and expected to be immutable
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });
</script>

</body>
</html>
