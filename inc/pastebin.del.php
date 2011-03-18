<?php
/**
 * Pastebin Delete handler
 *
 * @package pastebin
 * @version 1.1
 * @author Kilandor, Trustmaster
 * @copyright Copyright (c) 2009-2011 Jason Booth, Cotonti Team
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL.');

$sql_paste = $db->query("SELECT * FROM $db_pastebin WHERE paste_id = " . $id);
if ($sql_paste->rowCount() > 0)
{
	$fa_paste = $sql_paste->fetch();
	if (cot_auth('plug', 'pastebin', 'A') || ($usr['id'] > 0 && $usr['id'] = $fa_paste['paste_userid']) || ($usr['ip'] == $fa_paste['paste_userip']))
	{
		if ($_POST['submit'])
		{
			if (!$paste_isadmin)
			{
				cot_shield_protect();
				$valid = cot_captcha_validate($_POST['pastecaptcha']);
			}
			if ($valid || $paste_isadmin)
			{
				if (!$paste_isadmin)
				{
					cot_shield_update(120, 'Delete a Paste');
				}

				if (cot_plugin_active('tags'))
				{
					require_once cot_incfile('tags', 'plug');
					cot_tag_remove_all($id, 'pastebin');
				}

				$db->delete($db_pastebin, "paste_id = $id");
				cot_redirect(cot_url('plug', 'e=pastebin'));
			}
		}
		$fa_paste['paste_title'] = (!empty($fa_paste['paste_title'])) ? $fa_paste['paste_title'] : $fa_paste['paste_id'];
		$paste_title = cot_rc_link(cot_url('plug', 'e=pastebin&m=view&id='.$fa_paste['paste_id']), $fa_paste['paste_title']);
		$t->assign(array(
			'PASTE_SEND' => cot_url('plug', 'e=pastebin&m=del&id='.$fa_paste['paste_id']),
			'PASTE_CAPTCHA' => cot_captcha_generate(),
			'PASTE_ADMNOTE' => ($paste_isadmin) ? $L['pastebin_admnote'] : '',
		));
	}
	else
	{
		cot_redirect(cot_url('plug', 'e=pastebin'));
	}
}
else
{
	cot_redirect(cot_url('plug', 'e=pastebin'));
}
$t->assign(array(
	'PASTE_URL' => cot_url('plug', 'e=pastebin'),
	'PASTE_TITLE' => $paste_title,
));
?>