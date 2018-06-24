<?
class pik extends main {
	private $api_pik = "https://api.pik.ru/v1/flat?index_by=statistics&block_id=";
	protected $arRouteResult;
	private $block_id;
	public $arBlock_id = Array(
			'les' 	=>	132,
			'luga'	=>	55, 
			'mkr-vostochnoe-butovo' => 21,

		);

	function __construct($parceurl){
		$this->arRouteResult = $parceurl;
		$this->columns = Array(
			'Корпус',
			'Секция',
			'Этаж',
			'Номер квартиры',
			'Кол-во комнат',
		//	'Отделка',
			'Общая площадь',
			'Стоимость',
			'Скидка',
			'Стоимость со скидкой',
			'Статус',
		);
		
		$this->block_id = $this->get_block_id(slicepath($parceurl["path"])[0]); //slicepath разбиение адрес 
		$this->decode();

	}
	function get_block_id($path){
		return $this->arBlock_id[$path];
	}
	function decode(){
		$this->curl($this->api_pik.$this->block_id);
		$data = "";
		foreach ($this->json["flats"] as $flat){
			$totalPrice = (int)$flat['price'] - (int)$flat['discount'];
			$data .= $flat['bulk']['name'].";";
			$data .= $flat['section']['name'].";";
			$data .= $flat['floor'].";";
			$data .= $flat['number'].";";
			$data .= $flat['rooms'].";";
		//	$data .= $flat['']['name'].";"; //отделку не нашел
			$data .= $flat['area'].";";
			$data .= $flat['price'].";";
			$data .= $flat['discount'].";";
			$data .= $totalPrice.";";
			$data .= $flat['status'].";";
			$data .= "\r\n";
		}
		$this->csv($data);
	}
}


?>
