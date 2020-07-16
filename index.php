<?php
session_start();

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];
$servername = "localhost";
$username = "root";
$password = "";
$mes1 = "Do you already have account?";
$name=$number=$email=$psw=" ";
try {
    $pdo = new PDO("mysql:host=$servername;dbname=last", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email=$_POST["email"];
    $psw=$_POST["password"];
    $boolean =false;
    if(isset($_POST['sign'])) {
        $result = $pdo->query('SELECT email,password FROM applicant');
        if($email=='admin@gmail.com'&&$psw=='muha'){
            $_SESSION['getEmail']=$email;
            header("Location:Muha.php");
            exit();
        }
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            if ($row['email'] == $email && $row['password'] == $psw) {
                $boolean = true;
                $_SESSION['getEmail']=$email;
                header("Location:index.php");
            }
        }
        if(!$boolean){
            $error2 = "You entered incorrect password or login!";

        }

    }
}

if (empty($_SESSION['getEmail']))
{
    $v = "<a style=\"cursor:pointer\" class=\"w3-bar-item w3-button\" onclick=\"openNav()\">SIGN IN</a>";
}
else {
    $v = $_SESSION['getEmail']." "."<a href='logout.php' style=\"cursor:pointer\" class=\"w3-bar-item w3-button\" >SIGN OUT</a>";
}
?>
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
<form action="" method="post">
<div id="myNav" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="overlay-content">
        <a href="#">Sign In</a>
        <input name="email" type="text" style="width: 200px" placeholder="Enter email"><br>
        <input name="password" style="margin-top: 5px;width: 200px" type="password" placeholder="Enter password"><br>
        <?php echo $error2 ?>
        <input style="margin-top: 10px" type="submit" name="sign" value="Sign In" >
    </div>
</div>
</form>
<!-- Navbar (sit on top) -->
<div class="w3-top">
    <div class="w3-bar w3-white w3-card" id="myNavbar">
        <a href="#home" class="w3-bar-item w3-button w3-wide"><img src="https://i.pinimg.com/originals/f4/7a/11/f47a11f6f2fcd5cc64888d90637d45e5.gif" style="width: 60px"> </a>
        <!-- Right-sided navbar links -->
        <div class="w3-right w3-hide-small">
            <a href="#about" class="w3-bar-item w3-button">ABOUT</a>
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

<!-- Header with full-height image -->
<header class="bgimg-1 w3-display-container w3-grayscale-min" id="home">
    <div class="w3-display-left w3-text-white" style="padding:48px">
        <span class="w3-jumbo w3-hide-small">Start something that matters</span><br>
        <span class="w3-xxlarge w3-hide-large w3-hide-medium">Start something that matters</span><br>
        <span class="w3-large">Stop wasting valuable time with projects that just isn't you.</span>
        <p><a href="first.php" class="w3-button w3-white w3-padding-large w3-large w3-margin-top w3-opacity w3-hover-opacity-off">Learn more and start today</a></p>
    </div>
    <div class="w3-display-bottomleft w3-text-grey w3-large" style="padding:24px 48px">
        <i class="fa fa-facebook-official w3-hover-opacity"></i>
        <i class="fa fa-instagram w3-hover-opacity"></i>
        <i class="fa fa-snapchat w3-hover-opacity"></i>
        <i class="fa fa-pinterest-p w3-hover-opacity"></i>
        <i class="fa fa-twitter w3-hover-opacity"></i>
        <i class="fa fa-linkedin w3-hover-opacity"></i>
    </div>
</header>

<!-- About Section -->
<div class="w3-container" style="padding:128px 16px" id="about">
    <h3 class="w3-center">ABOUT THE COMPANY</h3>
    <p class="w3-center w3-large">Key features of our company</p>
    <div class="w3-row-padding w3-center" style="margin-top:64px">
        <div class="w3-quarter">
            <i class="fa fa-desktop w3-margin-bottom w3-jumbo w3-center"></i>
            <p class="w3-large">Responsive</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
        </div>
        <div class="w3-quarter">
            <i class="fa fa-heart w3-margin-bottom w3-jumbo"></i>
            <p class="w3-large">Passion</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
        </div>
        <div class="w3-quarter">
            <i class="fa fa-diamond w3-margin-bottom w3-jumbo"></i>
            <p class="w3-large">Design</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
        </div>
        <div class="w3-quarter">
            <i class="fa fa-cog w3-margin-bottom w3-jumbo"></i>
            <p class="w3-large">Support</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
        </div>
    </div>
