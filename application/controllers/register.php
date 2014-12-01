<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends MY_Controller
{
	/**
	 * Constructor: initialize required libraries.
	 */
	public function __construct()
  {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('system_message_model');
  }
  
  public function index()
  {
    //Validation on input (requires that all fields exist)
   //$this->load->library('form_validation');

    //$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback_unique_email');
    //$this->form_validation->set_rules('password1', 'Password', 'required|xss_clean|callback_password_match');
    //$this->form_validation->set_rules('password2', 'Re-Password', 'required|xss_clean');

    //$this->form_validation->set_rules('summonername', 'Summoner Name', 'trim|required');

    //if($this->form_validation->run() == FALSE)
    //{
      $this->view_wrapper('register');
    //} 

    //else
    //{
    //  $ip = $this->input->ip_address();

    //  $user = $this->input->post();
    //  $user['password'] = $this->password_hash($user['password1']);
      //Save user object and get key to send to user email.
    //  $_SESSION['pending_user'] = $user;
    
  }

  public function password_match($pw1)
  {
    $pw2 = $this->input->post('password2');

    if($pw2 != $pw1)
    {
      $this->form_validation->set_message('password_match', 'The passwords do not match.');
      return FALSE;
    }
    else
    {
      return TRUE;
    }
  }

  public function unique_email($email)
  {
    $email = strtolower($email);
    $user = $this->user_model->get($email);
    if($user)
    {
      $this->form_validation->set_message('unique_email', 'That email is already registered with our website, choose another one.');
      return FALSE;
    }
    else
    {
      return TRUE;
    }
  }
 private function create()
  {
    $user = $_SESSION['user'];
    $this->system_message_model->set_message($user['name'] . ', you have successfully linked your League of Legends account!', MESSAGE_INFO);
    redirect('home','refresh');
  }
}