<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use Bitrix\Main\Loader;
use Bitrix\Main\Type\Date;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\Contract\Controllerable;
use CBitrixComponent;
use \Spiks\Changes\Sender;
use \Bitrix\Main\Application;
use Bitrix\Main\Mail\Event;

/**
 * Bitrix vars
 *
 * @var CBitrixComponent $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
class Requests extends CBitrixComponent implements Controllerable
{

  protected ErrorCollection $errorCollection;

  public function onPrepareComponentParams($arParams)
  {
      $this->errorCollection = new ErrorCollection();
      return $arParams;
  }
  
  // Обязательный метод
  public function configureActions()
  {
    return [
      'addReviews' => [ // Ajax-метод
        'prefilters' => [
        ],
      ],
    ];
  }
  public function executeComponent()
  {
    $this->checkModules();
    $this->includeComponentTemplate();
  }
  protected function checkModules()
  {
  if (!Loader::includeModule('iblock'))
    throw new SystemException(Loc::getMessage('CPS_MODULE_NOT_INSTALLED', array('#NAME#' => 'iblock')));
  }

  public function error($id, $name, $comment){
    $arResult["ERROR"] = array();
    if(!$id){
      $arResult["ERROR"]['ID'] = GetMessage("ID");
    }
    if(!$name){
      $arResult["ERROR"]['NAME'] = GetMessage("NAME");
    }
    if(!$comment){
      $arResult["ERROR"]['COMMENT'] = GetMessage("COMMENT");
    }
    return $arResult["ERROR"];
  }

  public function addReviewsAction($star, $id, $name, $comment)
  {
    global $USER;
    $this->checkModules();
    CModule::IncludeModule('iblock');
    $el = new CIBlockElement;
    $code = gen_key();

    $PROP = array();
    $request = Application::getInstance()->getContext()->getRequest();
    $filesData = $request->getFileList()->toArray();
    $arFields = $request->toArray();

    $params = Array(
      "max_len" => "75", // обрезает символьный код до 75 символов
      "change_case" => "L", // буквы преобразуются к нижнему регистру
      "replace_space" => "-", // меняем пробелы на нижнее подчеркивание
      "replace_other" => "-", // меняем левые символы на нижнее подчеркивание
      "delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
      "use_google" => "false", // отключаем использование google
    );    

    header('Content-Type: text/html; charset='.LANG_CHARSET);

    $PROP = array();
    $PROP['RATING'] = $star;
    $PROP['ELEMENT'] = $id;

    $addReviews = Array(
      'MODIFIED_BY' => $USER->GetID(),
      "IBLOCK_SECTION_ID" => false,          
      "IBLOCK_ID"      => IBLOCK_REVIEWS,
      "NAME"           => $name,
      "PREVIEW_TEXT" => $comment,
      "CODE" => CUtil::translit($name, "ru", $params).'-'.$code,
      "PROPERTY_VALUES"=> $PROP,
      "ACTIVE"         => "N",       
    );

    $errors = self::error($id, $name, $comment);

    if($errors){
      $response['status'] = false;
      $response['error'] = $errors;
    }else{
      $response['status'] = true;
      $ELEM = $el->Add($addReviews);
    }
    return $response;

    $this->arResult = $arResult;
  }
}

