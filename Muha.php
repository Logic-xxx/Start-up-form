<?php
session_start();
if (empty($_SESSION['getEmail']))
{
    $v = "";
}
else {
    $v = $_SESSION['getEmail']." "."<a href='logout.php' style=\"cursor:pointer\" class=\"w3-bar-item w3-button\" >SIGN OUT</a>";
}
?>
<?php
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];
$servername = "localhost";
$username = "root";
$password = "";
try {
    $pdo = new PDO("mysql:host=$servername;dbname=last", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
$result2 = $pdo->query('SELECT * FROM application');
?>
<?php $json_array1 = array();
while ($row1 = $result2->fetch(PDO::FETCH_ASSOC)){
    $json_array1[] = $row1;
}
$data1 = json_encode($json_array1); ?>
<?php
$array1 = json_decode($data1,true);?>
<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
            <a href="" class="w3-bar-item w3-button">HOME</a>
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

<h1 style="text-align: center;margin-top: 100px"><b>Applications & Applicants</b></h1>

<br>
<center>
<table border="1" width="60%">
    <tr><th>ID</th>
        <th>Logo</th>
        <th>Name</th>
        <th>Creation date</th>
        <th>Team size</th>
        <th>Email</th>
        <th>Project</th>
        <th>Type</th>
        <th>Purpose</th>
        <th>Cost</th>
    </tr>
<!--    --><?php
//    while ($column = $array1->fetch(PDO::FETCH_ASSOC)):
//        ?>
    <?php
    foreach ( $array1 as $column):
    ?>
        <tr>
        <td><?=$column['id'] ?></td>
        <td style="width: 10%"><img style="width: 100%" src="<?=$column['logo'] ?>"></td>
        <td><?=$column['name'] ?></td>
        <td><?=$column['tdate'] ?></td>
        <td><?=$column['tsize'] ?></td>
        <td><?=$column['email'] ?></td>
        <td><?=$column['project'] ?></td>
        <td><?=$column['type'] ?></td>
        <td><?=$column['purpose'] ?></td>
        <td><?=$column['cost'] ?> $</td>
        </tr>
    <?php endforeach; ?>
</table></center>


<br>
<script>
    function openNav() {
        document.getElementById("myNav").style.height = "100%";
    }

    function closeNav() {
        document.getElementById("myNav").style.height = "0%";
    }
</script>

</body>
</html>

