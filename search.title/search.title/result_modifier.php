<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

//You may customize user card fields to display
$arResult['USER_PROPERTY'] = array(
	"UF_DEPARTMENT",
);

$arIBlocks = array();

$arResult["SEARCH"] = array();
foreach($arResult["CATEGORIES"] as $category_id => $arCategory)
{

	foreach($arCategory["ITEMS"] as $i => $arItem)
	{
		if(isset($arItem["ITEM_ID"]))
			$arResult["SEARCH"][] = &$arResult["CATEGORIES"][$category_id]["ITEMS"][$i];
	}
}

foreach($arResult["SEARCH"] as $i=>$arItem)
{
  $rsElement = CIBlockElement::GetList(array(), array(
      "=ID" => $arItem["ITEM_ID"],
      "IBLOCK_ID" => $arItem["PARAM2"],
    ),
    false, false, array(
      "ID",
      "IBLOCK_ID",
      "IBLOCK_CODE",
      "PREVIEW_PICTURE",
      "CODE",
      "PREVIEW_TEXT",
      "XML_ID",
      "INFO",
      "ACTIVE_FROM",
    )
  );

  while($ob = $rsElement->GetNextElement()) 
  { 
    $arFields = $ob->GetFields() + $ob->GetProperties();
    $arElement  = $arFields; 
  }

  $arFilter = array(
    "=ID" => $arItem["ITEM_ID"],
    "IBLOCK_ID" => $arItem["PARAM2"],
  ); 
  $res = CIBlockElement::GetList(Array(), $arFilter, false, false ); 
  while($ob = $res->GetNextElement()) 
    { 
      $arFields = $ob->GetFields() + $ob->GetProperties();
      $arResult['RES'][$arFields['ID']]= $arFields; 
    }
    $arResult["SEARCH"][$i]["INFO"] = $arElement;
}

?>
