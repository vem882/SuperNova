<?php

/**
 * autounban.php
 *
 * @version 1.0
 * @copyright 2008 by ??????? for XNova
 */


// Mais qu'est ce qu'il voullait demontrer lui ????

define('INSIDE'  , true);
define('INSTALL' , false);
define('IN_ADMIN', true);

$ugamela_root_path = (defined('SN_ROOT_PATH')) ? SN_ROOT_PATH : './../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include("{$ugamela_root_path}common.{$phpEx}");

if ($user['authlevel'] < 3)
{
  message( $lang['sys_noalloaw'], $lang['sys_noaccess'] );
  die();
}

  if ($user['authlevel'] >= 3) {
    $lang['PHP_SELF'] = 'options.'.$phpEx;
    doquery("UPDATE {{table}} SET `banaday` =` banaday` - '1' WHERE `banaday` != '0';",'users');
    doquery("UPDATE {{table}} SET `bana` = '0' WHERE `banaday` < '1';",'users');
    $parse['dpath'] = $dpath;
    $parse['debug'] = ($config->debug == 1) ? " checked='checked'/":'';
  } else {
    message ( $lang['sys_noalloaw'], $lang['sys_noaccess'] );
  }
?>