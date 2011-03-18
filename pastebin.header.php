<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=header.main
[END_COT_EXT]
==================== */

/**
 * Pastebin API file
 *
 * @package pastebin
 * @version 1.1
 * @author Kilandor, Trustmaster
 * @copyright Copyright (c) 2009-2011 Jason Booth, Cotonti Team
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL.');

if (cot_auth('plug', 'pastebin', 'A'))
{
	require_once cot_incfile('pastebin', 'plug');
	$pb_flagged_count = $db->query("SELECT COUNT(*) FROM $db_pastebin WHERE paste_flagged=1")->fetchColumn();
	if($pb_flagged_count > 0)
	{
		$notice_seperator = (!empty($out['notices'])) ? ' | ' : '';
		$out['notices'] .= $notice_seperator . cot_rc_link(cot_url('plug', 'e=pastebin&m=adm'), $pb_flagged_count . ' ' . $L['pastebin_notice']);
	}
}

?>