</div>

<!-- Promo Section - "We know design" -->
<div class="w3-container w3-light-grey" style="padding:128px 16px">
    <div class="w3-row-padding">
        <div class="w3-col m6">
            <h3>We know design.</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod<br>tempor incididunt ut labore et dolore.</p>
            <p><a href="#work" class="w3-button w3-black"><i class="fa fa-th"> </i> View Our Works</a></p>
        </div>
        <div class="w3-col m6">
            <img class="w3-image w3-round-large" src="https://cdn1.photostockeditor.com/c/1912/phone-person-using-smartphone-taking-picture-of-building-cell%20phone-cell%20phone-image.jpg" alt="Buildings" width="700" height="394">
        </div>
    </div>
</div>

<!-- Team Section -->
<div class="w3-container" style="padding:128px 16px" id="team">
    <h3 class="w3-center">THE TEAM</h3>
    <p class="w3-center w3-large">The ones who runs this company</p>
    <div class="w3-row-padding w3-grayscale" style="margin-top:64px">
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxISEhUSEhIVFRUVFQ8VFRUVFRUVFRUVFRUWFhUVFRUYHSggGBolHRUVITEhJSkrLi4uFx8zODMsNygtLisBCgoKDg0OFxAQFy0dFx0tLSstKy0tLS0rLS0tLS0tLS0rLS0rLS0tLS0tLS0tLS0tLTcrNy0tLTcrNy0rKysrK//AABEIAOEA4QMBIgACEQEDEQH/xAAbAAACAwEBAQAAAAAAAAAAAAAAAQQFBgMCB//EADoQAAIBAwIDBQYFAgUFAAAAAAABAgMEEQUhEjFBE1FhcZEGIoGhscEUQlLR8DLhNGJyovEVIzOCkv/EABgBAQEBAQEAAAAAAAAAAAAAAAABAgME/8QAHxEBAQACAwEBAAMAAAAAAAAAAAECEQMhMRJBE1Fx/9oADAMBAAIRAxEAPwD40DQBk6MhjFkYAzxI9HmQIQhiIoZ5BhkijADR1p0cjRtxweuzZYULQsaNih0m9s/2TH2TNH+CR4/AjcXtnnTZ5cS9lY+BGq2Jek3VVgZLq2TRFcGiLskMMAVDyJg2NBQMSGVDEAAAAAHoGDEEMBMYAzywYMDyDATMqBxQsnWhDLEWutGkWNvQFQo95PoUy2szsUqKRJjhHg9Km2YdI9pnWK2OcbZnuNB7mdNiUF3HKdFM6OmxSTKzUd266lfeWCZZOYp1Mmts2MrWpOLwzky61KgnuUzXQqQ0hI9RFJblQYGJDAAATAMgPAFDBiTGEA2hDATExnlhSZ5Z6Z5ZlTiWFlT6kKjDLLOCwsIsTJKc0ubOE9S6R9TpbaVKo8vD8N8ehb2+jRXNLy6MdJJvxSQv5LnuSqOoSfTZ4/mS9WlU3+VPHh9yTR0+imlw4J9YtzjzV9lxvKff/ctbW1bW67y0o2EUspFhTorGMGMsp+O/Hx2eqF2ZxnZGilboj3NJJMxt1uMZO6tCqqpxZdanNween3KSteqWzOsjyclm3iruikuoYZb9oV14uZdOe0WK5+X3PDGGCqaAAKAQxEDA85Aux6wMSGAMBDCExMYmRSZ5R6ERUm07y806z4uZU6bTyzT2s1FC3TMm6s6VKMI8tyHWvEn1fkc6tzJ+XQgKzqSlni2/SspHP2vRuYzpc0Lz/K//AKwOV0m87/H9zOVNIrKcnGHFFqeE3LbiTSaw1us5XTbfK2Jmm2rhTkqnHxOS4d01jHXctxiTkyn422k3GYnutfKJnLS/dODTWGcu1nUeeSMad/5Jpo46nF9TrKfEZKrFrdPcuNM1BOOW+SFxTHk/tLurSMlv6mX1TRObhLL7nyLyrqCk+vwOVSvB7cvMsysTPDHJhK8ZQeJJr6HF1MpmtvrWM000jKXls6cmuh1mW3kyw0isaPLPSKAGDAoMiAbIABZGXQSGeT0iAyGQYAJgwYIBMSLenoNVxzsn0RWQptT4Wt08P4EVcaZR2L2jb5IOl0zSWdFEzrXFjtFp2R6/6b5ou6VHwO/4f1OW3snHGfVpNbcTPD03rJv5miducvw2Rs/ijO/g9x1JxidtTuVGXZwTlLql9DrpmiTm+Ofp3Flc7h3qINRprqViquMmlyffujcy0TbdGV1nS5Uaif5Xt8ehZe2eTjyk2ganxSlCVOEowSXGqcll/q36PC2yiLZ3dafHn+mKbSqbPGdkntmX7F3QpZXFB4fXuyn1QqtH9UE33r9jf05fF9V9jeKT5+uzXmQ/aOlyl6kydBJ5SwyNqlTip+KES+ds8MSGaYDQhiYAAIGAAAAACGAxIQwGy29mbVTrJvlBZ/8AZ7R+7+BUM0nsjUS7STxlSpvHhv8Aclaw9jWwodpU4OUYpZfizLe0enKFfKae7WVye2U/mbPTrXMHOTw5b46pdF6GZ9p4xTjwprLfN5b8TEvbvzSWbedHhyNXa0djOaKjUW0sIma8HifTjg6qmcqMiXA5vS5OmR7yXBTlJc0nglzmkVV/W4k10Mbbk2fs/pcIxdWe73k2yv0z2sVxVlCnbyVOP5+JfOPTlyyyypapFU3Tw8tYx0FomjU6VJwju5NuT7292blYuFlml/RrrgWMPKyn4Gb1eMa8p0002llpNZT6bdD1rdWpCjKFHZqLUWvBckcvZbQo21N1ZvM5LLy+/frz8yplvetIdpa5gnjfr5rZnqpbFtYwThy5uT9WxV6I2TDpm7izz0M/qtthNmzr0zOa1H3Wbxrz8uE0xCAbFk6vKAyIYADEABgAAAAAIGAgAbLT2bq4quL5ThJfFbr7+pVHW2q8Eoy7mmFfS4al2eXL+lpYfTyM9rt4qkk8Y7lh8u9EzSIKrHj4uLL5PdLwSPPtHTf/AG8rq+hnrbtnbcN/jtpkdkX9vIpLFe6i3s5Gcm+HqLOgyUquFsV9KW52qSOdeidlUqZI9Slkl0aWcEn8KZ01tTdko8/U7Wt2+SfMsJWcOc2m+kc/Uj3ltGosYSXRp4a9DTU47k46hU9zDZTyqzxwuTcem/Tu8iw/BRWcuUumW28EWVs4S4XuujDGcyx7WWl3e3CyXWksMpIRcSbGvmJCVwupGd1VcbUF+Z4/f7lxf1ipoSzVy+UYz9WsL5ZOmLhy3d0xN5Q7OpOH6W1+xxLD2h/xFTxcX/siVx2eSzV0AGIIAACAyAAaAAAZAAAAAAATtJ1Wpby4oYa6xfJ/sy7vPab8VwQdLhw288WemMcl3mVO9lPE4vx+o019XWm/s/6EWNnLYqrOXuosLd7nOu/H4sqL3RYdjkg2q3LSD6HKvRiHLhRnquuzy1wtc+expFSzscXpkHziRtn1d1ZckvmdlezWzivgy9hplOO6I9Wzpye0sfAu3swzx12pp6qs43XnyJdvWU8cnjke73R9tt89SidrWpy91YXU1GOe463F7eW+2UQYTxFlrCpmms88FNdPhT+Jn9eO+K69rbnCm4qi5yeMzcm/8kItY9c+pwr1Mv4/PoVOv15QiqL64e3WPj8TvjHjuXe1Nd13UnKb5ybfl3L0wcQA25gAAiAAAAAANKWQYAZAAAAAABQPIgIjX6Td8UY95oLWWdzH2cXGEZLot0aPTbjJMo1x3VaSgWVEp7apn5FvSnhZZxr2YXcTIM7x3RET6neD25ZMOxXLS6nGnRTXQ61Y56HCMGuZGo7SWNkV9ejl7li5YRBqzCIk1go9aq9C3uqmEZXVLjLOmMefmy1FTqF+6SUo44uJYzutt84M/dXM6knKbzJ9Ttqdxxz8FsvuyIeh4gAAEAAAUsgMAFgBgaQgADKgAABDHgQAOKBIkW1PL+KGjbTWFHMcHVQdN5S26ruJGm0tkWUrbKOeWXbrhhuHY3SaLuyrbbmWdvKDzH4ostPvt99iXtqWzqtXA720s4a3WenLuKulcqSJtCvjkY09EyWU0upzlFbnFVUxTrYQa24XLK2q9yXXrdMlXd1kjOj66QtVr4MXrl7hYXOXyXeWGu6so53y3lJGQq1XJuUnu/5sd8MdPFyZ7ryIYG3MAAgGIBgACGAsgGAKgGLAyLQAAEAIAA9Im6fF5XjJfL/kgos9HjmXkypWxsKexb0o95X6ci3pQ2PNn69vF1Eedvkjzs8/zcsJQ7h01kzK6WbQKMakejl8mSYX7i98rwaaJ9Ol3/z4EnsVjlkv0fMV9LUeuT1U1BY5/MdxY0/0r6fQqrm1j3fUbiWWOlzqsV5lNe3c5+CPU6a6HK42i/I3HC7Y3U5ZqPw2Ip0ryzKT8WeDs85YEj0BVJiGBAgGACAeBAHCA8iKAYICIAAAAABFDLfQH70l4JlQWWgyxVS7018ef2A3WnvYt6LKW0eC4tmefJ6+O9Jagmt+Z47LB1iz0c3YQidFVwOEUeJ0wrjcVslTeN4LSpS8iBWiixnKq5UOr9Cu1SWz8i6qIoNbn7rXfsdJ3XDOajFyYI9T+55R3eYMQ2hAAABAAAAAMaQiqBDABiGIIBiGAhoQEDR2tqvDKMu5p/ucRlH0q1jlJp88Ms6DM77KXXaUlH80Pdfl0NHS2OGXr08fiVGR7jM5wYM5u8S4MJnKnLC3OnaBdo9wyFKJOrTIVRhEW6aSMzfvil4LL9C8v5lNqMOCjUm+fC167L6nTF5+TtjgAMHd5wxDAAAAAQAGAGIBgecAMAGIBsBAMMgAAAAAxMC29m7/ALGst9pYT+x9Lo4kkfHj6F7I6r2sFFv347Px8TnnN9u3Flq6aaEDrwbnmlLJ1fecK9UDE0e4npIgh1YkOu8IsqiK+rHLKK5UeJ5fwKD2zrKMIUlzk8vyj/dr0NdLCWXyR8z1y+7atKfT+mP+lfzJ045uuPLdT/VfgAA7vKGAAAxDEgAAbAAAMgwEAAAMAAUAAADQAADYSAC0IvPY/wDxC8mAGb4s9fS6XU7wADy17p46Uj1LkAC+Ecn1IIARYga5/wCCp/on9D5agA9HF48/P7ADADo84BAADZ5QAADQAAmAAAAAEV//2Q==" alt="John" style="width:100%;height: 400px">
                <div class="w3-container">
                    <h3>Alisher Bektleu</h3>
                    <p class="w3-opacity">CEO & Founder</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
                    <p><button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button></p>
                </div>
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="https://sun9-11.userapi.com/c857620/v857620429/20e1f2/86RpAxd6XSM.jpg" alt="Jane" style="width:100%;height: 400px" >
                <div class="w3-container">
                    <h3>Alber Adilov</h3>
                    <p class="w3-opacity">Art Director</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
                    <p><button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button></p>
                </div>
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="https://sun9-17.userapi.com/c856524/v856524429/1ad3ef/Qw4SlHHACEA.jpg" alt="Mike" style="width:100%;height: 400px">
                <div class="w3-container">
                    <h3>Ernar Sagyndykov</h3>
                    <p class="w3-opacity">Web Designer</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
                    <p><button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button></p>
                </div>
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="https://sun9-23.userapi.com/c855436/v855436429/23b496/ym79leaGx7g.jpg" alt="Dan" style="width:100%;height: 400px">
                <div class="w3-container">
                    <h3>Bekdaulet Shapigullin</h3>
                    <p class="w3-opacity">Designer</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
                    <p><button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Promo Section "Statistics" -->
