<?php 

class Company_login_model extends CI_model
{
	
	function can_login($email, $password)	
	{
		$this->db->where('email', $email);	
		$query = $this->db->get('company');

		if ($query->num_rows() > 0) {	

			foreach ($query->result() as $row) {

				if ($row->active == '1') {
					$store_password = $this->encryption->decrypt($row->password);

					if ($password == $store_password) {

						$this->session->set_userdata('companyid', $row->id);
						return true;
					}
					return 'Wrong Password';
				}
				return 'First verified your email address';
			}
		}
		return "Wrong Email Address";
	}

}

?>