<?php
/**
 * Single pastie viewer
 *
 * @package pastebin
 * @version 1.1
 * @author Kilandor, Trustmaster
 * @copyright Copyright (c) 2009-2011 Jason Booth, Cotonti Team
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL.');

$sql_paste = $db->query("SELECT * FROM $db_pastebin WHERE paste_id = ".$id);
if ($sql_paste->rowCount() > 0)
{
	$paste_pass = cot_import('pastepass','P','TXT',16);
	$fa_paste = $sql_paste->fetch();
	$fa_paste['paste_title'] = (!empty($fa_paste['paste_title'])) ? $fa_paste['paste_title'] : $fa_paste['paste_id'];
	$paste_title = cot_rc_link(cot_url('plug', 'e=pastebin&m=view&id='.$fa_paste['paste_id']), $fa_paste['paste_title']);
	if(!$fa_paste['paste_password'] || md5($paste_pass) == $fa_paste['paste_password'])
	{
		$paste_username = $fa_paste['paste_username'];
		if($fa_paste['paste_userid'] == 0)
		{
			$paste_user = $L['pastebin_createdby'] . '<span style="font-style:italic">'.htmlspecialchars($paste_username).'</span>';
		}
		else
		{
			$paste_user = $L['pastebin_createdby'] . cot_build_user($fa_paste['paste_userid'], $paste_username);
		}
		$paste_date = cot_build_timegap($fa_paste['paste_created'], $sys['now']);
		$paste_date = (!empty($paste_date)) ? $paste_date.' '.$L['Ago'] : @date($cfg['dateformat'], $fa_paste['paste_created'] + $usr['timezone'] * 3600);
		$paste_expire = ($fa_paste['paste_expire'] > 0) ? cot_build_timegap($sys['now'], $fa_paste['paste_expire']) : $L['pastebin_never'];
		$paste_expire = (!empty($paste_expire) && $paste_expire != $L['pastebin_never']) ? $L['pastebin_expirein'].' '.$paste_expire : $paste_expire;
		$paste_expire = (!empty($paste_expire) && $paste_expire == $L['pastebin_never']) ? $L['pastebin_expireon'].' '.$paste_expire : $paste_expire;
		$paste_expire = (!empty($paste_expire)) ? $paste_expire : $L['pastebin_expireon'].' '.@date($cfg['dateformat'], $fa_paste['paste_expire']);
		if (cot_auth('plug', 'pastebin', 'A'))
		{
			$paste_userip = cot_build_ipsearch($fa_paste['paste_userip']);
			$paste_delete = cot_rc_link(cot_url('plug', 'e=pastebin&m=del&id='.$fa_paste['paste_id']), $L['Delete']);
		}
		elseif (($usr['id'] > 0 && $usr['id'] = $fa_paste['paste_userid']) || ($usr['ip'] == $fa_paste['paste_userip']))
		{
			$paste_delete = cot_rc_link(cot_url('plug', 'e=pastebin&m=del&id='.$fa_paste['paste_id']), $L['Delete']);
		}
		if (cot_plugin_active('bbcode'))
		{
			require_once cot_incfile('bbcode', 'plug');
			$text = cot_bbcode_cdata($fa_paste['paste_text']);
		}
		else
		{
			$text = htmlspecialchars($fa_paste['paste_text']);
		}
		$t->assign(array(
			'PASTE_USER' => $paste_user,
			'PASTE_USERIP' => $paste_userip,
			'PASTE_DATE' => $paste_date,
			'PASTE_EXPIRE' => $paste_expire,
			'PASTE_TEXT' => '<pre class="brush: '.$fa_paste['paste_type'].'">'.$text.'</pre>',
			'PASTE_DESC' => htmlspecialchars($fa_paste['paste_desc']),
			'PASTE_DELETE' => $paste_delete,
			'PASTE_FLAG' => cot_rc_link(cot_url('plug', 'e=pastebin&m=flag&id='.$fa_paste['paste_id']), $L['pastebin_flag']),
		));

		if (cot_plugin_active('tags'))
		{
			//Show Tags
			require_once cot_incfile('tags', 'plug');
			$tags = cot_tag_list($id, 'pastebin');
			if(count($tags) > 0)
			{
				foreach($tags as $tag)
				{
					$tag_u = $cfg['plugin']['tags']['translit'] ? cot_translit_encode($tag) : $tag;
					$tl = $lang != 'en' && $tag_u != urlencode($tag) ? '&tl=1' : '';
					$t->assign(array(
						'PASTE_TAGS_ROW_TAG' => $cfg['plugin']['tags']['title'] ? htmlspecialchars(cot_tag_title($tag)) : htmlspecialchars($tag),
						'PASTE_TAGS_ROW_URL' => cot_url('plug', 'e=tags&a=pastebin&t='.$tag_u.$tl)
					));
					$t->parse('MAIN.VIEW.TAGS_ROW');
				}
			}
			else
			{
				$t->assign(array(
					'PASTE_NO_TAGS' => $L['tags_Tag_cloud_none'],
				));
				$t->parse('MAIN.VIEW.NO_TAGS');
			}
		}
		$t->parse('MAIN.VIEW');
	}
	else
	{
		$t->parse('MAIN.PASSWORDED');
	}
}
else
{
	cot_redirect(cot_url('plug', 'e=pastebin'));
}

$out['subtitle'] = strip_tags($paste_title);
$t->assign(array(
	'PASTE_URL' => cot_url('plug', 'e=pastebin'),
	'PASTE_TITLE' => $paste_title,
));
?>
