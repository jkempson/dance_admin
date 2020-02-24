<?php

class User_model extends CI_Model
{
	public function authenticate($username, $password)
    {
	    $username = strtolower($username);
        if ($this->db->select('username')->get_where('Users', array('username' => $username)))
        {
            // hash password with salt and find user
            $hash = sha1(sha1($username.$password));
            $user = $this->db->select('id')->get_where('Users', array(
                'username' => $username,
                'hash' => $hash
            ))->row();
        
            return $user;
        }
        return false;
    }
    
    public function recordlogin($username, $success)
    {
	    $data = array (
	    'username' 		=> $username,
	    'authenticate'  => $success,
	    'ip'	   		=> $_SERVER['REMOTE_ADDR'],
	    'epoch'    		=> time()
	    );
	    $this->db->insert('login_log', $data); 
    }
}
?>