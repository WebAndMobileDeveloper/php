<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
  function __construct() {
  	parent::__construct();
  	$this->load->helper('url');
  	 $this->load->model('usermodel');

  }

	public function index()
	{
		$this->load->view('post');
	}
	public function add()
	{
		$postdata = file_get_contents("php://input");
    	// print_r($postdata);
    	$request = json_decode($postdata);
		// print_r($_REQUEST);
		// print_r($request->user);
		// print_r($request->user[0]);
			// print_r($value);
		foreach ($request->users as $key => $user) {
			// echo $user->fname;
			// echo $user->lname;
			 $data = array(
		        'name' => $user->fname,
		        'desc' => $user->lname,
		    );
			$this->usermodel->add($data);
		}
		// print_r($data);
		//print_r($data);
		// echo $request->user->fname;
		// echo $request->user
		/*foreach ($request->user as $key => $value) {
			echo $key." : ".$value;
			# code...
		}*/
		// $this->load->view('post');
		// echo "hELLO".$request->data;
	}
}
