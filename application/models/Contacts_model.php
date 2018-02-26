<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts_model extends CI_Model 
{
    
    public function __construct() {
        parent::__construct();
    }


    //insert a new contact
    public function insert($name,$email,$message,$date) {
        //set the data
        $data['name'] = $name;
        $data['email'] = $email;
        $data['message'] = $message;
        $data['date_registered'] = $date;

        //insert in the db
        return $this->db->insert('contacts', $data);
    }

    //methor to update a contact
    public function update($id, $messageUser, $contacted, $userId) {
        //set the data
        $data['message_user'] = $messageUser;
        $data['contacted'] = $contacted;
        $data['id_user'] = $userId;

        $this->db->where('id',$id);

        //update the contact
        return $this->db->update('contacts', $data);
    }

    public function delete($id) {
        //set the data
        $data['active'] = 0;
        $this->db->where('id',$id);

        //update the contact
        return $this->db->update('contacts', $data);
    }

    //get all active contacts from the db
	public function getList($contacted) {   

        //left join with users, to get the name of the admin
        $this->db->select('c.id, c.active, c.name, c.email, c.date_registered, c.message, u.name name_user');
        $this->db->from('contacts c');
        $this->db->join('users u', 'c.id_user = u.id', 'left');

        //select using the variable passed
        $where = array('c.active' => 1 ,'c.contacted' => $contacted);
        //order by date registered desc
        $this->db->where($where);
        $this->db->order_by('c.date_registered', 'DESC');

        return $this->db->get()->result();
    }

     //get the data of a contact
	public function contact($id) {   

        //left join with users, to get the name of the admin
        $this->db->select('c.id, c.active, c.name, c.email, c.date_registered, c.message, c.message_user, c.contacted, u.name name_user');
        $this->db->from('contacts c');
        $this->db->join('users u', 'c.id_user = u.id', 'left');

        //select using the variable passed
        $where = array('c.id' => $id);
        //order by date registered desc
        $this->db->where($where);

        return $this->db->get('contacts')->result();
    }

    //search the new contacts by day, week and month
    public function newContacts() {
        //mount a sql to return the correct number by date
        return $this->db->query("select SUM(CASE WHEN DATE_FORMAT(date_registered, '%Y-%m-%d') = curdate() then 1 else 0 end) today, SUM(CASE WHEN DATE_FORMAT(date_registered, '%Y-%m-%d') BETWEEN DATE_ADD(curdate(), INTERVAL DAYOFWEEK(curdate())-1 DAY)*-1 AND curdate() THEN 1 ELSE 0 END) week, SUM(CASE WHEN MONTH(date_registered) = MONTH(curdate()) AND YEAR(date_registered) = YEAR(curdate()) THEN 1 ELSE 0 END) month FROM contacts WHERE active = 1")->result();
    }
    

}