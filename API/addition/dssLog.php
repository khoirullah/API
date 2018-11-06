<?php 
require( dirname(__FILE__) . '/wp-load.php' );

//$status = 
$crs = $_GET['crs'];
$guid = $_GET['guid'];
$user_name = substr ($guid, 9,4);
//$usr = substr ($_GET['status'], 5,10);
//0056d4e9-e9f9-4d8c-9d41-1287169df8cf
$course = get_post_field( 'post_title', $crs);

$random_password = 'passw0rd';
$user_email = 'klob.'.$user_name.'@klob.id';

//ngambil data user dari db wp
$user_info = get_user_by( 'email', $user_email);
if ($user_info==null) {
	$user_id = username_exists( $user_name );//check udeh ade blom nih username
	if ( !$user_id and email_exists($user_email) == false ) {
		$user= wp_create_user( $guid, $random_password, $user_email );//create user
		if(!$user){
			echo 'null';
		}
		else{
			$vsessionid = session_id();
			if (empty($vsessionid)) {
				session_name('PHPSESSID'); 
				session_start();
				echo 'gak pak eko';
			}
			wp_clear_auth_cookie();
			$creds = array();
            $creds['user_login'] = $user_name;
            $creds['user_password'] = $random_password;
            $creds['remember'] = true;
            $sso = wp_signon($creds, false);
            if (!$sso) {
                echo 'error pak eko';
            }
			else{
				wp_set_current_user($user_id);
                do_action('set_current_user');
                $current_user = wp_get_current_user();
				if(!$current_user){
					echo'NULL';
				}
				else{
					wp_redirect( home_url() ); 
					exit;
					//header('Location: http://www.lms.eztudia.com/wp-admin');
					//echo'alert('mantul');';
				}
			}
		}
	}
	else{echo'udah ada';}
}
else{
	echo $user_info->login;
}
?> 