<div class="w3-container w3-row w3-center w3-dark-grey w3-padding-64">
    <div class="w3-quarter">
        <span class="w3-xxlarge">14+</span>
        <br>Partners
    </div>
    <div class="w3-quarter">
        <span class="w3-xxlarge">55+</span>
        <br>Projects Done
    </div>
    <div class="w3-quarter">
        <span class="w3-xxlarge">89+</span>
        <br>Happy Clients
    </div>
    <div class="w3-quarter">
        <span class="w3-xxlarge">150+</span>
        <br>Meetings
    </div>
</div>

<!-- Work Section -->
<div class="w3-container" style="padding:128px 16px" id="work">
    <h3 class="w3-center">OUR WORK</h3>
    <p class="w3-center w3-large">What we've done for people</p>

    <div class="w3-row-padding" style="margin-top:64px">
        <div class="w3-col l3 m6">
            <img src="https://www.w3schools.com/w3images/tech_mic.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="A microphone">
        </div>
        <div class="w3-col l3 m6">
            <img src="https://www.w3schools.com/w3images/tech_phone.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="A phone">
        </div>
        <div class="w3-col l3 m6">
            <img src="https://www.w3schools.com/w3images/tech_drone.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="A drone">
        </div>
        <div class="w3-col l3 m6">
            <img src="https://www.w3schools.com/w3images/tech_sound.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="Soundbox">
        </div>
    </div>

    <div class="w3-row-padding w3-section">
        <div class="w3-col l3 m6">
            <img src="https://www.w3schools.com/w3images/tech_tablet.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="A tablet">
        </div>
        <div class="w3-col l3 m6">
            <img src="https://www.w3schools.com/w3images/tech_camera.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="A camera">
        </div>
        <div class="w3-col l3 m6">
            <img src="https://www.w3schools.com/w3images/tech_typewriter.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="A typewriter">
        </div>
        <div class="w3-col l3 m6">
            <img src="https://www.w3schools.com/w3images/tech_tableturner.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="A tableturner">
        </div>
    </div>
