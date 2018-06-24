<?
class router {
	public function __construct(){
		if (isset($_POST["path"]) && $_POST["path"]!=""){
			$arRouteResult = parse_url($_POST["path"]); 
			$arHost = explode(".", $arRouteResult["host"]);
			$class = array_values(array_diff($arHost, array("ru", "com", "net", "su", "http", "https", "www")))[0];
			include CLASSES.$class.".php";
			new $class($arRouteResult);
			$this->output();
		}else{
			$this->output();
		}
	}
	public function output($currentfile = null){
		$list = $this->getlist();
		include "./view/form.php";
	}
	public function getlist(){
		$files = array_diff(scandir(DOCS), array(".", ".."));
		$number = 0;
		if ($files){
			foreach ($files as $file){
				preg_match("/\[(.*)\]/", $file, $match);
				$name = str_replace("[".$match[1]."]", "", $file);
				$name = str_replace("+", "/", $file);
				$new[$match[1]][$number]["url"] = DOCS_DIR.$file;
				$new[$match[1]][$number]["name"] = $name;
				$new[$match[1]][$number]["date"] = $match[1];
				$number++;
			}
			return $new;
		} 
	}
}
$route = new router();
?>