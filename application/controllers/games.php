<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Games extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('recent_games');
		$this->load->model('review_model');
	}

	public function recent($id, $update_cache = FALSE)
	{
		if($this->get_userid() == $id)
		{
			$view['is_user'] = "true";

			if($update_cache)
			{
				//get new games and store in cache;
				$_SESSION['games'] = $this->recent_games->get($id);
				$data['games'] = $_SESSION['games'];
			}
			else
			{
				if(!array_key_exists('games', $_SESSION))
				{
					$_SESSION['games'] = $this->recent_games->get($id);
				}
				//use cache instead
				$data['games'] = $_SESSION['games'];
			}

			$_SESSION['user']['recent_gameids'] = !empty($data['games']) ? array_keys($data['games']) : array();;
			$current_reviews = $this->review_model->recent($_SESSION['user']['recent_gameids']);
			$data['current'] = $current_reviews;
			$view['game_content'] = $this->load->view('recent_games', $data, true);
		}
		else
		{
			$view['is_user'] = "false";
		}

		$data['reviews'] = $this->review_model->get($id);
		$view['review_content'] = $this->load->view('comments',$data, true);
		echo json_encode($view);
		return;
	}

	public function refresh()
	{
		// Force cache update
		$this->recent($this->get_userid(), TRUE);
	}
}