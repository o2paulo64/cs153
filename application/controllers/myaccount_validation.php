<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class myaccount_validation extends CI_Controller 
{

 public function __construct()
 {
   parent::__construct();
   $this->load->model('login_model','',TRUE);
 }

 public function index()
 {
   //This method will have the credentials validation
   $this->load->library('form_validation');

   $this->form_validation->set_rules('password', 'Password', 'required|alpha_numeric|callback_check_database');

   if($this->form_validation->run() == FALSE)
   {
     //Field validation failed.  User redirected to login page
     redirect('/Landing_controller', 'refresh');
   }
   else
   {

     //Go to private area
     redirect('/MyAccount', 'refresh');
   }

 }
 
 function check_database($password)
 {
   //Field validation succeeded.  Validate against database
   $session_data = $this->session->userdata('logged_in');
    $username = $session_data['userName'];
   //query the database
   $result = $this->login_model->login($username, $password);

   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
		   $sess_array = array(
			 'userID' => $row->userId,
			 'userName' => $row->username,
       'auth' => $row->authority,
       'validation' => 1
		   );
       $this->session->set_userdata('logged_in', $sess_array);
     }
     if ($result)
      {
        echo '<script language="javascript">';
        echo 'alert("Authenticated")';
        echo '</script>';
      }

    
     return TRUE;
   }
   else
   {

        echo '<script language="javascript">';
        echo 'alert("Wrong Password")';
        echo '</script>';
      
     $this->form_validation->set_message('check_database', 'Invalid username or password');
     return FALSE;
   }
 }
}
?>