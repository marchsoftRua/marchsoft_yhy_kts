<?php
namespace Modules\Main\Http\Controllers\Index;
use Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Main\Entities\Comment;
use Modules\Main\Entities\Article;
use Modules\Main\Entities\Type;
/**
* 
*/
class ArticleShowController extends Controller
{
  var $articleModel=null;
  var $commentModel=null;
    public function __construct()
    {
        $this->articleModel = new Article();
        $this->commentModel = new Comment();
    }
    public function lookArticle(Request $request){
          $id = $request->route( 'article_id' );
          $num = $this->articleModel->getOneArticle($id);
          Log::info(json_encode($num));
          if (!$id||count($num)<1){
              return redirect('/404');
          }
          $data = $this->articleModel->getMyArticle($id);
          return view('main::Index.article')->with(["data"=>$data]);
    }
    public function getComments(Request $request){
       $oderRule =["created_at","praise"]; 
       $id = $request->article_id;
       $oderBy=$request->bycolumn;
       $Comments =  $this->commentModel->getOneGrade($id,$oderRule[$oderBy]);
       $tmpview = view('main::Index.fillDatas.comment')->with('comment',$Comments);
       $html = response($tmpview)->getContent();
       return  [
                "html"=>$html,
                "data"=> $Comments
                ];
    }
    public function getChildComments(Request $request){
        $id = $request->article_id;
        $p_id=$request->p_id;
        $getLimit=$request->getLimit;
        $item=new \stdClass();
        $item->childs = $this->commentModel->getChild($p_id,$id,$getLimit);
        $item->p_id=$p_id;
        $tmpview = view('main::Index.fillDatas.childComment')->with('item',$item);
        $html = response($tmpview)->getContent();
         return  [
                "html"=>$html,
                "data"=>$item->childs
                ];
    }
    public function sendComments(Request $request){
      $getdata = $request->all();
        $this->commentModel->addComment($getdata);
        return response()->json([
          "status"=>0,
          "msg"=>55
        ]);
    }

}
 