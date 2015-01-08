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
    //Validation on input (requires that all fields exist)'
    $this->require_not_login();
    $data['page'] = "register";
    $this->view_wrapper('register', $data);
  }

  public function password_match($pw1)
  {
    $pw2 = $this->input->post('password2');

    if($pw2 != $pw1)
    {
      $this->form_validation->set_message('password_match', 'The passwords did not match.');
      return FALSE;
    }
    else if(strlen($pw1) < 6)
    {
      $this->form_validation->set_message('password_match', 'Both passwords contain more than 6 characters');
      return FALSE;
    }
    else
    {
      return TRUE;
    }
  }

  public function unique_email_ajax($email)
  {
    $email = trim(strtolower($email));
    $user = $this->user_model->get($email);
    if($user)
    {
      //$this->form_validation->set_message('unique_email', 'That email is already registered with our website, choose another one.');
      echo FALSE;
    }
    else
    {
      echo TRUE;
    }
  }

  public function unique_email($email)
  {
    $email = trim(strtolower($email));
    $user = $this->user_model->get($email);
    if($user)
    {
      $this->form_validation->set_message('unique_email', $email . ' is already registered with our website, choose another one.');
      return FALSE;
    }
    else
    {
      return TRUE;
    }
  }
  public function create()
  {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback_unique_email');
    $this->form_validation->set_rules('password1', 'Password', 'required|xss_clean|callback_password_match');
    $this->form_validation->set_rules('password2', 'Re-Password', 'required|xss_clean');

    $this->form_validation->set_rules('summonername', 'Summoner Name', 'trim|required');

    if($this->form_validation->run() == FALSE)
    {
      $data['page'] = "register";
      redirect('register', $data);
    } 
    else
    {
      $ip = $this->input->ip_address();
      $user = $this->input->post();
      $user['password'] = $this->password_hash($user['password1']);
      //Save user object and get key to send to user email.
      $user['id'] = $_SESSION['player']['id'];
      $user['name'] = $_SESSION['player']['name'];
      $code = $this->_generate_random_string(42);
      $user['code'] = $code;
      $this->user_model->create($user);

      $this->load->library('email');
      $config['mailpath'] = '/lolfeedback.com/noreply/.Sent';
      $config['smtp_user'] = 'noreply@lolfeedback.com';
      $config['smtp_pass'] = ';nl.8kjm9ol';
      $this->email->initialize($config);
      $this->email->from('noreply@lolfeedback.com', 'LoL Feedback');
      $this->email->to($user['email']);

      $this->email->subject('Activate your LoL Feedback account');
      $message = "Click on the link below to activate your LoL Feedback account!\n\n www.lolfeedback.com/auth/activate/".$user['id'] ."/". $code;
      $this->email->message($message);
      if($this->email->send())
      {
        $this->system_message_model->set_message($user['name'] . ', check your inbox, we emailed you a link to validate your account!', MESSAGE_INFO);
      }
      else
      {
        $this->system_message_model->set_message($user['name'] . ', something fishy happened while sending you an email. Check your inbox for a validation link.', MESSAGE_INFO);
      }
      $data['page'] = "home";
      redirect('home', $data);
    }  
  }

  private function _generate_random_string($length = 10) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, strlen($characters) - 1)];
      }
      return $randomString;
  }
}