</div>

<!-- Modal for full size images on click-->
<div id="modal01" class="w3-modal w3-black" onclick="this.style.display='none'">
    <span class="w3-button w3-xxlarge w3-black w3-padding-large w3-display-topright" title="Close Modal Image">×</span>
    <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
        <img id="img01" class="w3-image">
        <p id="caption" class="w3-opacity w3-large"></p>
    </div>
</div>

<!-- Skills Section -->
<div class="w3-container w3-light-grey w3-padding-64">
    <div class="w3-row-padding">
        <div class="w3-col m6">
            <h3>Our Skills.</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod<br>
                tempor incididunt ut labore et dolore.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod<br>
                tempor incididunt ut labore et dolore.</p>
        </div>
        <div class="w3-col m6">
            <p class="w3-wide"><i class="fa fa-camera w3-margin-right"></i>Photography</p>
            <div class="w3-grey">
                <div class="w3-container w3-dark-grey w3-center" style="width:90%">90%</div>
            </div>
            <p class="w3-wide"><i class="fa fa-desktop w3-margin-right"></i>Web Design</p>
            <div class="w3-grey">
                <div class="w3-container w3-dark-grey w3-center" style="width:85%">85%</div>
            </div>
            <p class="w3-wide"><i class="fa fa-photo w3-margin-right"></i>Photoshop</p>
            <div class="w3-grey">
                <div class="w3-container w3-dark-grey w3-center" style="width:75%">75%</div>
            </div>
        </div>
    </div>
