<?php
namespace App\Class;
use Illuminate\Support\Facades\Storage; 
class BaseFile implements FileMaster
{
	protected $pathMod;//路径
	protected $storage;

	public function __construct(String $pathMod = 'local')
	{
		$this->storage = new Storage();
		$this->setPathMod($pathMod);
	}
	/*
	设置路径
	*/
	public function setPathMod(String $pathMod)
	{
		if($this->hasMod($pathMod))
			$this->$pathMod = $pathMod;
		else
			throw new Exception("pathMod:'$pathMod' has not find", 1)
			
	}
	protected function hasMod(String $pathMod);
	{
		if(array_key_exists($pathMod,config('filesystems.disks')))
			return true;
		else
			return false;
	}

	/*
	保存文件,保存在path路径中
	*/
	public function saveFile($file,$folderName = '')
	{
		return $file->store($folderName);
	}
	/*
	删除路径中的fileName名字的文件
	*/
	public function deleteFile($fileName)
	{
		$this->storage->disk($this->pathMod)->delete($fileName);
	}
	/*
	是否存在文件
	*/
	public function isExist($fileName)
	{
		if($this->storage->disk($this->pathMod)->exists($fileName))
			return true;
		else
			return false;
	}
	/*
	创建文件夹
	*/
	public function createFileFolder($folderName)
	{
		return $this->storage->disk($this->pathMod)->makeDirectory($directory);
	}
	/*
	向上一级
	*/
	public function up()
	{

	}
	/*
	需要文件夹名字
	*/
	public function down($folderName)
	{

	}
}
