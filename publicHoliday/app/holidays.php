<?php
class Holidays
{
  const jsonSrc = __DIR__.'/../json/publicHoliday.json';

  public function __construct () {
    echo json_encode($this->createFinalArray(),JSON_UNESCAPED_UNICODE);
  }

  /**
  *   URLによりソートした配列のキーをY-m-dの形で表す。
  */

  protected function createFinalArray () {
    $finalArray = [];
    $sortedOutArray = $this->sortOutJson();

    foreach ($sortedOutArray as $parentKey => $parentValue) {
      foreach ($parentValue as $childKey => $childValue) {
        $replaceKey = substr_replace($childKey,'-',2,0);
        $finalKey = '20'.(string) $parentKey.'-'.$replaceKey;
        $finalArray[$finalKey] = $childValue;
      }
    }

    return $finalArray;
  }

  /**
  *   取得したJsonをURLによってソートする
  */

  protected function sortOutJson () {
    $arrayVanilla = $this->getJsonData();
    $classifiedUri = $this->classifyUri('/publicHoliday/api');

    if(array_key_exists(0,$classifiedUri)){
      $limitedArray = $arrayVanilla[(string)$classifiedUri[0]];

      if(array_key_exists(1,$classifiedUri)){
        $arrayKey = array_keys($limitedArray);
        $match = "/".$classifiedUri[1]."[0-9]{2}/";

        for($count=0;$count<count($arrayKey);$count++){

          if(preg_match($match,$arrayKey[$count])){
            $sortedOutArray[$classifiedUri[0]][$arrayKey[$count]] = $arrayVanilla[$classifiedUri[0]][$arrayKey[$count]];

          }
        }
      }else{
        $sortedOutArray[$classifiedUri[0]] = $arrayVanilla[$classifiedUri[0]];
      }
    }else{
      $sortedOutArray = $arrayVanilla;
    }

    return $sortedOutArray;
  }

  /**
  *   URLから/api以降のリクエストを取得する
  */

  function classifyUri ($removeUri,$explode = true) {
    $calleeUri = $_SERVER['REQUEST_URI'];
    $resultUri = str_replace($removeUri,'',$calleeUri);

    if($explode){
      $resultUriArray = explode('/',$resultUri);
      array_shift($resultUriArray);
      array_pop($resultUriArray);

      return $resultUriArray;
    }

    return $resultUri;
  }

  /**
  *   /json から publicHoliday.jsonの総データを取得
  */

  function getJsonData () {
    $json = file_get_contents(self::jsonSrc);
    $json = mb_convert_encoding($json,'UTF8','ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $records = json_decode($json,true);
    
    return $records;
  }
}
