<?php
/**
 * Pastebin main listing and form
 *
 * @package pastebin
 * @version 1.1
 * @author Kilandor, Trustmaster
 * @copyright Copyright (c) 2009-2011 Jason Booth, Cotonti Team
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL.');

if ($_POST['submit'])
{
	cot_shield_protect();
	$paste_username = cot_import('pasteusername', 'P', 'ALP');
	$paste_type = cot_import('pastetype', 'P', 'ALP');
	$paste_expire = cot_import('pasteexpire', 'P', 'TXT');
	$paste_private = cot_import('pasteprivate', 'P', 'BOL');
	$paste_title = cot_import('pastetitle', 'P', 'TXT');
	$paste_desc = cot_import('pastedesc', 'P', 'TXT');
	$paste_tags = cot_import('pastetags', 'P', 'TXT');
	$paste_pass1 = cot_import('pastepass1','P','TXT',16);
	$paste_pass2 = cot_import('pastepass2','P','TXT',16);
	$paste_text = cot_import('pastetext', 'P', 'NOC');
	if ($paste_expire > 0)
	{
		$paste_expire = explode(' ', $paste_expire);
		$paste_expire = $paste_expire[0] * $paste_times[$paste_expire[1]] + $sys['now'];
	}
	elseif ((!$cfg['plugin']['pastebin']['allownever'] && $paste_expire == 0) || (empty($paste_expire) && $paste_expire != 0))
	{
		$paste_expire = (2629744+$sys['now']);
	}
	$paste_private = (!$cfg['plugin']['pastebin']['allowprivate'] && $paste_private == 1) ? 0 : $paste_private;
	$paste_username = (!empty($paste_username)) ? $paste_username : $usr['name'];
	$paste_pass = (($paste_pass1 == $paste_pass2) && (!empty($paste_pass1) && !empty($paste_pass2))) ? md5($paste_pass1) : '';
	$paste_pass = (!$cfg['plugin']['pastebin']['allowpass'] && !empty($paste_private)) ? '' : $paste_pass;
	if (empty($paste_text))
	{
		cot_error('pastebin_notext', 'pastetext');
	}
	
	if (!cot_error_found())
	{
		$db->insert($db_pastebin, array(
			'paste_username' => $paste_username,
			'paste_userid' => $usr['id'],
			'paste_userip' => $usr['ip'],
			'paste_type' => $paste_type,
			'paste_private' => $paste_private,
			'paste_password' => $paste_pass,
			'paste_created' => $sys['now'],
			'paste_expire' => $paste_expire,
			'paste_title' => $paste_title,
			'paste_desc' => $paste_desc,
			'paste_text' => $paste_text
		));
		
		$insert_id = $db->lastInsertId();

		if (!empty($paste_tags) && cot_plugin_active('tags'))
		{
			require_once cot_incfile('tags', 'plug');
			$tags = cot_tag_parse($paste_tags);
			$cnt = 0;
			foreach($tags as $tag)
			{
				cot_tag($tag, $insert_id, 'pastebin');
				$cnt++;
				if($cfg['plugin']['tags']['limit'] > 0 && $cnt == $cfg['plugin']['tags']['limit'])
				{
					break;
				}
			}
		}
		cot_shield_update(30, 'New Paste');
		cot_redirect(cot_url('plug', 'e=pastebin&m=view&id='.$insert_id, '', true));
	}
}
$sql_pastes = $db->query("SELECT * FROM $db_pastebin WHERE paste_private = 0 ORDER BY paste_created DESC LIMIT ".$cfg['plugin']['pastebin']['listlimit']);
foreach ($sql_pastes->fetchAll() as $fa_pastes)
{
	$paste_username = $fa_pastes['paste_username'];
	if($fa_pastes['paste_userid'] == 0)
	{
		$paste_user = $L['pastebin_by'].'<span style="font-style:italic">'.htmlspecialchars($paste_username).'</span>';
	}
	else
	{
		$paste_user = $L['pastebin_by'] . cot_build_user($fa_pastes['paste_userid'], $paste_username);
	}
	$paste_date = cot_build_timegap($fa_pastes['paste_created'], $sys['now']);
	$paste_date = (!empty($paste_date)) ? $paste_date.' '.$L['Ago'] : @date($cfg['dateformat'], $fa_pastes['paste_created'] + $usr['timezone'] * 3600);
	$fa_pastes['paste_title'] = (!empty($fa_pastes['paste_title'])) ? $fa_pastes['paste_title'] : $fa_pastes['paste_id'];
	$t->assign(array(
		'PASTE_RECENT_TITLE' => cot_rc_link(cot_url('plug', 'e=pastebin&m=view&id='.$fa_pastes['paste_id']), $fa_pastes['paste_title']),
		'PASTE_RECENT_USER' => $paste_user,
		'PASTE_RECENT_DATE' => $paste_date,
	));
	$t->parse('MAIN.RECENTPASTES');
}

if (cot_plugin_active('tags'))
{
	// Show Tags
	require_once cot_incfile('tags', 'plug');
	$tcloud = cot_tag_cloud('pastebin', $cfg['plugin']['tags']['order']);
	$tc_html = $R['tags_code_cloud_open'];
	$tag_count = 0;
	foreach($tcloud as $tag => $cnt)
	{
		$tag_count++;
		$tag_t = $cfg['plugin']['tags']['title'] ? cot_tag_title($tag) : $tag;
		$tag_u = $cfg['plugin']['tags']['translit'] ? cot_translit_encode($tag) : $tag;
		$tl = $lang != 'en' && $tag_u != urlencode($tag) ? '&tl=1' : '';
		foreach ($tc_styles as $key => $val)
		{
			if ($cnt <= $key)
			{
				$dim = $val;
				break;
			}
		}
		$tc_html .= cot_rc('tags_link_cloud_tag', array(
			'url' => cot_url('plug', 'e=tags&a=pastebin' . $tl . '&t=' . $tag_u),
			'tag_title' => htmlspecialchars($tag_t),
			'dim' => $dim
		));
	}
	$tc_html .= $R['tags_code_cloud_close'];
	$tc_html = ($tag_count > 0) ? $tc_html : $L['tags_Tag_cloud_none'];
	$t->assign(array(
		'PASTE_TOP_TAG_CLOUD' => $L['tags_Tag_cloud'],
		'PASTE_TAG_CLOUD' => $tc_html,
		'PASTE_URL' => cot_url('plug', 'e=pastebin'),
	));
}

if (cot_auth('plug', 'pastebin', 'W'))
{
	if ($usr['id'] == 0)
	{
		$t->parse('MAIN.NEWPASTE.USERNAME');
	}
	if ($cfg['plugin']['pastebin']['allowprivate'])
	{
		$t->parse('MAIN.NEWPASTE.PRIVATE');
	}
	if ($cfg['plugin']['pastebin']['allowpass'])
	{
		$t->parse('MAIN.NEWPASTE.PASS');
	}
	if ($cfg['plugin']['pastebin']['allownever'])
	{
		$t->parse('MAIN.NEWPASTE.NEVER');
	}
	$t->assign(array(
		'PASTE_SEND' => cot_url('plug', 'e=pastebin&m=new')
	));
	$t->parse('MAIN.NEWPASTE');
}
else
{
	$t->parse('MAIN.UNABLE_TO_PASTE');
}
?>
