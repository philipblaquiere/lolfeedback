<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('lol_api');
	}

	function _remap($search_query)
	{
		$this->index($search_query);
	}

	public function index($search_query)
	{
		$summoner = $this->lol_api->getSummonerByName(urldecode($search_query));

		if(empty($summoner))
		{
			$id = "";
		}
		else
		{
			reset($summoner);
			$first_key = key($summoner);
			$id = $summoner[$first_key]['id'];
		}
		redirect('summoner/'. $id,'location');
	}
}