</div>

<!-- Pricing Section -->
<div class="w3-container w3-center w3-dark-grey" style="padding:128px 16px" id="pricing">
    <h3>PRICING</h3>
    <p class="w3-large">Choose a pricing plan that fits your needs.</p>
    <div class="w3-row-padding" style="margin-top:64px">
        <div class="w3-third w3-section">
            <ul class="w3-ul w3-white w3-hover-shadow">
                <li class="w3-black w3-xlarge w3-padding-32">Basic</li>
                <li class="w3-padding-16"><b>10GB</b> Storage</li>
                <li class="w3-padding-16"><b>10</b> Emails</li>
                <li class="w3-padding-16"><b>10</b> Domains</li>
                <li class="w3-padding-16"><b>Endless</b> Support</li>
                <li class="w3-padding-16">
                    <h2 class="w3-wide">$ 10</h2>
                    <span class="w3-opacity">per month</span>
                </li>
                <li class="w3-light-grey w3-padding-24">
                    <button class="w3-button w3-black w3-padding-large">Sign Up</button>
                </li>
            </ul>
        </div>
        <div class="w3-third">
            <ul class="w3-ul w3-white w3-hover-shadow">
                <li class="w3-red w3-xlarge w3-padding-48">Pro</li>
                <li class="w3-padding-16"><b>25GB</b> Storage</li>
                <li class="w3-padding-16"><b>25</b> Emails</li>
                <li class="w3-padding-16"><b>25</b> Domains</li>
                <li class="w3-padding-16"><b>Endless</b> Support</li>
                <li class="w3-padding-16">
                    <h2 class="w3-wide">$ 25</h2>
                    <span class="w3-opacity">per month</span>
                </li>
                <li class="w3-light-grey w3-padding-24">
                    <button class="w3-button w3-black w3-padding-large">Sign Up</button>
                </li>
            </ul>
        </div>
        <div class="w3-third w3-section">
            <ul class="w3-ul w3-white w3-hover-shadow">
                <li class="w3-black w3-xlarge w3-padding-32">Premium</li>
                <li class="w3-padding-16"><b>50GB</b> Storage</li>
                <li class="w3-padding-16"><b>50</b> Emails</li>
                <li class="w3-padding-16"><b>50</b> Domains</li>
                <li class="w3-padding-16"><b>Endless</b> Support</li>
                <li class="w3-padding-16">
                    <h2 class="w3-wide">$ 50</h2>
                    <span class="w3-opacity">per month</span>
                </li>
                <li class="w3-light-grey w3-padding-24">
                    <button class="w3-button w3-black w3-padding-large">Sign Up</button>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="w3-container w3-light-grey" style="padding:128px 16px" id="contact">
    <h3 class="w3-center">CONTACT</h3>
    <p class="w3-center w3-large">Lets get in touch. Send us a message:</p>
    <div style="margin-top:48px">
        <p><i class="fa fa-map-marker fa-fw w3-xxlarge w3-margin-right"></i> Chicago, US</p>
        <p><i class="fa fa-phone fa-fw w3-xxlarge w3-margin-right"></i> Phone: +00 151515</p>
        <p><i class="fa fa-envelope fa-fw w3-xxlarge w3-margin-right"> </i> Email: mail@mail.com</p>
        <br>
        <form action="/action_page.php" target="_blank">
            <p><input class="w3-input w3-border" type="text" placeholder="Name" required name="Name"></p>
            <p><input class="w3-input w3-border" type="text" placeholder="Email" required name="Email"></p>
            <p><input class="w3-input w3-border" type="text" placeholder="Subject" required name="Subject"></p>
            <p><input class="w3-input w3-border" type="text" placeholder="Message" required name="Message"></p>
            <p>
                <button class="w3-button w3-black" type="submit">
                    <i class="fa fa-paper-plane"></i> SEND MESSAGE
                </button>
            </p>
        </form>
        <!-- Image of location/map -->
        <img src="https://www.w3schools.com/w3images/map.jpg" class="w3-image w3-greyscale" style="width:100%;margin-top:48px">
    </div>
