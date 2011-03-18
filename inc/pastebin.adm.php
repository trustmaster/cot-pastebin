<?php
/**
 * Pastebin Admin part
 *
 * @package pastebin
 * @version 1.1
 * @author Kilandor, Trustmaster
 * @copyright Copyright (c) 2009-2011 Jason Booth, Cotonti Team
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL.');

cot_block($paste_isadmin);

if (!empty($id))
{
	$db->update($db_pastebin, array('paste_flagged' => 0), "paste_id = $id");
	cot_redirect(cot_url('plug', 'e=pastebin&m=adm', '', true));
}

$sql_paste = $db->query("SELECT * FROM $db_pastebin WHERE paste_flagged = 1");
if($sql_paste->rowCount() > 0)
{
	foreach ($sql_paste->fetchAll() as $fa_paste)
	{
		$fa_paste['paste_title'] = (!empty($fa_paste['paste_title'])) ? $fa_paste['paste_title'] : $fa_paste['paste_id'];
		if($fa_paste['paste_userid'] == 0)
		{
			$paste_user = $L['pastebin_by'] . '<span style="font-style:italic">' . htmlspecialchars($fa_paste['paste_username']) . '</span>';
		}
		else
		{
			$paste_user = $L['pastebin_by'] . cot_build_user($fa_paste['paste_userid'], $fa_paste['paste_username']);
		}
		$paste_date = cot_build_timegap($fa_paste['paste_created'], $sys['now_offset']);
		$paste_date = (!empty($paste_date)) ? $paste_date.' '.$L['Ago'] : @date($cfg['dateformat'], $fa_paste['paste_created'] + $usr['timezone'] * 3600);
		$fa_paste['paste_title'] = (!empty($fa_paste['paste_title'])) ? $fa_paste['paste_title'] : $fa_paste['paste_id'];
		$t->assign(array(
			'PASTE_TITLE' => cot_rc_link(cot_url('plug', 'e=pastebin&m=view&id='.$fa_paste['paste_id']), $fa_paste['paste_title']),
			'PASTE_USER' => $paste_user,
			'PASTE_DATE' => $paste_date,
			'PASTE_REMFLAG' => cot_rc_link(cot_url('plug', 'e=pastebin&m=adm&id='.$fa_paste['paste_id']), $L['pastebin_remflag']),
			'PASTE_DELETE' => cot_rc_link(cot_url('plug', 'e=pastebin&m=del&id='.$fa_paste['paste_id']), $L['Delete']),
		));
		$t->parse('MAIN.FLAGGED');
	}
}
else
{
	$t->parse('MAIN.NOFLAGS');
}
$t->assign(array(
	'PASTE_URL' => cot_url('plug', 'e=pastebin'),
	'PASTE_ADMINURL' => cot_url('plug', 'e=pastebin&m=adm'),
));
?>