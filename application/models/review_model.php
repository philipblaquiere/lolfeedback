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
		$sql = "INSERT INTO reviews(id, fromid, toid, gameid)
		VALUES ('" . $review['id'] . "','" . $review['fromid'] . "','" . $review['toid'] . "','"	. $review['gameid'] . "')";

		$this->db1->query($sql);
	}

	public function update($review)
	{
		if(array_key_exists('skill', $review) && $review['skill'] <= 5 && $review['skill'] >= 1)
		{
			$skill = "skill" . $review['skill'];
			$skill_value = $review['value'];
			$reviewid = $review['id'];
			$sql = "UPDATE reviews 
					SET $skill = '$skill_value'
					WHERE id = '$reviewid'";
			$result = $this->db1->query($sql);
			return TRUE;
		}
		else if(array_key_exists('message', $review) && $review['message'])
		{
			$message = $review['message'];
			$reviewid = $review['id'];
			$sql = "UPDATE reviews 
					SET message = '$message'
					WHERE id = '$reviewid";
			$result = $this->db1->query($sql);
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function recent($gameids)
	{
		if(count($gameids) == 0)
		{
			return NULL;
		}

		$fromid = $_SESSION['user']['id'];

		$sql = "SELECT * FROM reviews r
				WHERE r.fromid = '$fromid' AND
						(r.gameid IN ('" . implode("','", $gameids) . "'))";

		$result = $this->db1->query($sql);
		$result = $result->result_array();
		$reviews = array();

		foreach ($result as $reviewid => $review)
		{
			$reviews[$review['id']] = $review;
		}
		
		return $reviews;
	}

	public function get($toid)
	{
		$sql = "SELECT * FROM reviews r
				WHERE r.toid = '$toid'";
		$result = $this->db1->query($sql);
		return $result->result_array();
	}
}