</div>

<!-- Footer -->
<footer class="w3-center w3-black w3-padding-64">
    <a href="#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
    <div class="w3-xlarge w3-section">
        <i class="fa fa-facebook-official w3-hover-opacity"></i>
        <i class="fa fa-instagram w3-hover-opacity"></i>
        <i class="fa fa-snapchat w3-hover-opacity"></i>
        <i class="fa fa-pinterest-p w3-hover-opacity"></i>
        <i class="fa fa-twitter w3-hover-opacity"></i>
        <i class="fa fa-linkedin w3-hover-opacity"></i>
    </div>
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a></p>
</footer>

<script>
    // Modal Image Gallery
    function onClick(element) {
        document.getElementById("img01").src = element.src;
        document.getElementById("modal01").style.display = "block";
        var captionText = document.getElementById("caption");
        captionText.innerHTML = element.alt;
    }


    // Toggle between showing and hiding the sidebar when clicking the menu icon
    var mySidebar = document.getElementById("mySidebar");

    function w3_open() {
        if (mySidebar.style.display === 'block') {
            mySidebar.style.display = 'none';
        } else {
            mySidebar.style.display = 'block';
        }
    }

    // Close the sidebar with the close button
    function w3_close() {
        mySidebar.style.display = "none";
    }
</script>
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

