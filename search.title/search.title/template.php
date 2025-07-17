<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);?>
<?
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if($INPUT_ID == '')
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if($CONTAINER_ID == '')
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if($arParams["SHOW_INPUT"] !== "N"):?>
  <div class="search header__search jsSearch" id="<?echo $CONTAINER_ID?>">
    <form action="<?echo $arResult["FORM_ACTION"]?>">
      <button class="search__trigger jsSearchTrigger" type="button">
        <svg class="icon">
          <use xlink:href="#search--decor"></use>
        </svg>
      </button>
      <div class="search-input search__input"> 
        <button class="search-input__button" type="submit">
          <svg class="icon">
            <use xlink:href="#search"></use>
          </svg>
        </button>
        <input id="<?echo $INPUT_ID?>" class="search-input__field jsInput" type="text" placeholder="Введите данные поиска" name="q" value="" size="40" maxlength="50" autocomplete="off" />
        <button class="search-input__trigger jsInputClear" type="button">
          <svg class="icon">
            <use xlink:href="#close"></use>
          </svg>
        </button>
      </div>
    </form>
  </div>
<?endif?>
<script>
	BX.ready(function(){
		new JCTitleSearch({
			'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
			'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
			'INPUT_ID': '<?echo $INPUT_ID?>',
			'MIN_QUERY_LEN': 2
		});
	});
</script>


