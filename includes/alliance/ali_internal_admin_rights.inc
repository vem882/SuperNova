<?php

if(!defined('SN_IN_ALLY') || SN_IN_ALLY !== true)
{
  $debug->error("Attempt to call ALLIANCE page mode {$mode} directly - not from alliance.php", 'Forbidden', 403);
}

if (!$user_admin) {
  message($lang['Denied_access'], $lang['Law_settings']);
};

if ($newRankName) {
  foreach($rights as $fieldName)
    $newRank[$fieldName] = 0;
  $newRank['name'] = $newRankName;

  $ranks[] = $newRank;
}

if (is_array($rankListInput)) {
  unset($ranks);

  foreach($rankListInput as $rankID => $rank){
    foreach($rights as $rightName){
      $ranks[$rankID][$rightName] = $rank[$rightName] ? 1 : 0;
    }
    $ranks[$rankID]['name'] = strip_tags($rank['name']);
  }
}

if ($d && isset($ranks[$d])) {
  if(count($ranks) == 1){
    message($lang['ali_adm_lastRank'], $lang['Law_settings']);
  }
  array_splice($ranks, $d, 1);
  doquery("UPDATE {{users}} SET `ally_rank_id`=`ally_rank_id` - 1 WHERE `ally_id`={$ally['id']} AND `ally_rank_id` >= {$d}");
}

ALI_rankListSave($ranks);

if (!count($ranks)) { // si no hay rangos
  $list = "<th colspan=8>{$lang['There_is_not_range']}</th>";
} else {
  $template = gettemplate('ali_admin_rights_row');

  foreach($ranks as $rankID => $rank) {
    $lang['rankID'] = $rankID;

    if (count($ranks) <= 1)
      $lang['delete'] = 'class="hide"';

    $lang['rN'] = $rank['name'];
    for($i = 1; $i < count($rank); $i++){
      $lang['r' . $i] = (($rank[$rights[$i]] == 1) ? ' checked' : '') ;
      $lang['n' . $i] = $rights[$i];
    }
    $list .= parsetemplate($template, $lang);
  }
}

$lang['list'] = $list;
$lang['dpath'] = $dpath;
$page .= parsetemplate(gettemplate('ali_admin_rights'), $lang);

display($page, $lang['Law_settings']);

?>
