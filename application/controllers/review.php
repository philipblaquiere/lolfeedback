<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('review_model');
	}

	public function create()
	{
		$review = $_POST;
		if(!array_key_exists('id', $review) || !array_key_exists('gameid', $review))
		{
			return;
		}
		$this->review_model->create($review);
	}

	public function update()
	{
		$review = $_POST;
		if(!array_key_exists('skill', $review) || !array_key_exists('id', $review))
		{
			return;
		}
		$this->review_model->update($review);
	}
}