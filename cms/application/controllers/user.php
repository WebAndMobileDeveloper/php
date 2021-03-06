<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('usermodel');
    }

    public function index() {
        $data['css'] = array('css/bootstrap.css', 'css/custom.css');
        $data['js'] = array('js/app.js','js/controllers/testController.js');
        $this->load->view('post',$data);
    }

    public function add() {
        $postdata = file_get_contents("php://input");
        // print_r($postdata);
        $request = json_decode($postdata);
        $cnt = 1;
        $str = " ";
        foreach ($request->users as $key => $user) {
            $data = array(
                'name' => $user->fname,
                'desc' => $user->lname,
            );
            $this->usermodel->add($data);
            $str = $str . " " . $cnt . " : Record Saved ,";
            log_message('error', $str);
            $cnt++;
        }
        echo trim($str, ',');
    }
    function test(){
        echo base_url();
    }

}
