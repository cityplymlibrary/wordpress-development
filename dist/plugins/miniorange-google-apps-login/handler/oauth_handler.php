<?php

class Mo_OAuth_Hanlder {

	function getAccessToken($tokenendpoint, $grant_type, $clientid, $clientsecret, $code, $redirect_url){
		$response = $this->getToken ($tokenendpoint, $grant_type, $clientid, $clientsecret, $code, $redirect_url);
		$content = json_decode($response,true);
		if(isset($content["access_token"])) {
			return $content["access_token"];
			exit;
		} else {
			echo 'Invalid response received from OAuth Provider. Contact your administrator for more details.<br><br><b>Response : </b><br>'.$response;
			exit;
		}
	}

	function getToken($tokenendpoint, $grant_type, $clientid, $clientsecret, $code, $redirect_url){

		if( get_option( 'mo_oauth_client_custom_token_endpoint_no_csecret' ) ) {
			$body = array(
				'grant_type'    => $grant_type,
				'code'          => $code,
				'client_id'     => $clientid,
				'redirect_uri'  => $redirect_url,
			);
		} else {
			$body = array(
				'grant_type'    => $grant_type,
				'code'          => $code,
				'client_id'     => $clientid,
				'client_secret' => $clientsecret,
				'redirect_uri'  => $redirect_url,
			);
		}
		
		$response   = wp_remote_post( $tokenendpoint, array(
			'method'      => 'POST',
			'timeout'     => 45,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking'    => true,
			'headers'     => array(
				'Accept'  => 'application/json', 
				'charset'       => 'UTF - 8', 
				'Authorization' => 'Basic ' . base64_encode( $clientid . ':' . $clientsecret ),
				'Content-Type' => 'application/x-www-form-urlencoded',
			),
			'body'        => $body,
			'cookies'     => array(),
			'sslverify'   => false
		) );
		if ( is_wp_error( $response ) ) {
			wp_die( $response );
		}
		$response =  $response['body'] ;

		if(!is_array(json_decode($response, true))){
			echo "<b>Response : </b><br>";print_r($response);echo "<br><br>";
			exit("Invalid response received.");
		}
		
		$content = json_decode($response,true);
		if(isset($content["error_description"])){
			exit($content["error_description"]);
		} else if(isset($content["error"])){
			exit($content["error"]);
		}
		
		return $response;
	}
	
	function getIdToken($tokenendpoint, $grant_type, $clientid, $clientsecret, $code, $redirect_url){
		$response = $this->getToken ($tokenendpoint, $grant_type, $clientid, $clientsecret, $code, $redirect_url);
		$content = json_decode($response,true);
		if(isset($content["id_token"]) || isset($content["access_token"])) {
			return $content;
			exit;
		} else {
			echo 'Invalid response received from OpenId Provider. Contact your administrator for more details.<br><br><b>Response : </b><br>'.$response;
			exit;
		}
	}

	function getResourceOwnerFromIdToken($id_token){
		$id_array = explode(".", $id_token);
		if(isset($id_array[1])) {
			$id_body = base64_decode($id_array[1]);
			if(is_array(json_decode($id_body, true))){
				return json_decode($id_body,true);
			}
		}
		echo 'Invalid response received.<br><b>Id_token : </b>'.$id_token;
		exit;
	}
	
	function getResourceOwner($resourceownerdetailsurl, $access_token){
		$headers = array();
		if(get_option('mo_oauth_client_disable_authorization_header') == false) {
			$headers['Authorization'] = 'Bearer '.$access_token;
		}
		$response   = wp_remote_post( $resourceownerdetailsurl, array(
			'method'      => 'GET',
			'timeout'     => 45,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking'    => true,
			'headers'     => $headers,
			'cookies'     => array(),
			'sslverify'   => false
		) );

		$response =  $response['body'] ;

		if(!is_array(json_decode($response, true))){
			echo "<b>Response : </b><br>";print_r($response);echo "<br><br>";
			exit("Invalid response received.");
		}
		
		$content = json_decode($response,true);
		if(isset($content["error_description"])){
			exit($content["error_description"]);
		} else if(isset($content["error"])){
			exit($content["error"]);
		}

		return $content;
	}
	
	function getResponse($url){
		$response = wp_remote_get($url, array(
			'method' => 'GET',
			'timeout' => 45,
			'redirection' => 5,
			'httpversion' => 1.0,
			'blocking' => true,
			'headers' => array(),
			'cookies' => array(),
			'sslverify' => false,
		));

		$content = json_decode($response,true);
		if(isset($content["error_description"])){
			exit($content["error_description"]);
		} else if(isset($content["error"])){
			exit($content["error"]);
		}
		
		return $content;
	}
	
}

?>