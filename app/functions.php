<?
function dump($ar){
	echo "<pre>";
	var_dump($ar);
	echo "</pre>";
}
function slicepath($arrayPath){
	$ar = explode( "/", $arrayPath);
	return array_values(array_diff($ar, Array("")));
}
?>