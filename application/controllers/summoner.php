<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Summoner extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('lol_api');
		$this->load->model('review_model');
		$this->load->library('recent_games');
	}

	function _remap($id)
	{
		$this->index($id);
	}

	public function index($id)
	{
		
		if($this->is_logged_in() && ($id == 'index' || $id == $this->get_userid()))
		{
			$id = $this->get_userid();
			$data['games'] = $this->recent_games->get($id);
			$gameids = array_keys($data['games']);
			$_SESSION['user']['recent_gameids'] = $gameids;
			print_r($_SESSION['user']);
		}
		else
		{
			$data['games'] = NULL;
		}
		
		$summoner_name = $this->lol_api->getSummoner($id, 'name');
		if(empty($summoner_name))
		{
			$data['title'] = "No summoner found";
			$data['sub_title'] = "Try searching for another summoner";
		}
		else
		{
			$data['title'] = $summoner_name[$id];
			$reviews = $this->review_model->get($id);
			if($data['games'] != NULL)
			{
				$current_reviews = $this->review_model->recent($gameids);
				$data['current'] = $current_reviews;
				print_r($current_reviews);
			}

			if(empty($reviews))
			{
				$data['sub_title'] = "No game reviews have been left for " . $data['title'] . "!"; 
			}
			else
			{
				//parse data and display.
				$data['sub_title'] = "Look below for game reviews";
			}
		}
		$this->view_wrapper('summoner', $data);
	}
}