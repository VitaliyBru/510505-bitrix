<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID;?>">
<head>
  <?$APPLICATION->ShowHead()?>
  <title><?$APPLICATION->ShowTitle();?></title>
</head>
<body>
<?$APPLICATION->ShowPanel()?>

<div class="page-wrapper">

  <header class="main-header">
    <div class="main-header__container container">
      <h1 class="visually-hidden">YetiCave</h1>
      <a class="main-header__logo">
        <img src="<?=SITE_TEMPLATE_PATH;?>/img/logo.svg" width="160" height="39" alt="Логотип компании YetiCave">
      </a>
      <?$APPLICATION->IncludeComponent(
        "bitrix:search.form",
        "yeticave_serch",
        Array(
          "PAGE" => "#SITE_DIR#search/index.php", // Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
          "USE_SUGGEST" => "N", // Показывать подсказку с поисковыми фразами
        ),
        false
      );?>
      <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
          "AREA_FILE_SHOW" => "file",
          "AREA_FILE_SUFFIX" => "inc",
          "EDIT_TEMPLATE" => "",
          "PATH" => (SITE_TEMPLATE_PATH . "/include/add_new.php")
        )
      );?>
      <nav class="user-menu">
        <? 
        global $USER;
        if ($USER->IsAuthorized()):
        ?>
        <div class="user-menu__image">
          <?if ($file_id = $USER->GetParam("PERSONAL_PHOTO")):?>
          <img src="<?=CFile::GetPath($file_id);?>" width="40" height="40" alt="Пользователь">
          <?endif?>
        </div>
        <div class="user-menu__logged">
          <p><?=$USER->GetFirstName();?></p>
          <a href="/user/?logout=yes"><?=GetMessage("LOG_OUT");?></a>
        </div>
        <?else:?>
        <ul class="user-menu__list">
          <li class="user-menu__item">
            <a href="/user/sign-up.php"><?=GetMessage("SIGN_UP");?></a>
          </li>
          <li class="user-menu__item">
            <a href="/user/"><?=GetMessage("LOG_IN");?></a>
          </li>
        </ul>
        <?endif;?>
      </nav>
    </div>
  </header>

  <main>

    <? 
    if ($APPLICATION->GetCurPage() != '/') {
      $APPLICATION->IncludeComponent(
        "bitrix:menu",
        "horizontal_menu",
        Array(
      	  "ALLOW_MULTI_SELECT" => "N",  // Разрешить несколько активных пунктов одновременно
          "CHILD_MENU_TYPE" => "left",  // Тип меню для остальных уровней
          "DELAY" => "N", // Откладывать выполнение шаблона меню
          "MAX_LEVEL" => "1", // Уровень вложенности меню
          "MENU_CACHE_GET_VARS" => array( // Значимые переменные запроса
            0 => "",
          ),
          "MENU_CACHE_TIME" => "3600",  // Время кеширования (сек.)
          "MENU_CACHE_TYPE" => "N", // Тип кеширования
          "MENU_CACHE_USE_GROUPS" => "N", // Учитывать права доступа
          "ROOT_MENU_TYPE" => "top",  // Тип меню для первого уровня
          "USE_EXT" => "N", // Подключать файлы с именами вида .тип_меню.menu_ext.php
        ),
        false
      );
    }
    ?>
