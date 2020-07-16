<!--SET ERROR HANDLER-->
<!--//THIS IS NOT MEANINGFUL PAGE-->
<!DOCTYPE html>
<html>
<body>

<?php
// A user-defined error handler function
function myErrorHandler($errno, $errstr, $errfile, $errline) {
    echo "<b>Custom error:</b> [$errno] $errstr<br>";
    echo " Error on line $errline in $errfile<br>";
    die();
}

// Set user-defined error handler function
set_error_handler("myErrorHandler");

$test=2;

// Trigger error
if ($test>1) {
    trigger_error("A custom error has been triggered");
}

// Restore previous error handler
restore_error_handler();

// Trigger error again
?>

</body>
</html>
<!--SET EXCEPTION HANDLER-->
<?php
$asa=2;
?>
<!DOCTYPE html>
<html>
<body>

<?php
// A user-defined exception handler function
function myException($exception) {
    echo "<b>Exception:</b> ", $exception->getMessage();
}

// Set user-defined exception handler function
set_exception_handler("myException");
if($asa<1) {
// Throw exception
    throw new Exception("Uncaught exception occurred!");
}
?>

</body>
</html>

<!--TEAM FORM-->
<div id="div2">
    <h3>Team</h3>
    <input type="text" name="teamName" placeholder="Team  name"><br>
    <p>When your team is created?</p>
    <input style="margin-top: 5px" type="date" name="teamDate" placeholder="Your birth date"><br>
    <input style="margin-top: 5px" type="text" name="teamEmail" placeholder="Team email"><br>
        <input style="margin-top: 5px" type="number" name="teamSize" placeholder="Team size"><br>
</div>
<div id="div3">
    <h3>Individual</h3>
    <input type="text" name="singleName" placeholder="Your name"><br>
    <input style="margin-top: 5px" type="date" name="singleDate" placeholder="Your birth date"><br>
    <input style="margin-top: 5px" type="text" name="singleEmail" placeholder="Your email"><br>
    <input style="margin-top: 5px" type="text" name="singleNumber" placeholder="Your cell number"><br>
</div>