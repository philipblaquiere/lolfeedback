<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sign_in extends MY_Controller
{
	/**
	 * Constructor: initialize required libraries.
	 */

	public function __construct()
  {
    parent::__construct();
    $this->CI =& get_instance();
    $this->load->model('user_model');
    $this->load->model('system_message_model');
  }

  public function index()
  {
    $this->sign_in();
  }

  public function login()
  {
    if ($this->is_logged_in())
    {
      redirect('home', 'location');
    }
    $data = array('page_title' => 'Sign In');
    $this->view_wrapper('user/sign_in', $data, false);
  }

  public function sign_in()
  {
    $this->require_not_login();

    $this->load->library('form_validation');

    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

    if($this->form_validation->run() == FALSE)
    {
        $this->view_wrapper('sign_in');
    }
    else
    {
      //get sign in form data
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $user = $this->user_model->get($email);
      if(!$user)
      {
        $this->system_message_model->set_message('There is an error in your email or password', MESSAGE_INFO);
        redirect('home', 'location');
      }
      else if($this->_validate_password($user,$password)) 
      {
        $this->user_model->log_login($user['id']);
        $this->set_user($user);
        $this->system_message_model->set_message('Welcome, ' . $user['name'], MESSAGE_INFO);
        redirect('summoner', 'location');
      }
      else
      {
        $this->system_message_model->set_message('There is an error in your email or password', MESSAGE_INFO);
        redirect('home', 'location');
      }
    }
  }
  
  public function sign_out()
  {
    $this->require_login();
    $this->destroy_session();
    $data = array('page_title' => 'Sign out successful');
    $this->system_message_model->set_message('Sign out successful', MESSAGE_INFO);
    redirect('home', 'location');
  }

  private function _validate_password($user,$password)
  {
    if(!$password || !$user['email'])
      return false;
    return $user['password'] === $this->password_hash($password);
  }
}