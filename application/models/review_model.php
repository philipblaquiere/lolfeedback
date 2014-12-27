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

	public function statistics($id)
	{
		$sql = "SELECT AVG(NULLIF(skill1,0),AVG(NULLIF(skill2,0),AVG(NULLIF(skill3,0),AVG(NULLIF(skill4,0)
				FROM reviews
				WHERE toid = '$id'";
		$result = $this->db1->query($sql);
		$result = $result->row_array();
		$skills['Game-Sense'] = round($result['AVG(skill1)'], 1);
		$skills['Helpful'] = round($result['AVG(skill2)'], 1);
		$skills['Skillful'] = round($result['AVG(skill3)'], 1);
		$skills['Delivery'] = round($result['AVG(skill4)'], 1);
		return $skills;
	}
}