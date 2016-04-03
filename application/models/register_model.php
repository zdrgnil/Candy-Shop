<?php
class Register_model extends CI_Model {

	function input_validate($fname, $lname, $username, $password, $email){
		$error['count']=0;
		if(strlen($fname)<3 || strlen($fname)>15){
			$error['count']++;
			//$error['fname']=
		}
	}

	public function submit_to_db($fname, $lname, $username, $password, $email) {
		return $this->db->insert('customer', 
			array('first' => $fname,
					'last' => $lname,
					'login' => $username,
					'password' => $password,
					'email' => $email));
	}
}
?>