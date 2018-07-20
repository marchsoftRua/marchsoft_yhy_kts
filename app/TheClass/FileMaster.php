<?php
namespace App\TheClass; 
interface FileMaster
{

	/*
	设置路径
	*/
	public function setPathMod(String $pathMod);
	/*
	存在这个文件模式
	*/
	public function hasMod(String $pathMod);
	/*
	保存文件,保存在path路径中
	*/
	public function saveFile($file);
	/*
	删除路径中的fileName名字的文件
	*/
	public function deleteFile($fileName);
	/*
	是否存在文件
	*/
	public function isExist($fileName);
	/*
	创建文件夹
	*/
	public function createFileFolder($folderName);
	/*
	向上一级
	*/
	public function up();
	/*
	需要文件夹名字
	*/
	public function down($folderName);
}