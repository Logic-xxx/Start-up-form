<?php
$so= " ";
$filePath=" ";
$get=" ";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $target_dir = "images/";
    if(!(file_exists($target_dir))){
        mkdir("images");
    }
    $target_file = $target_dir . basename($_FILES["userImage"]["tmp_name"]);

    echo "File Path:" . $target_file . "<br>";
    if(move_uploaded_file($_FILES['userImage']['tmp_name'],$target_file)) {
//    $imgData = addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
//    $imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
//    $so=fopen($_FILES["userImage"]["tmp_name"], 'r');
    $filePath = realpath($_FILES["userImage"]["tmp_name"]);
    $get=$fp = fopen($target_file, "r");
}
}

?>
<form name="frmImage" enctype="multipart/form-data" action=""
      method="post" class="frmImageUpload">
    <label>Upload Image File:</label><br/>
    <input name="userImage" type="file" class="inputFile"/>
    <input type="submit" value="Submit" class="btnSubmit"/>

</form>
<?php echo $target_file;?>
<img style="width: 5%" src="<?=$target_file ?>">
