<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Usermodel extends CI_Model
    {

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function add($user){
        	print_r($user);
        	$this->db->insert('test',$user);
        }
    }
?>
