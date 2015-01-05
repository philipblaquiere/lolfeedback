<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Champion_quotes
{

	private $quotes = array(
		"Kassadin" => "Justice, will be served.",
		"Jax" => "Who want's the piece of the champ.",
		"Rammus" => "Ok.",
		"Alistar" => "Mess with the bull and you get the horns.",
		"Ahri" => "Do I make your pulse rise?",
		"Nidalee" => "I will guide you.",
		"Kha'Zix" => "My wings are restless.",
		"Dr. Mundo" => "Mundo too strong for you!",
		"Brand" => "I purify this world.",
		"Lux" => "Be positive.",
		"Lux" => "Lighting the way.",
		"Master Y" => "My blade is yours.",
		"Azir" => "Trust in my vision.",
		"Xerath" => "I will show you true power.",
		"Riven" => "To serve the greater good.",
		"Zilean" => "All in good time.",
		"Vi" => "Punch first, ask questions while punching.",
		"Irelia" => "My blade is at your service.",
		"Shen" => "A demonstration of superior judgement.",
		"Garen" => "To the fields of justice.",
		"Quinn" => "Justice takes wing.",
		"Warwick" => "Let's make this fun.",
		"Blitzcrank" => "Fired up and ready to serve.",
		"Maokai" => "I do your bidding... for now.",
		"Karma" => "Always trust your spirit.",
		"Kha Zix" => "Change... is good.",
		"Ziggs" => "This'll be a blast!",
		"Nami" => "I decide what the tide will bring.",
		"Janna" => "The tempest is at your command.",
		"Ezreal" => "Time for a true display of skill.",
		"Miss Fortune" => "Fortune doesn't favor fools.",
		"Lucian" => "By all means, stand and fight.",
		"Thresh" => "What delightful agony we shall inflict.",
		"Nautilus" => "Sometimes I think this anchor just weighs me down.",
		"Fizz" => "One jump ahead of you.",
		"Gangplank" => "Swab the poop deck!",
		"Graves" => "Got any bright ideas?",
		"Twisted Fate" => "Never lost a fair game... or played one.",
		"Brand" => "I am the fire that cleanses the world."

	);

	public function __construct()
    {
        
    }
    public function get()
    {
    	return $this->array_random_assoc($this->quotes);
    }

    public function array_random_assoc($arr, $num = 1)
    {
	    $keys = array_keys($arr);
	    shuffle($keys);
	    
	    $r = array();
	    for ($i = 0; $i < $num; $i++) {
	        $r[$keys[$i]] = $arr[$keys[$i]];
	    }
	    return $r;
	}
}