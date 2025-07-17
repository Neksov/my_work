<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!empty($arResult["CATEGORIES"]) && $arResult['CATEGORIES_ITEMS_EXISTS']):?>
  <div class="container search-dropdown__container">
    <div class="search-dropdown__header">
      <h3 class="search-dropdown__title">Поиск</h3>
      <p class="search-dropdown__subtitle"><?=count($arResult["SEARCH"])?> <?=number(count($arResult["SEARCH"]), array('результ', 'результата', 'результатов'))?> поиска</p><a class="search-dropdown__reset jsSearchReset" href="#">Сбросить</a>
    </div>
    <div class="search-dropdown__list">
      <?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
        <div class="search-block">
          <div class="search-block__header">
            <h4 class="search-block__title"><?=$arCategory["TITLE"]?></h4>
          </div>
          <div class="search-block__list"> 
            <?foreach($arCategory["ITEMS"] as $i => $arItem):?>
              <?$arResult['ALL'] = $arItem;?>
              <a class="<?=$arItem['PARAM2'] == '3'?'card-teacher':'card-search'?>" href="<?=$arItem['INFO']['CATALOG_LINK']['VALUE'] ? $arItem['INFO']['CATALOG_LINK']['VALUE']: $arItem['URL']?>" <?if($arItem['INFO']['CATALOG_LINK']['VALUE']):?>target="_blank"<?endif;?>>
                <picture class="<?=$arItem['PARAM2'] == '3'?'card-teacher__img':'card-search__img'?>"> 
                <img src="<?=CFile::GetPath($arItem['INFO']['PREVIEW_PICTURE']) ? CFile::GetPath($arItem['INFO']['PREVIEW_PICTURE']): '/local/templates/bridge/assets/assets/media/not-img.png' ?>" alt="<?=$arItem['NAME']?>" />
                </picture>
                <div class="<?=$arItem['PARAM2'] == '3'?'card-teacher__inner':'card-search__inner'?>">
                  <h4><?=$arItem['NAME']?></h4>
                  <div class="card-search__text">
                    <?foreach($arItem['INFO']['CATALOG_LEVEL']['VALUE'] as $name):?>
                      <p><?=$name?></p>
                    <?endforeach;?>
                  </div>
                </div>
              </a>
            <?endforeach;?>
          </div>
        </div>
      <?endforeach;?>
    </div>
    <a class="button button--border search-dropdown__button" href="<?=$arResult['ALL']['URL']?>">
      <span class="button__text">Показать все результаты</span>
    </a>
  </div>
<?endif;
?>