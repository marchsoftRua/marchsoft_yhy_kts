<?php 
function m_asset($moudle_name,$path)
{
	$moudle_name = ucfirst($moudle_name);
	return url("Modules/".$moudle_name."/public/".$path);
}
function module_js()
{
	return("string");
}
function json_en_de_code($obj)
{
	return json_decode(json_encode($obj)) ;
}
 ?>
