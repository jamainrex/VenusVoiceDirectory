<?php
if(!class_exists('TT_Security')){
	class TT_Security extends TeslaFrameworkPL {

		public $username;
		public $license = NULL;
		public $state = 'active';
		public $update_key = 'teslathemes_encription_key';
		public $custom_error_message = NULL;

		function __construct(){
			$this->username = ($this->get_license())?base64_decode(file_get_contents($this->get_license())):NULL;
			if( isset($_GET['updated']) && $_GET['updated'] === 'retry_auth' )
				delete_transient( 'security_api_result' );
		}

		function get_license(){
			$location = TT_THEME_DIR . "/theme_config/tt_license.txt";
			if (file_exists($location)){
				$this->license = $location;			
				return $location;
			}else{
				$this->state = 'corrupt';
				return NULL;
			}
		}

		public function check_state(){
			$this->check_username();
			return $this->throw_errors();
		}

		public function throw_errors(){
			switch ($this->state) {
				case 'active':
					break;
				case 'warning' :
					$this->error_message(true);
					break;
				case 'no data':
					$this->error_message(true,"<span>Error :</span> '<em>" . $this->custom_error_message . "'</em><br><hr>");
					break;
				case 'blocked':
					$this->error_message();
					return FALSE;
				case 'corrupt':
					$this->error_message( false, "<span>Note :</span> Don't change the code or license file contents please." , false );
					return FALSE;
			}
			return TRUE;
		}

		public function change_state($new_state){
			$this->state = $new_state;
			return;
		}

		public function check_username(){
			if ($this->username){
				if( in_array( $this->username, array( 'tt_general_user','tt_other_marketplaces_user','themeforest','mojomarketplace','creativemarket' ) ) ){
					
					/** 
					* @since 1.9.2
					*/
					if(!get_transient( 'tt_user_checked' )){
						$checkuser = wp_remote_retrieve_body( wp_remote_get( add_query_arg( array('source' => 'fw' , 'action' => 'checkuser','user' => get_option( 'admin_email' )), "http://teslathemes.com/api/" ) ) );
						if($checkuser)
							set_transient( 'tt_user_checked', $checkuser );
					}

					return;
				}
				$result = get_transient( 'security_api_result' );
				if(!$result){
					$api = wp_remote_get( 'http://teslathemes.com/amember/api/check-access/by-login?_key=n7RYtMjOm9qjzmiWQlta&login=' . $this->username , array('timeout' => 15) );

					if(!empty($api) && !is_wp_error( $api )){
						$result = json_decode(wp_remote_retrieve_body($api));
						set_transient( 'security_api_result', $result, 12 * HOUR_IN_SECONDS );
					}else{
						if(is_wp_error( $api )){
							$this->custom_error_message = $api->get_error_message();
						}
						$this->state = 'no data' ;
						return;
					}
				}
				
				if ( !empty($result->ok) ){
					if (!empty($result->subscriptions)){
						if ( !empty($result->subscriptions->{28}) ){
							$this->state = 'blocked' ;
						}elseif(!empty($result->subscriptions->{34})){
							$this->state = 'warning' ;
						}
					}
				}else{
					$this->state = 'no data';
					$this->custom_error_message = !empty($result->msg) ? $result->msg : null;
				}
			}else
				$this->state = 'corrupt';
			return;
		}

		private function error_message( $just_warning = null, $custom = null, $retry_auth = true ){
			echo "<div class='wrap'><div id='result_content' class='welcome-panel'><div id='tt_import_alert'>";
			if($custom)
				print $custom;
			if ( $just_warning )
				echo '<span>WARNING :</span> We noticed some fraudulent activity with our theme <b>OR</b> couldn\'t connect to our servers for some reasons (check with your host that your server can connect to teslathemes.com). If you still can\'t fix it please contact us in 5 days to fix this or '.THEME_PRETTY_NAME.' framework page will be blocked.<br> <span>State : ' . $this->state . '</span>';
			else{
				echo 'The '.THEME_PRETTY_NAME.' page is <span>blocked</span> by TeslaThemes due to some <span>fraudulent action</span>.<br> Please contact us at support@teslathemes.com or click the link below to correct your license if you think that this is a mistake. <br><span>State : ' . $this->state . '</span>';
			}
			$mail_body = rawurlencode("Insert Your Credentials Below \n \n ================== \n WP INSTALLATION URL: \n WP USERNAME: \n WP PASSWORD: \n \n FTP HOST: \n FTP USERNAME: \n FTP PASSWORD: \n ======================= \n");
			echo "</div><p><a target='_blank' href='mailto:support@teslathemes.com?subject=[".THEME_NAME."]%20Security&body=$mail_body' class='button'>Contact TeslaThemes</a>";
			if( $retry_auth ){
				$retry_auth_url = add_query_arg(array('updated'=>'retry_auth'));
				echo "&nbsp;<a href='$retry_auth_url' class='button'>Retry Theme Authentication</a>";
			}
			echo "</p></div></div>";
			return;
		}

	}
}