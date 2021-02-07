<?php
/**
 * Created by PhpStorm.
 * User: Shailesh Suryawanshi
 * Date: 08-02-2018
 * Time: 10:01
 */
echo '<style>
		.tableborder {
			border-collapse: collapse;
			width: 100%;
			border-color:#eee;
		}

		.tableborder th, .tableborder td {
			text-align: left;
			padding: 8px;
			border-color:#eee;
		}

		.tableborder tr:nth-child(even){background-color: #f2f2f2}
		
    .mo_update_app_table{
        width: 100%;
    }
    .mo_update_app_table tr >td:first-child {
        width: 30%;
    }

    .mo_update_app_table tr >td input {
        width: 90%;
    }

    .save-settings{
        margin-left: 30%;
        margin-right: 30%;

    }
	</style>';
echo '
<div class="mo_registration_divided_layout">
	<div class="mo_gsuite_registration_table_layout">';

//is_gsuite_customer_registered();

echo    '<div id="toggle2" class="panel_toggle">
			<h3>Add Application</h3>
		</div>
		<form  id="form-common" name="form-common" method="post" action="">
		<input type="hidden" name="option" value="mo_oauth_add_app_new" />
		<table class="mo_update_app_table">
			<tr>
			<td><strong>&nbsp;&nbsp;Application:</strong></td>
			<td>
				<input style="display:none" class="mo_table_textbox" type="text" id="mo_oauth_app" name="mo_oauth_app_name" value="google">&nbsp&nbspGoogle
			</td>
			</tr>
			<tr  style="display:none" id="mo_oauth_custom_app_name_div">
				<td><strong><font color="#FF0000">*</font>Custom App Name:</strong></td>
				<td><input class="mo_table_textbox" type="text" id="mo_oauth_custom_app_name" name="mo_oauth_custom_app_name" value=""></td>
			</tr>
			<tr>
				<td><strong><font color="#FF0000">*</font>Client ID:</strong></td>
				<td><input class="mo_table_textbox" id="cl_id" required type="text" name="mo_oauth_client_id" value=""></td>
			</tr>
			<tr>
				<td><strong><font color="#FF0000">*</font>Client Secret:</strong></td>
				<td><input  class="mo_table_textbox" required type="text"  name="mo_oauth_client_secret" value=""></td>
			</tr>
			<tr>
				<td><strong>Scope:</strong></td>
				<td><input  class="mo_table_textbox" id="ga_scope" type="text" name="mo_oauth_scope" value="email"></td>
			</tr>
			<tr id="mo_oauth_authorizeurl_div">
				<td><strong><font color="#FF0000">*</font>Authorize Endpoint:</strong></td>
				<td><input disabled class="mo_table_textbox" type="text" id="mo_oauth_authorizeurl" name="mo_oauth_authorizeurl" value="https://accounts.google.com/o/oauth2/auth"></td>
			</tr>
			<tr id="mo_oauth_accesstokenurl_div">
				<td><strong><font color="#FF0000">*</font>Access Token Endpoint:</strong></td>
				<td><input disabled class="mo_table_textbox" type="text" id="mo_oauth_accesstokenurl" name="mo_oauth_accesstokenurl" value="https://www.googleapis.com/oauth2/v4/token"></td>
			</tr>
			<tr id="mo_oauth_resourceownerdetailsurl_div">
				<td><strong><font color="#FF0000">*</font>Get User Info Endpoint:</strong></td>
				<td><input disabled  class="mo_table_textbox" type="text" id="mo_oauth_resourceownerdetailsurl" name="mo_oauth_resourceownerdetailsurl" value="https://www.googleapis.com/oauth2/v1/userinfo"></td>
			</tr>';
			?>
			
			        <tr><td><strong>Client Authentication:</strong></td><td><div style="padding:5px;"></div><input style="width:2%;" class="mo_table_textbox" type="radio" name="disable_authorization_header" id="disable_authorization_header" <?php echo get_option('mo_oauth_client_disable_authorization_header') ? '' : 'checked'; ?> value="0">HTTP Basic (Recommended)<div style="padding:5px;"></div><input style="width:2%;" class="mo_table_textbox" type="radio" name="disable_authorization_header" id="disable_authorization_header" value="1" <?php echo get_option('mo_oauth_client_disable_authorization_header') ? 'checked' : ''; ?>>Request Body<div style="padding:5px;"></div></td></tr>

			
			<?php
			
			echo '
			<!--<tr style="display:none" id="mo_oauth_email_attr_div">
				<td><strong><font color="#FF0000">*</font>Email Attribute:</strong></td>
				<td><input class="mo_table_textbox" type="text" id="mo_oauth_email_attr" name="mo_oauth_email_attr" value=""></td>
			</tr>
			<tr style="display:none" id="mo_oauth_name_attr_div">
				<td><strong><font color="#FF0000">*</font>Name Attribute:</strong></td>
				<td><input class="mo_table_textbox" type="text" id="mo_oauth_name_attr" name="mo_oauth_name_attr" value=""></td>
			</tr>-->
			<tr><td><br></td></tr>
			<tr>
				<td>&nbsp;</td>
				<td><input  type="submit" name="submit" style="width:20%"value="Save settings"
					class="button button-primary button-large" />
				</td>
			</tr>
			</table>
		</form>
		</br></br>
		
		<div id="instructions"></div>
		</div>
		</div>
';?>


<?php
/*echo '<script>
			jQuery(document).ready(function() {
			    document.getElementById("instructions").innerHTML  ="' . $google_instructions_new_style . '";});
			
			function selectapp() {
				var appname = document.getElementById("mo_oauth_app").value;
				
				console.log(appname);
				
				 switch(appname){
			        case "google":
			            document.getElementById("instructions").innerHTML  ="' . $google_instructions . '";
			            break; 
			        default:
			            break;
			    	}
				}

		</script>';*/
		
?>
<script>
			jQuery(document).ready(function() {
			    document.getElementById("instructions").innerHTML  ="<?php 
				$is_new_customer_setup = get_option('mo_oauth_new_customer_configuration');
				if($is_new_customer_setup == '1'){
					echo $google_instructions_new_style;
				}else{
					echo $google_instructions_new_style;
				}					?>";
			});
			
			function selectapp() {
				var appname = document.getElementById("mo_oauth_app").value;
				
				console.log(appname);
				
				 switch(appname){
			        case "google":
			            document.getElementById("instructions").innerHTML  ="' . $google_instructions . '";
			            break; 
			        default:
			            break;
			    	}
				}

		</script>