<!DOCTYPE html>
<html lang="en">
<head>

<title>Handicapping horse racing Thoroughwiz</title>
<!-- Meta Data -->
<!-- Meta -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A horse racing sheet which uses a unique algorithm designed over years of observation and testing to produce a special ranking called the TWIZrank.">
<meta name="keywords" content="Thoroughwiz, trainer, Jockey, horse, ratings, speed, speed figures, firgures, pace, equibase, trackmaster, handicapping, handicapper, sheets">
<meta name="author" content="ThoroughWiz">
<meta name="robots" content="index, follow">
<meta name="googlebot" content="index">
<META NAME="ROBOTS" CONTENT="INDEX, FOLLOW">

<!-- CSS Import -->
    <!-- CSS Global Compulsory -->

    <script type="text/javascript">
//<![CDATA[
window.__cfRocketOptions = {byc:0,p:0,petok:"175c031cbbc70f30213cb5c9c9b340c288d4d7f0-1524767351-1800"};
//]]>
</script>
<script type="text/javascript" src="https://ajax.cloudflare.com/cdn-cgi/scripts/935cb224/cloudflare-static/rocket.min.js"></script>
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css"><!-- framework -->
    
    <link rel="stylesheet" href="assets/css/style.css"><!-- template -->

    <!-- CSS Implementing Plugins -->

    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css"><!-- font awesome fonts -->

    <!-- jquery UI -->
    
    <link rel="stylesheet" href="assets/css/ui-theme/jquery-ui.min.css" rel="stylesheet">

    <!-- CSS Customization Bitches!-->

    <link rel="stylesheet" href="assets/css/custom.css"><!-- custom css -->

    <!-- jquery range slider -->

    <link rel="stylesheet" href="assets/css/plugins/rangeslider.css">
</head>
<body>
	
	
	<?php

if(isset($_POST['sub']))
{
	$txt1=$_POST['n1'];
	$txt2=$_POST['n2'];
	$oprnd=$_POST['sub'];
	
	if($oprnd=="+")
	$res=$txt1+$txt2;
	else if($oprnd=="-")
		$res=$txt1-$txt2;
		else if($oprnd=="x")
		$res=$txt1*$txt2;
		else if($oprnd=="/")
			$res=$txt1/$txt2;
}
?>

<form method="post" action="">
Calculator
<br>
No1:<input name="n1" value="<?php echo $txt1; ?>">
<br>
No2:<input name="n2" value="<?php echo $txt2; ?>">
<br>
Res:<input name="res" value="<?php echo $res; ?>">
<br>
<input type="submit" name="sub" value="+">
<input type="submit" name="sub" value="-">
<input type="submit" name="sub" value="x">
<input type="submit" name="sub" value="/">
</form>
	
	
	
	hlb=(lenback2ndCall)
half = (hlb+position2)/2

Speed=(((100+(43.20 - (leadertime))*10)-$half))+(CHOSEN SPEED FIGURE/10)


class = CHOSEN SPEED FIGURE + Compantline LB 1 + finish LB

Misty's Speed Fig=
((speed-(speed-class))-Post time odds -Morning Line odds decimal

Twiz is an (average of all MSF's )


	
<script type="text/rocketscript">
$(document).ready(function(){

    $("#logInDiv").dialog({
        modal: true,
        draggable: false,
        autoOpen: false,
        closeOnEscape: false,
        dialogClass: "no-close",
        height: 100
    });

    $(document).ajaxStart(function(){
        $("#logInDiv").dialog("open");
    });

    $(document).ajaxStop(function(){
        $("#logInDiv").dialog("close");
    });

    // submit the form
    $("#homepage-login-form").on("submit", function (e) {

        // Stop the browser from submitting the form.
        e.preventDefault();

        // Get the form.
        var form = $("#homepage-login-form");

        // Get the messages div.
        var formmessages = $("#form-messages");
        var logInGood = $("#logInGood");

        // Serialize the form data.
        var formData = $(form).serialize();

        $.ajax({
          url: $(form).attr("action"),
          type: "POST",
          data: formData,
          dataType: "json",
          success: function(data) {
              if(data[0] == "match"){
                  $(logInGood).html("Retrieving membership Data...");
                  $(logInGood).dialog({
                    modal: true,
                    draggable: false,
                    autoOpen: false,
                    closeOnEscape: false,
                    dialogClass: "no-close",
                    height: 100
                });
                $(logInGood).dialog("open");
                setTimeout(function(){ document.location.href = "account.php"; }, 3000);
              }else{
                $(formmessages).html(data[0]);
                $(formmessages).dialog({
                    autoOpen: false,
                    modal: true,
                    buttons: [{
                         text: "Ok", click: function() {
                            $( this ).dialog( "close" );
                         }
                    }]
                });
                $(formmessages).dialog("open");
              }
          },
          error: function(xhr, desc, err) {
                $(formmessages).html("The system has encountered an error");
                $(formmessages).dialog({
                    autoOpen: false,
                    modal: true,
                    buttons: [{
                         text: "Ok", click: function() {
                            $( this ).dialog( "close" );
                         }
                    }]
                });
                $(formmessages).dialog("open");
          }
        });
    })
});
</script>

</body>
</html>