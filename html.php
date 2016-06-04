<?php
include_once "header.php";
set_time_limit(0);
ini_set("memory_limit", "150M");
$op       = (empty($_REQUEST['op'])) ? "" : $_REQUEST['op'];
$tbdsn    = (empty($_REQUEST['tbdsn'])) ? "" : intval($_REQUEST['tbdsn']);
$filename = (empty($_REQUEST['filename'])) ? "" : $_REQUEST['filename'];

$html = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=' . _CHARSET . '">
  <style type="text/css">
    #page{
      border:1px solid black;
      padding: 40px 60px 40px 60px;
      background-image: url(images/paper_bg.jpg);
      background-repeat: repeat-x;
      line-height:200%;
    }

    #page_title{
      border-bottom: 1px solid black;
      text-align:right;
      color:black;
      margin-bottom:20px;
    }
  </style>
  </head>
  <body>';

$html .= view_page($tbdsn);
$html .= '
  </body>
</html>';
die($html);


//觀看某一頁
function view_page($tbdsn = "")
{
    global $xoopsDB;

    $sql                                                                                                                            = "select * from " . $xoopsDB->prefix("tad_book3_docs") . " where tbdsn='$tbdsn'";
    $result                                                                                                                         = $xoopsDB->query($sql) or web_error($sql);
    list($tbdsn, $tbsn, $category, $page, $paragraph, $sort, $title, $content, $add_date, $last_modify_date, $uid, $count, $enable) = $xoopsDB->fetchRow($result);

    $book = get_tad_book3($tbsn);
    if (!chk_power($book['read_group'])) {
        header("location:index.php");
        exit;
    }

    if (!empty($book['passwd']) and $_SESSION['passwd'] != $book['passwd']) {
        $data .= _MD_TADBOOK3_INPUT_PASSWD;
        return $data;
        exit;
    }

    $doc_sort = mk_category($category, $page, $paragraph, $sort);

    //高亮度語法
    if (!file_exists(TADTOOLS_PATH . "/syntaxhighlighter.php")) {
        redirect_header("index.php", 3, _MD_NEED_TADTOOLS);
    }
    include_once TADTOOLS_PATH . "/syntaxhighlighter.php";
    $syntaxhighlighter      = new syntaxhighlighter();
    $syntaxhighlighter_code = $syntaxhighlighter->render();

    $main = "
    <div id='page'>
      <div id='page_title'>{$book['title']}</div>

      <h{$doc_sort['level']}>{$doc_sort['main']} {$title}</h{$doc_sort['level']}>
      $content
    </div>
    ";

    return $main;
}