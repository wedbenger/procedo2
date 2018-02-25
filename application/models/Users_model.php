<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users_model extends CI_Model 
{
    
    public function __construct() {
        parent::__construct();
    }

    //get all active contacts from the db
	public function login($user, $password) {   
        //select using the variable passed
        $where = array('user' => $user);
        //order by date registered desc
        $this->db->where($where);

        //get the users
        $users = $this->db->get('users')->result();

        //check the password
        foreach($users as $user) {
            $hash = $user->password;
            if (crypt($password, $hash) != $hash) {
                return null;
            }
            //if it is correct, return the user
            return $users;
        }

        return null;
	}
}