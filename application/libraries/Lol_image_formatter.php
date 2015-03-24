<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Lol_image_formatter
{

	private $version;
	private $api_url; 
	private $champions;

	const BASE_API_CALL = "http://ddragon.leagueoflegends.com/realms/na.json";
	const ITEM_IMAGE_URL = "/img/item";
	const CHAMPION_IMAGE_URL = "/img/champion";
	const SPELL_IMAGE_URL = "/img/spell";

	public function __construct()
	{
		if($this->api_url == NULL || $this->version == NULL)
		{
			//call the API and return the result
			$ch = curl_init(self::BASE_API_CALL);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			$result = json_decode($result,TRUE);

			$this->version = $result['v'];
			$this->api_url = $result['cdn'];
		}
	}

	public function to_image_url($sprite, $type)
	{
		switch ($type) {
			case 'item':
				return $this->api_url . "/" . $this->version . self::ITEM_IMAGE_URL . "/" . $sprite;
				break;
			case 'champion':
				return $this->api_url . "/" . $this->version . self::CHAMPION_IMAGE_URL . "/" .$sprite;
				break;
			case 'spell':
				return $this->api_url . "/" . $this->version . self::SPELL_IMAGE_URL . "/" .$sprite;
			break;
			default:
				# code...
				break;
		}
	}

	public function get_champion_image($championid)
	{
		//get $sprite from db according to $championid
		if(empty($this->champions))
		{
			$this->get_champions();
		}
		if(array_key_exists($championid, $this->champions))
		{
			return $this->api_url . "/" . $this->version . self::CHAMPION_IMAGE_URL . "/" . $this->champions[$championid];
		}
		return "";
	}

	private function get_champions()
	{
		$champion = array();
		if(empty($this->champions))
		{
			$champion['1'] = "Annie.png";
			$champion['2'] = "Olaf.png";
			$champion['3'] = "Galio.png";
			$champion['4'] =  "TwistedFate.png";
			$champion['5'] =  "XinZhao.png";
			$champion['6'] = "Urgot.png";
			$champion['7'] = "Leblanc.png";
			$champion['8'] = "Vladimir.png";
			$champion['9'] = "FiddleSticks.png";
			$champion['10'] = "Kayle.png";
			$champion['11'] =  "MasterYi.png";
			$champion['12'] = "Alistar.png";
			$champion['13'] = "Ryze.png";
			$champion['14'] = "Sion.png";
			$champion['15'] = "Sivir.png";
			$champion['16'] = "Soraka.png";
			$champion['17'] = "Teemo.png";
			$champion['18'] = "Tristana.png";
			$champion['19'] = "Warwick.png";
			$champion['20'] = "Nunu.png";
			$champion['21'] =  "MissFortune.png";
			$champion['22'] = "Ashe.png";
			$champion['23'] = "Tryndamere.png";
			$champion['24'] = "Jax.png";
			$champion['25'] = "Morgana.png";
			$champion['26'] = "Zilean.png";
			$champion['27'] = "Singed.png";
			$champion['28'] = "Evelynn.png";
			$champion['29'] = "Twitch.png";
			$champion['30'] = "Karthus.png";
			$champion['31'] =  "Chogath.png";
			$champion['32'] = "Amumu.png";
			$champion['33'] = "Rammus.png";
			$champion['34'] = "Anivia.png";
			$champion['35'] = "Shaco.png";
			$champion['36'] =  "DrMundo.png";
			$champion['37'] = "Sona.png";
			$champion['38'] = "Kassadin.png";
			$champion['39'] = "Irelia.png";
			$champion['40'] = "Janna.png";
			$champion['41'] = "Gangplank.png";
			$champion['42'] = "Corki.png";
			$champion['43'] = "Karma.png";
			$champion['44'] = "Taric.png";
			$champion['45'] = "Veigar.png";
			$champion['48'] = "Trundle.png";
			$champion['50'] = "Swain.png";
			$champion['51'] = "Caitlyn.png";
			$champion['53'] = "Blitzcrank.png";
			$champion['54'] = "Malphite.png";
			$champion['55'] = "Katarina.png";
			$champion['56'] = "Nocturne.png";
			$champion['57'] = "Maokai.png";
			$champion['58'] = "Renekton.png";
			$champion['59'] =  "JarvanIV.png";
			$champion['60'] = "Elise.png";
			$champion['61'] = "Orianna.png";
			$champion['62'] = "MonkeyKing.png";
			$champion['63'] = "Brand.png";
			$champion['64'] =  "LeeSin.png";
			$champion['67'] = "Vayne.png";
			$champion['68'] = "Rumble.png";
			$champion['69'] = "Cassiopeia.png";
			$champion['72'] = "Skarner.png";
			$champion['74'] = "Heimerdinger.png";
			$champion['75'] = "Nasus.png";
			$champion['76'] = "Nidalee.png";
			$champion['77'] = "Udyr.png";
			$champion['78'] = "Poppy.png";
			$champion['79'] = "Gragas.png";
			$champion['80'] = "Pantheon.png";
			$champion['81'] = "Ezreal.png";
			$champion['82'] = "Mordekaiser.png";
			$champion['83'] = "Yorick.png";
			$champion['84'] = "Akali.png";
			$champion['85'] = "Kennen.png";
			$champion['86'] = "Garen.png";
			$champion['89'] = "Leona.png";
			$champion['90'] = "Malzahar.png";
			$champion['91'] = "Talon.png";
			$champion['92'] = "Riven.png";
			$champion['96'] =  "KogMaw.png";
			$champion['98'] = "Shen.png";
			$champion['99'] = "Lux.png";
			$champion['101'] = "Xerath.png";
			$champion['102'] = "Shyvana.png";
			$champion['103'] = "Ahri.png";
			$champion['104'] = "Graves.png";
			$champion['105'] = "Fizz.png";
			$champion['106'] = "Volibear.png";
			$champion['107'] = "Rengar.png";
			$champion['110'] = "Varus.png";
			$champion['111'] = "Nautilus.png";
			$champion['112'] = "Viktor.png";
			$champion['113'] = "Sejuani.png";
			$champion['114'] = "Fiora.png";
			$champion['115'] = "Ziggs.png";
			$champion['117'] = "Lulu.png";
			$champion['119'] = "Draven.png";
			$champion['120'] = "Hecarim.png";
			$champion['121'] =  "Khazix.png";
			$champion['122'] = "Darius.png";
			$champion['126'] = "Jayce.png";
			$champion['127'] = "Lissandra.png";
			$champion['131'] = "Diana.png";
			$champion['133'] = "Quinn.png";
			$champion['134'] = "Syndra.png";
			$champion['143'] = "Zyra.png";
			$champion['154'] = "Zac.png";
			$champion['157'] = "Yasuo.png";
			$champion['161'] =  "Velkoz.png";
			$champion['201'] = "Braum.png";
			$champion['222'] = "Jinx.png";
			$champion['236'] = "Lucian.png";
			$champion['238'] = "Zed.png";
			$champion['254'] = "Vi.png";
			$champion['266'] = "Aatrox.png";
			$champion['267'] = "Nami.png";
			$champion['412'] = "Thresh.png";
			$champion['150'] = "Gnar.png";
			$champion['268'] = "Azir.png";
			$champion['429'] = "Kalista.png";
			$champion['421'] = "RekSai.png";
			$champion['432'] = "Bard.png";
		}
		$this->champions = $champion;
		return $this->champions;
	}
}
		
