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
		$data['id'] = $id;	
		$data['page'] = "summoner";
		$data['summonerid'] = $id;
		if(!$this->is_logged_in())
		{
			redirect('home');
			return;
		}

		if($this->is_logged_in() && ($id == NULL || $id == 'index'))
		{
			//user is signed in, navigate to summoner/id page
			$id = $this->get_userid();
			redirect('summoner/'.$id);
			return;
		}
		if(!empty($id))
		{
			$summoner_name = $this->lol_api->getSummoner($id, 'name');
			if(empty($summoner_name))
			{
				$data['title'] = "No summoner found";
				$data['sub_title'] = "Try searching for another summoner";
			}
			else
			{
				if(!array_key_exists($id, $summoner_name))
				{
					$data['title'] = "Summoner Not Found";
				}
				else
				{
					$data['title'] = $summoner_name[$id];
				}
				
				//parse data and display.
				$stats = $this->review_model->statistics($id);

				$data['stats'] = array_slice($stats, 0, 4);
				$data['review_stats'] = array_slice($stats, 4, 2);
				$data['sub_title'] = "Look below for game reviews";
			}
		}
		//should never come here
		$this->view_wrapper('summoner', $data);
	}
}