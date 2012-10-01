<?

class MauiController extends Controller {

// @refactor: not in use. Marin 10/1/2012
  public function addJSFile($filename) {
    $baseUrl = Yii::app()->baseUrl; 
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/'.$filename);
  }
}
