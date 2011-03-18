<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=standalone
[END_COT_EXT]
==================== */

/**
 * Pastebin main entry
 *
 * @package pastebin
 * @version 1.1
 * @author Kilandor, Trustmaster
 * @copyright Copyright (c) 2009-2011 Jason Booth, Cotonti Team
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL.');

$id = (int) cot_import('id', 'G', 'INT');
$paste_isadmin = cot_auth('plug', 'pastebin', 'A');
require_once cot_incfile('pastebin', 'plug');

$out['subtitle'] = $L['pastebin_pastebin'];

if ($cfg['plugin']['pastebin']['checktime'] + ($cfg['plugin']['pastebin']['checkintreval'] * 60) < $sys['now'])
{
	$db->update($db_config, array('config_value' => $sys['now']), "`config_owner` = 'plug' AND `config_cat` =  'pastebin' AND `config_name` = 'checktime'");
	$sql_expired = $db->query("SELECT paste_id FROM $db_pastebin WHERE paste_expire > 0 && paste_expire < ".$sys['now']);
	foreach ($sql_expired->fetchAll() as $fa_expired)
	{
		if (cot_plugin_active('tags'))
		{
			require_once cot_incfile('tags', 'plug');
			cot_tag_remove_all($fa_expired['paste_id'], 'pastebin');
		}
		$db->delete($db_pastebin, "paste_id = " . $fa_expired['paste_id']);
	}
}

if (!in_array($m, array('adm', 'flag', 'del', 'view')))
{
	$m = 'main';
}

$t = new XTemplate(cot_tplfile("pastebin.$m", 'plug'));
include cot_incfile('pastebin', 'plug', $m);

?>