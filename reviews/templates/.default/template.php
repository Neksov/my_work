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
$this->setFrameMode(true);
?>            
<form class="form form--review"action="<?=$APPLICATION->GetCurPage()?>" method="POST">
  <div class="form__rate">
    <div class="input input--radio">
      <label class="input__wrapper">
        <input class="input__native" type="radio" value="1" placeholder="" name="star"></input>
        <div class="input__value">
          <svg class="icon" aria-hidden="aria-hidden" role="presentation">
            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/public/assets/icons/clean/sprite.svg#star"></use>
          </svg>
        </div>
      </label>
    </div>
    <div class="input input--radio">
      <label class="input__wrapper">
        <input class="input__native" type="radio" value="2" placeholder="" name="star"></input>
        <div class="input__value">
          <svg class="icon" aria-hidden="aria-hidden" role="presentation">
            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/public/assets/icons/clean/sprite.svg#star"></use>
          </svg>
        </div>
      </label>
    </div>
    <div class="input input--radio">
      <label class="input__wrapper">
        <input class="input__native" type="radio" value="3" placeholder="" name="star"></input>
        <div class="input__value">
          <svg class="icon" aria-hidden="aria-hidden" role="presentation">
            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/public/assets/icons/clean/sprite.svg#star"></use>
          </svg>
        </div>
      </label>
    </div>
    <div class="input input--radio">
      <label class="input__wrapper">
        <input class="input__native" type="radio" value="4" placeholder="" name="star"></input>
        <div class="input__value">
          <svg class="icon" aria-hidden="aria-hidden" role="presentation">
            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/public/assets/icons/clean/sprite.svg#star"></use>
          </svg>
        </div>
      </label>
    </div>
    <div class="input input--radio">
      <label class="input__wrapper">
        <input class="input__native" type="radio" value="5" placeholder="" name="star"></input>
        <div class="input__value">
          <svg class="icon" aria-hidden="aria-hidden" role="presentation">
            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/public/assets/icons/clean/sprite.svg#star"></use>
          </svg>
        </div>
      </label>
    </div>
  </div>
  <input type="text" value="" name="stars">
  <div class="form__name">
    <div class="input input--square">
      <label class="input__wrapper">
        <input class="input__native" type="text" value="" placeholder="<?=GetMessage("NAME")?>" name="name" data-mask="name" maxlength="20"></input>
      </label>
    </div>
  </div>
  <div class="form__comment"> 
    <p><?=GetMessage("COMMENT")?></p>
    <div class="input input--square input--textarea">
      <label class="input__wrapper">
        <textarea class="input__native" type="textarea" value="" placeholder="<?=GetMessage("TEXT")?>" name="comment" rows="6" maxlength="300"></textarea>
      </label>
    </div>
  </div>
  <button class="button button--filled-blue button--full" type="submit"><?=GetMessage("SEND")?></button>
</form>
<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", (event) => {
    window.reviews.init()
  });
</script>


