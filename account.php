<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
$userid = $loggedInUser->user_id;
$userdetails = fetchUserDetails(NULL, NULL, $userid); //Fetch user details
/*
First, it calls the 'models/config.php' file. This file connects to the database and initiates all of our functions. Second, run the securePage() function. This function checks if the page we're on is public or private, and (if it's private) checks to see if we're logged in as a user who has access to the page. If it's private and we don't have access, we'll get sent to a page we do have access to. Third is our include for the Stripe configuration files so we can communicate with the Stripe servers.
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Thoroughwiz | Member Account Area</title>
<!-- Meta Data -->
<?php include("meta.php"); ?>
<!-- CSS Import -->
<?php include("style_block.php"); ?>
</head>
<body>
    <div class="wrapper">
  <?php include("header.php"); ?>
  <!--=== Breadcrumbs ===-->
  <div class="breadcrumbs">
    <div class="container">

      <?php echo '<h1 class="pull-left">Welcome '.$loggedInUser->email.'!</h1>'; ?>

      <ul class="pull-right breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li class="active">Members Account</li>
      </ul>
    </div>
  </div>
  <!--/breadcrumbs-->
  <!--=== End Breadcrumbs ===-->
  <!--=== Content Part ===-->
  <div class="container content">

	<?php include("assets/snippets/left-nav.php"); ?>

<?php
if(isUserLoggedIn()) {

  //********************************************************************************permission level 5 (Developer Role)
	if ($loggedInUser->checkPermission(array(5))){

        echo '<div class="col-md-6">
	        <div class="panel panel-default" >
            <div class="panel-heading">Available Race Sheets</div>
                <div class="panel-body">
                         <div class="table-responsive">

                         <table width="98%" align="center" cellpadding="3" cellspacing="0"  class="table table-bordered">
                            <tbody>
                               <tr class="panel-heading">
                                  <th style="color:#000;">Track and Date</th>
                                  <th style="color:#000;">Sheet Expiration</th>
                               </tr>';
                                  $dbsheets = fetchAllSheets($loggedInUser->user_id);
                								  if($dbsheets != NULL){
                									  foreach ($dbsheets as $sheets){
                                    $exp_date = date('m-d-Y H:i:s', strtotime($sheets['time'] . ' + 4 day'));
                										// Returns the file name, less the extension.
                										$sheet_id = $sheets['id'];
                										$sheet_name = preg_replace('/.[^.]*$/', '', $sheets['sheet']);
                										$sheet_name = substr($sheet_name, 0, -6);
                										$sheet_track = $sheets['racetrack'];
                										$sheet_date = date('m-d-Y', strtotime($sheets['racedate']));
                										$date_now = new DateTime();
                                    echo "<tr style='background-color:#72c02c;text-align:center;'>
                                    <td><h4 style='margin;0;padding:0;'>".$sheet_track."</h4>".$sheet_date."</td>
                                    <td width='150'>".$exp_date;

                                    if ($date_now > $sheet_date) {
                                          echo "<br><form action='user-delete-sheets.php' method='post' id='" .$sheet_track. "' class='deleteSheetSet'>
                                          <button type='submit' class='btn btn-success pull-center btn-sm btn-block'>
                                          <i class='fa fa-remove'></i>&nbsp;&nbsp;Delete This Set</button>
                                          <input type='hidden' name='sheetId' value='".$sheet_id."' />
                                          </form>";
                                    }

                                    echo "</td>
                                    </tr>

                                    <tr>
                                    <td>
                                    <form style='float:left;' action='scripts/test.php' method='post' enctype='multipart/form-data' target='_blank'>
                                            <input type='hidden' name='card' value='" .$sheets['sheet']. "'>
                                            <button type='submit' class='btn btn-primary btn-u-sm'><i class='fa fa-file-text-o'></i>&nbsp;&nbsp;PROGRAM</button>
                                    </form></td></tr>";
                           
                                }
            								  }

                          echo '</tbody>
                          </table>
                </div>
            </div>
        </div>
    </div>
	<div class="col-md-6">
        <div class="panel panel-default" >
            <div class="panel-heading">User Data</div>
                <div class="panel-body">
				<div>
                    <form name="updateAccount" id="user-update-form" action="user-update-account.php" method="post">
					<p>
                    <label>User Role:</label>
                    <input type="text" class="form-control" value="'.$loggedInUser->title.'" disabled/>
                    </p>
					<p>
                    <label>Registered Email:</label>
                    <input type="text" class="form-control" name="email" value="'.$loggedInUser->email.'" disabled/>
                    </p>
                    <p><a href="#" id="toggle-chg-pwd" style="font-weight:bold;">Change Password</a></p>

					<div id="chg-pwd" style="display:none;">
						<p>
						<label>Current Password:</label>
						<input type="password" class="form-control" name="password" required/>
						</p>
						<p>
						<label>New Password (8 to 50 characters):</label>
						<input type="password" class="form-control" name="passwordc" required/>
						</p>
						<p>
						<label>Confirm New Password:</label>
						<input type="password" class="form-control" name="passwordcheck" required/>
						</p>
						<p>
						<label>&nbsp;</label>
                        <button class="btn btn-success pull-right"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Change Password</button>
						<button type="reset" id="cancel-pw" class="btn btn-danger pull-right" style="margin-right:5px;"><i class="fa fa-ban"></i>&nbsp;&nbsp;Cancel</button>
						</p>
					</div>
                    </form>
                 </div>
			</div>
		</div>
	</div>';
	}

	//********************************************************************************permission level 1 (Administrator)
	if ($loggedInUser->checkPermission(array(1))){

        echo '<div class="col-md-6">
	        <div class="panel panel-default" >
            <div class="panel-heading">Available Race Sheets</div>
                <div class="panel-body">
                         <div class="table-responsive">

                         <table width="98%" align="center" cellpadding="3" cellspacing="0"  class="table table-bordered">
                            <tbody>
                               <tr class="panel-heading">
                                  <th style="color:#000;">Track and Date</th>
                                  <th style="color:#000;">Sheet Expiration</th>
                               </tr>';
                                  $dbsheets = fetchAllSheets($loggedInUser->user_id);
								  if($dbsheets != NULL){
									  foreach ($dbsheets as $sheets){
                                        $exp_date = date('m-d-Y H:i:s', strtotime($sheets['time'] . ' + 4 day'));
										// Returns the file name, less the extension.
										$sheet_id = $sheets['id'];
										$sheet_name = preg_replace('/.[^.]*$/', '', $sheets['sheet']);
										$sheet_name = substr($sheet_name, 0, -6);
										$sheet_track = $sheets['racetrack'];
										$sheet_date = date('m-d-Y', strtotime($sheets['racedate']));
										$date_now = new DateTime();
                                        echo "<tr style='background-color:#72c02c;text-align:center;'>
												<td><strong>".$sheet_track."</strong><br>".$sheet_date."</td>
												<td>".$exp_date;

												if ($date_now > $sheet_date) {
    													echo "<br><form action='user-delete-sheets.php' method='post' id='" .$sheet_track. "' class='deleteSheetSet'>
    													<button type='submit' class='btn btn-success pull-center btn-sm btn-block'>
    													<i class='fa fa-remove'></i>&nbsp;&nbsp;Delete This Set</button>
    													<input type='hidden' name='sheetId' value='".$sheet_id."' />
    													</form>";
												}

												echo "
												</td>
  												</tr>

												<tr>
												<td>
                                                <form style='display:inline' action='scripts/test.php' method='post' enctype='multipart/form-data' target='_blank'>
                                                            <input type='hidden' name='card' value='" .$sheets['sheet']. "'>
                                                            <button type='submit' class='btn btn-primary btn-u-sm'><i class='fa fa-file-text-o'></i>&nbsp;&nbsp;PROGRAM</button>
                                                </form>&nbsp;&nbsp;

                                                        <form style='display:inline' action='scripts/misty.php' method='post' enctype='multipart/form-data' target='_blank'>
                                                            <input type='hidden' name='card' value='" .$sheets['sheet']. "'>
                                                            <button type='submit' class='btn btn-primary btn-u-sm'><i class='fa fa-file-text-o'></i>&nbsp;&nbsp;MISTY</button>
                                                </form>&nbsp;&nbsp;
													</td>									                                   
												</tr>";
                                        }
								  }
                          echo '</tbody>
                          </table>
                </div>
            </div>
        </div>
    </div>
	<div class="col-md-6">
        <div class="panel panel-default" >
            <div class="panel-heading">User Data</div>
                <div class="panel-body">
				<div>
                    <form name="updateAccount" id="user-update-form" action="user-update-account.php" method="post">
					<p>
                    <label>User Role:</label>
                    <input type="text" class="form-control" value="'.$loggedInUser->title.'" disabled/>
                    </p>
					<p>
                    <label>Registered Email:</label>
                    <input type="text" class="form-control" name="email" value="'.$loggedInUser->email.'" disabled/>
                    </p>
                    <p><a href="#" id="toggle-chg-pwd" style="font-weight:bold;">Change Password</a></p>

					<div id="chg-pwd" style="display:none;">
						<p>
						<label>Current Password:</label>
						<input type="password" class="form-control" name="password" required/>
						</p>
						<p>
						<label>New Password (8 to 50 characters):</label>
						<input type="password" class="form-control" name="passwordc" required/>
						</p>
						<p>
						<label>Confirm New Password:</label>
						<input type="password" class="form-control" name="passwordcheck" required/>
						</p>
						<p>
						<label>&nbsp;</label>
                        <button class="btn btn-success pull-right"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Change Password</button>
						<button type="reset" id="cancel-pw" class="btn btn-danger pull-right" style="margin-right:5px;"><i class="fa fa-ban"></i>&nbsp;&nbsp;Cancel</button>
						</p>
					</div>
                    </form>
                 </div>
			</div>
		</div>
	</div>';
	} 
	//********************************************************************************permission level 2 (Free Member)
	if ($loggedInUser->checkPermission(array(2))){
    echo '<div class="col-md-8">
        <div class="panel panel-default" >
            <div class="panel-heading">Available Race Sheets</div>
                <div class="panel-body">
                         <div class="table-responsive">

                         <table width="98%" align="center" cellpadding="3" cellspacing="0"  class="table table-bordered">
                            <tbody>
                               <tr class="panel-heading">
                                  <th style="color:#000;">Track and Date</th>
                                  <th style="color:#000;">Sheet Expiration</th>
                               </tr>';
                                  $dbsheets = fetchAllSheets($loggedInUser->user_id);
								  if($dbsheets != NULL){
									  foreach ($dbsheets as $sheets){
                                        $exp_date = date('m-d-Y H:i:s', strtotime($sheets['time'] . ' + 4 day'));
										// Returns the file name, less the extension.
										$sheet_id = $sheets['id'];
										$sheet_name = preg_replace('/.[^.]*$/', '', $sheets['sheet']);
										$sheet_name = substr($sheet_name, 0, -6);
										$sheet_track = $sheets['racetrack'];
										$sheet_date = date('m-d-Y', strtotime($sheets['racedate']));
										$date_now = new DateTime();
                                        echo "<tr style='background-color:#72c02c;text-align:center;'>
												<td><strong>".$sheet_track."</strong><br>".$sheet_date."</td>
												<td>".$exp_date;

												if ($date_now > $sheet_date) {
    													echo "<br><form action='user-delete-sheets.php' method='post' id='" .$sheet_track. "' class='deleteSheetSet'>
    													<button type='submit' class='btn btn-success pull-center btn-sm btn-block'>
    													<i class='fa fa-remove'></i>&nbsp;&nbsp;Delete This Set</button>
    													<input type='hidden' name='sheetId' value='".$sheet_id."' />
    													</form>";
												}

												echo "
												</td>
  												</tr>

												<tr>
												<td>
                                                <form style='display:inline' action='scripts/test.php' method='post' enctype='multipart/form-data' target='_blank'>
                                                            <input type='hidden' name='card' value='" .$sheets['sheet']. "'>
                                                            <button type='submit' class='btn btn-primary btn-u-sm'><i class='fa fa-file-text-o'></i>&nbsp;&nbsp;PROGRAM</button>
                                                </form>&nbsp;&nbsp;

                                                       
													</td>									                                   
												</tr>";
                                        }
								  }
                          echo '</tbody>
                          </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-default" >
            <div class="panel-heading">Reserved Space</div>
                <div class="panel-body">
            </div>
        </div>
    </div>';
	}
	} //-- end is userLoggedIn()
	?>

    </div><!--/container-->

  <?php include("footer.php"); ?>
  <?php include("modals.php"); ?>

</div><!--/wrapper-->

<!--<div id="form-messages" title="Thoroughwiz says..." style="text-align:center;padding:5px;"></div>
<div id="passChangeDiv" title="Thoroughwiz says..." style="text-align:center;padding:5px;"></div>
<div id="dialog-confirm" title="Delete this set of race sheets?"></div>
<div id="logOutDiv" title="Logging Out" style="display:none;text-align:center;padding:5px;">
    <img src="img/loading11.gif" alt="loading" />
</div>
<div id="delSheetDiv" title="Deleting Sheet Set" style="display:none;text-align:center;padding:5px;">
    <img src="img/loading11.gif" alt="loading" />
</div>-->

<?php
	// conditional logic here to check if user needs to update from a temporary password
	if ($userdetails['pass_change'] == '1'){// if it is 1, user has not yet updated from the issued temp password
	echo '<script type="text/javascript">$(document).ready(function(){'
	. '$("#passChangeDiv").dialog({
				modal: true,
				draggable: false,
				autoOpen: false,
				closeOnEscape: false,
				dialogClass: "no-close",
				height: 175,
				width: 400,
				buttons: [
				  {
					text: "OK",
					click: function() {
					  $( this ).dialog( "close" );
					}
				  }
				]
			});'
	.'$("#passChangeDiv").html("You are using a temporary password!<br />Please update your password in your user profile!");'
	.'$("#passChangeDiv").dialog("open");'
	.'});'
    . '</script>';
	}
?>
<script>
  $(document).ready(function(){

      //pass sheet id to modal so it knows what sheet to fetch in summary.php
      $(".runWithFilters").click(function(){
            var passSheetId = $(this).data('id');// this is the value of bootstraps data-id
            $(".modal-body #sheetId").val(passSheetId);
      });

      //var queryString = $('#mainFilterForm').serialize();
      //alert(queryString);

      //submit filters form and reload account page at the same time to reset the form
      $('#mainFilterForm').on('submit', function(e) {
          e.preventDefault();
          setTimeout(function() {
               window.location.reload();
          },0);
          this.submit();
        });

      $("#logOutButton").click(function(){
			$("#logOutDiv").dialog("open");
		});

      $("#logOutDiv").dialog({
            modal: true,
            draggable: false,
            autoOpen: false,
            closeOnEscape: false,
            dialogClass: "no-close",
            height: 100
		});

      $("#delSheetDiv").dialog({
            modal: true,
            draggable: false,
            autoOpen: false,
            closeOnEscape: false,
            dialogClass: "no-close",
            height: 100
		});

	  //function to manually delete user sheets
      $(".deleteSheetSet").submit(function(e){
			e.preventDefault();
			var killForm = $(this);
			var formData = $(killForm).serialize();
            var sheetSet = $(this).attr('id');
			var formMessages = $('#form-messages');
			$("#dialog-confirm").html("You are about to delete the " + sheetSet + " sheet set.  Are you sure?");
					$("#dialog-confirm").dialog({
						autoOpen: false,
						modal: true,
						buttons : {
					        "Delete" : function() {
					        	killSheetSet(formData, formMessages);// call to function below
					        	$(this).dialog("close");
					        },
					        "Cancel" : function() {
					        	$(this).dialog("close");
					        }
					      }
					});
			$("#dialog-confirm").dialog("open");
		});

      //function to delete sheet from database (but not the uploads folder!! The folder is cleaned via cron job)
      function killSheetSet(formData, formMessages){
        $("#delSheetDiv").dialog("open");
	  	$.ajax({
			  url: 'user-delete-sheets.php',
			  type: 'POST',
			  data: formData,
			  dataType: 'json',
			  	success: function(data) {
                    $("#delSheetDiv").dialog("close");
					$("#dialog-confirm").html(data[0]);
                    $('#dialog-confirm').dialog('option', 'title', 'Sheet Deletion Confirmation');
					$("#dialog-confirm").dialog({
						autoOpen: false,
						modal: true,
						buttons: [ {
							text: "Ok", click: function() {
								location.reload(true);
								$(this).dialog("close");
							}
						}]
					});
					$("#dialog-confirm").dialog("open");
				},
			  	error: function(response, xhr) {
                    $("#delSheetDiv").dialog("close");
				  	console.log(response);
			  		$(formMessages).html(xhr.responseText);
					$(formMessages).dialog({
						autoOpen: false,
						modal: true,
						buttons: [ {
							text: "Ok", click: function() {
								$(this).dialog("close");
							}
						}]
					});
					$(formMessages).dialog("open");
			  	}
			}); // end ajax call
		} // end killSheetSet function

	$(function () {

		// feature detection for required attribute
		var supportsRequired = 'required' in document.createElement('input')

			// if 'required' isn't supported
			if (!supportsRequired) {

				// loop through each element with a 'required' attribute
				$('[required]').each(function () {

					// this
					var self = $(this)

					// swap attribute for class
					self.removeAttr('required').addClass('required');

					// append an error message
					self.parent().append('<span class="form-error">Required</span>')

				}); //end each loop

			}; // end if supportsrequired



		// submit the form
		$('#user-update-form').on('submit', function (e) {

			// if 'required' isn't supported
			if (!supportsRequired) {

				// loop through class name required
				$('.required').each(function () {

					// this
					var self = $(this)

					// check shorthand if statement for input[type] detection
					var checked = (self.is(':checkbox') || self.is(':radio'))
					? self.is(':not(:checked)') && $('input[name=' + self.attr('name') + ']:checked').length === 0
					: false

					// run the empty/not:checked test
					if (self.val() === '' || checked) {

						// show error if the values are empty still (or re-emptied)
						// this will fire after it's already been checked once
						self.siblings('.form-error').show()

						// stop form submitting
						e.preventDefault()

					}

				}) // close each loop

				if ($("#password").val().length !==0 && $("#passwordc").val().length !==0 && $("#passwordcheck").val().length !==0){
					// Get the form.
					var form = $('#user-update-form');

					// Get the messages div.
					var formMessages = $('#form-messages');

					// Stop the browser from submitting the form.
					e.preventDefault();

					// Serialize the form data.
					var formData = $(form).serialize();

					$.ajax({
					  url: $(form).attr('action'),
					  type: 'POST',
					  data: formData,
					  dataType: 'json',
					  success: function(data) {
							$(formMessages).html(data[0]);
							$(formMessages).dialog({
						autoOpen: false,
						modal: true,
						buttons: [ {
							text: "Ok", click: function() {
							$( this ).dialog( "close" );
						}
						} ]
					});
							$(formMessages).dialog("open");
							if(data[1] == "match"){
								$("#chg-pwd").hide();
							}
					  },
					  error: function(xhr, desc, err) {
						  //$(formMessages).html("Details: " + desc + "\nError:" + err + "\nError:" + eval(xhr));
							$(formMessages).html("The system has encountered an error");
							$(formMessages).dialog({
						autoOpen: false,
						modal: true,
						buttons: [ {
							text: "Ok", click: function() {
							$( this ).dialog( "close" );
						}
						} ]
					});
							$(formMessages).dialog("open");
					  }
					}); // end ajax call

				} // close if/else

			} else { // if required attribute IS supported, we can let HTML 5 handle the validation and jump right to the ajax

					// Get the form.
					var form = $('#user-update-form');

					// Get the messages div.
					var formMessages = $('#form-messages');

					// Stop the browser from submitting the form.
					e.preventDefault();

					// Serialize the form data.
					var formData = $(form).serialize();

					$.ajax({
					  url: $(form).attr('action'),
					  type: 'POST',
					  data: formData,
					  dataType: 'json',
					  success: function(data) {
							$(formMessages).html(data[0]);
							$(formMessages).dialog({
						autoOpen: false,
						modal: true,
						buttons: [ {
							text: "Ok", click: function() {
							$( this ).dialog( "close" );
						}
						} ]
					});
							$(formMessages).dialog("open");
							if(data[1] == "match"){
								$("#chg-pwd").hide();
							}
					  },
					  error: function(xhr, desc, err) {
							//$(formMessages).html("Details: " + desc + "\nError:" + err + "\nError:" + eval(xhr));
							$(formMessages).html("The system has encountered an error");
							$(formMessages).dialog({
						autoOpen: false,
						modal: true,
						buttons: [ {
							text: "Ok", click: function() {
							$( this ).dialog( "close" );
						}
						} ]
					});
							$(formMessages).dialog("open");
					  }
					}); // end ajax call

			}

		}) // close submit function

		// key change on all form inputs i.e user enters and exits a form field
		$('input').on('blur change', function () {

			// this
			var self = $(this)

			// check shorthand if statement for input[type] detection
			var checked = (self.is(':checkbox') || self.is(':radio'))
			? self.is(':not(:checked)') && $('input[name=' + self.attr('name') + ']:checked').length === 0
			: false

			// if empty on change, i.e. if data is removed
			if (self.val() === '' || checked) {

				// show/keep the error in view
				self.siblings('.form-error').show()

			// if there's a value or checked
			} else {

				// hide the error
				self.siblings('.form-error').hide()

			}

		}) // close input blur/change

	}) // close main function

});

//$(document).ajaxStop(function() { location.reload(true); });
</script>
</body>
</html>
