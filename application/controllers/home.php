<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('champion_quotes');
	}

	public function index()
	{
		$quote = $this->champion_quotes->get();
		$data['quote_author'] = key($quote);
		$data['quote_content'] = $quote[$data['quote_author']];
		$data['page'] = "home";
		$this->view_wrapper('home', $data);
	}
}