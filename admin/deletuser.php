<?php

/**
 * deletuser.php
 *
 * @version 1.0
 * @copyright 2008 by Tom1991 for XNova
 */

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

if ( $CurrentUser['authlevel'] >= 1 ) {
        $PageTpl = gettemplate( "admin/deletuser" );

        if ( $mode != "delet" ) {
                $parse['adm_bt_delet'] = $lang['adm_bt_delet'];
        }

    $Page = parsetemplate( $PageTpl, $parse );
    display ( $Page, $lang['adminpanel'], false, '', true );
}
?>