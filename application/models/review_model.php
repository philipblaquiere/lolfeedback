<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db1 = $this->load->database('default', TRUE);
	}

	public function create($review)
	{
		$sql = "INSERT INTO reviews(id, from, to, message,  isgood, gameid, skill1, skill2, skill3, skill4, skill5)
		VALUES ('" . $review['id'] . "', '" . $review['from'] . "', '" . $review['to'] . "', '" . $review['message'] . "', '" . $review['isgood'] . "', '" 
			. $review['gameid'] . "', '" . $review['skill1'] . "', '" . $review['skill2'] . "'
			, '" . $review['skill3'] . "', '" . $review['skill4'] . "', '" . $review['skill5'] . "')";

		$this->db1->query($sql);
	}

	public function get($toid)
	{
		$sql = "SELECT * FROM reviews r
				WHERE r.to = '$toid'";
		$result = $this->db1->query($sql);
		return $result->result_array();
	}
}