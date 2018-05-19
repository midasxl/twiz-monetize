<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
<title>Handicapping horse racing Thoroughwiz</title>
<!-- Meta Data -->
<?php include("meta.php"); ?>
<!-- CSS Import -->
<?php include("style_block.php"); ?>
</head>
    
<body>
    
<div class="wrapper">
    
	<?php include("header.php"); ?>
    
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3>Twiz buttons</h3>
                <p>Submit button with font awesome:<br>
                    <button type="submit" class="btn btn-success pull-center"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;Log In</button></p>
                <p>Submit button with glyphicon:<br>
                    <button type="submit" class='btn btn-success'><span class="glyphicon glyphicon-gift"></span>&nbsp;&nbsp;View Free Samples!</button></p>
                
                <p>Anchor tag with font awesome:<br>
                    <a href="#" target="_blank" class="btn btn-success"><i class="fa fa-video-camera"></i>&nbsp;&nbsp;Video</a></p>
                <p>Anchor tag with glyphicon:<br>
                    <a href='register.php' class='btn btn-success'><span class='glyphicon glyphicon-user'></span>&nbsp;&nbsp;Register Now!</a></p>
            </div>

        </div>
    </div>

<?php include("footer.php"); ?>
    
</div>

</body>
    
</html>