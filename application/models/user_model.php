<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends CI_Model
{
  protected $table = 'users';
  protected $pkey = 'id';

  public function __construct()
  {
    parent::__construct();
    $this->db1 = $this->load->database('default', TRUE);
  }
  
  public function get($email)
  {
    $sql = "SELECT * FROM {$this->table} WHERE email = '$email' LIMIT 1";
    $result = $this->db1->query($sql);
    return $result->row_array();
  }

  public function get_byid($id)
  {
    $sql = "SELECT * FROM {$this->table} WHERE id = '$id' LIMIT 1";
    $result = $this->db1->query($sql);
    return $result->row_array();
  }

  /*
  * Returns key to be appended to url in email for user account validation
  */
  public function create($user)
  {
    $sql = "INSERT INTO users (id, name, email, password)
            VALUES ('" . $user['id'] . "', '" . $user['name'] . "', '" . strtolower($user['email']) . "', '" . $user['password'] . "')";
    
    $this->db1->query($sql);
  }
  
  public function generate_rune_page_key()
  {
    $max_key_length = 8;
    $domain = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjklmnpqrstuvwxyz123456789';
    $index_limit = strlen($domain) - 1;

    $key = '';
    for ($i = 0; $i < $max_key_length; $i++) {
      $key .= $domain[rand(0, $index_limit)];
    }
    return $key;
  }

  public function log_login($uid)
  {
    $sql = "UPDATE {$this->table} 
            SET last_login = current_timestamp 
            WHERE id = '$uid'";
    $this->db1->query($sql);
  }
}
