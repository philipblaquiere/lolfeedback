<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MY_Controller 
{
	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('user_model');
	    $this->load->model('system_message_model');
		$this->load->library('lol_api');
	}

	public function authenticate_summoner()
	{
		$region = $_POST['region'];
		$summonerinput = $_POST['summonername'];
		$region = 'na';
	    if($summonerinput== "-")
	    {
	       //user didn't enter anything, show error message and reload.
		    $data['errormessage'] = "You must enter a summoner name to validate.";
			$this->load->view('messages/rune_page_verification_fail', $data);
			return;
	    }
	    else if($region == "Region")
	    {
	    	$data['errormessage'] = "You must select a region";
			  $this->load->view('messages/rune_page_verification_fail', $data);
			  return;
	    }
	    else
	    {
  			//check riot servers to see if summoner actually exists.
  			$summonerinput = strtolower(str_replace(' ','', urldecode($summonerinput)));
  			$riotsummoners = $this->lol_api->getSummonerByName($summonerinput);
  			$riotsummoners['region'] = "na";
  			//contains Array ( [summonername] => Array ( [id] => 39895516 [name] => Summoner Name [profileIconId] => 0 [summonerLevel] => 6 [revisionDate] => 1383423931000 ) [region] => Region )
			if(!array_key_exists($summonerinput, $riotsummoners))
			{
				$data['errormessage'] = implode(" ", $riotsummoners);
				$this->load->view('messages/rune_page_verification_fail', $data);
				return;
			}
			else
			{
				$player = $this->user_model->get_byid($riotsummoners[$summonerinput]['id']);

				if(empty($player))
				{
					//player doesn't exist in db yet. Generate a Rune Page Key
					$_SESSION['runepagekey'] = $this->user_model->generate_rune_page_key();
					$data['runepagekey'] = $_SESSION['runepagekey'];
					$_SESSION['player']['name'] = $riotsummoners[$summonerinput]['name'];
					$_SESSION['player']['id'] = $riotsummoners[$summonerinput]['id'];
					$this->load->view('ajax/authenticate_summoner',$data);
					return;
				}
				else
				{
					//summoner already existing return error
					$data['errormessage'] = "Player is already registered in our database";
					$this->load->view('messages/rune_page_verification_fail', $data);
					return;
				}
			}
		}
		//end function
  	}

	public function rune_page_verification()
	{
		$id = $_SESSION['player']['id'];
		$runepagekey = $_SESSION['runepagekey'];
		$runepages = $this->lol_api->getSummoner($id,"runes");
		
		$firstRunePageName = $runepages[$id]['pages']['0']['name'];
		if($firstRunePageName == $runepagekey)
		{
			//user runepage is validated, re-check absence in db
			$user = $this->user_model->get_byid($id);
			if(empty($user))
			{
				echo "success";
			}
			else 
			{
				//user was registered during verification phase (highly unlikely), display error
      			$data['errormessage'] = "The specified summoner is already registered";
			  	$this->load->view('messages/rune_page_verification_fail', $data);
			}
		}
		else
		{
			//user is invalid, display error message.
			$data['errormessage'] = "Incorrect Rune page name (" . $firstRunePageName . "), should be " . $runepagekey;
			$this->load->view('messages/rune_page_verification_fail', $data);
		}
	}

	public function validate_register()
	{
		$email = $_POST['email'];
		$summoner_name = $_POST['summonername'];
		$original_summoner = $_POST['summonername'];
		$region = $_POST['region'];

		$user = $this->user_model->get($email);
		$data = array();
		if(!empty($user))
		{
			//$this->form_validation->set_message('unique_email', 'That email is already registered with our website, choose another one.');
			$data['content'] = $email . " is already in use";
			$data['error'] = "true";
			echo json_encode($data);
			return;
		}
		$summoner_name = strtolower(str_replace(' ','', urldecode($summoner_name)));
  		$riotsummoners = $this->lol_api->getSummonerByName($summoner_name);
  		if(empty($riotsummoners) || !array_key_exists($summoner_name, $riotsummoners))
		{
			$data['content'] = "\"" . $original_summoner . "\" wasn't found";
			$data['error'] = "true";
			echo json_encode($data);
			return;
		}

		$player = $this->user_model->get_byid($riotsummoners[$summoner_name]['id']);

		if($player)
		{
			$data['content'] = $original_summoner . " is already registered";
			$data['error'] = "true";
			echo json_encode($data);
			return;
		}
		$_SESSION['runepagekey'] = $this->user_model->generate_rune_page_key();
		$data['runepagekey'] = $_SESSION['runepagekey'];
		$_SESSION['player']['name'] = $riotsummoners[$summoner_name]['name'];
		$_SESSION['player']['id'] = $riotsummoners[$summoner_name]['id'];

		$data['error'] = "false";
		$data['content'] = $this->load->view('ajax/authenticate_summoner',$data, true);
		//$data['content'] = "Test";
		echo json_encode($data);
		return;
	}
}	
