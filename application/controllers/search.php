<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('lol_api');
    	$this->load->model('system_message_model');
	}

	public function index()
	{
		$result = $this->input->post();
		$summoner_name = $result['search'];
		try
		{
			$summoner = $this->lol_api->getSummonerByName(urldecode($summoner_name));
			reset($summoner);
			$first_key = key($summoner);
			$id = $summoner[$first_key]['id'];
			redirect('summoner/'. $id);
		} 
		catch (Exception $e)
		{
			redirect('summoner');
		}
	}
}