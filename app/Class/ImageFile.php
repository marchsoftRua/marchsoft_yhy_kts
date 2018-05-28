<?php 
namespace App\Class;
class ImageFile extends BaseFile
{
	/*
	将图片缓存下来，返回路径
	*/
	public function cacheImage($file)
	{
		$this->setPathMod('cacheImage');
		$path = $this->saveFile($file);
		return $path;
	}
	/*
	将缓存图片保存，移动到它该去的地方
	filePath：从数据库过来的只能是完整路径
	*/
	public function cacheSave($filePath,$newPath)
	{
		$this->setPathMod('cacheImage');
		$this->storage->move($path,$newPath);
		return $newPath;

	}

	/*
		以下系列函数均依赖于ｃａｃｈｅｓａｖｅ函数
	*/

	/*
	保存视频封面
	*/
	public function saveVideoImg(String $path)
	{
		$fileName = pathToFileName($path);
		$newPath = '/public/user/'.Auth::id().'/videoImg/'.$fileName;
		return $this->cacheSave($path,$newPath);
	}
	/*
	保存视频封面
	*/
	public function saveUserImg(String $path)
	{
		$fileName = pathToFileName($path);
		$fileType = pathToFileType($path);

		$newPath = '/public/user/'.Auth::id().'/userImage.'.end($filetype);
        $userPath = substr(Auth::user()->head_url,7);
        $this->setPathMod('public');
        if($this->isExist($userPath))//删除原来的头像文件
        {
        	$this->deleteFile($userPath);
        }
		return $this->cacheSave($path,$newPath);
	}
	/*
	保存文章封面
	*/
	public function saveArticleImg(String $path)
	{
		$fileName = pathToFileName($path);
		$newPath = '/public/user/'.Auth::id().'/'.end($filename);
		return $this->cacheSave($path,$newPath);
	}
}
