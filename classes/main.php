<?
abstract class main {
	protected $json;
	public $csvname;
	public $columns;
	abstract function decode(); 
	static public function getfilename($parceurl){
		$date = "[".date("d_m_Y")."]";
		$csvname = str_replace("/","+",$parceurl["host"].$parceurl["path"]);
		return DOCS.$csvname."+".$date.".csv";

	}
	public function curl($url){
		$connect = curl_init();
		curl_setopt($connect, CURLOPT_URL, $url);
		curl_setopt($connect, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($connect, CURLOPT_HEADER, 0);
		$page = curl_exec($connect);
		$this->json = json_decode($page,true);
	}
	public function csv($data){
		$csv=b"\xEF\xBB\xBF"."\r\n";
		foreach ($this->columns as $column) {
			$csv.="$column;";
		}
		$csv.="\r\n";
		$csv.=$data;
		$this->save($csv);
	}
	public function save($csv){
		
		$file = fopen(self::getfilename($this->arRouteResult), "w");
		fwrite($file, $csv);
		fclose($file);
	}
}

?>