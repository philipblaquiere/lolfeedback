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
		if($this->is_logged_in() && $id == 'index')
		{
			$data['games'] = $this->recent_games->get($this->get_userid());
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