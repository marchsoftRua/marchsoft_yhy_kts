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

function setData($data,$msg = "没问题")
{
    $dataArr =array("code"=>0,"msg"=>$msg,"count"=>1,"data"=>$data);
    return $dataArr;
}

function json_en_de_code($obj)
{
	return json_decode(json_encode($obj));
}
function responseToJson($status,$msg){
	    return response()->json([
                'status'=>$status,
                'msg'=>$msg
        ]);
}
function getUserInfo()
{
	return json_en_de_code(
	[
		'name'=>'骚风吹',
		'id'=>2,
		'user_type'=>1
	]);
}
function wordTime($time) {
		date_default_timezone_set('PRC');
        $time = (int) substr(strtotime($time), 0, 10);
        $int = time() - $time;
        $str = '';
        if ($int <= 2){
            $str = sprintf('刚刚', $int);
        }elseif ($int < 60){
            $str = sprintf('%d秒前', $int);
        }elseif ($int < 3600){
            $str = sprintf('%d分钟前', floor($int / 60));
        }elseif ($int < 86400){
            $str = sprintf('%d小时前', floor($int / 3600));
        }elseif ($int < 2592000){
            $str = sprintf('%d天前', floor($int / 86400));
        }else{
            $str = date('Y-m-d H:i:s', $time);
        }
        return $str;
    }

function serchAddName($item,$code)
{
    $name = false;
    if(isset($item['code'])&&$item['code'] == $code)
        return $item['name'];
    else if(isset($item['childs']))
        return serchAddName($item['childs'],$code);
    else if(gettype($item) == 'array'&&!isset($item['code']))
        for($i=0;$i<count($item);$i++){
            $name = serchAddName($item[$i],$code);
            if($name!=false)
                return $name;
        }
    else
        return null;
}

function addCodeToString($code)
{
    $filename = 'Main/json/address.json';
    $addName = null;
    if(file_exists($filename))
    {
        $content = file_get_contents($filename); 
        $json = json_decode($content,true); 
        $addName = serchAddName($json,$code);
        return $addName;
    }
}