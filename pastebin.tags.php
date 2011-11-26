<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=tags.search.custom
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

if ($a == 'pastebin')
{
	require_once cot_incfile('pastebin', 'plug');

	$t->assign(array(
		'TAGS_ACTION' => cot_url('plug', 'e=tags&a=pastebin'),
		'TAGS_HINT' => $L['tags_Query_hint'],
		'TAGS_QUERY' => htmlspecialchars($qs)
	));
	if (empty($qs))
	{
		// Global tag cloud and search form
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
		$t->assign('TAGS_CLOUD_BODY', $tc_html);
		$t->parse('MAIN.TAGS_CLOUD');
	}
	else
	{
		// Search results
		$query = cot_tag_parse_query($qs);
		$d = cot_import('d', 'G', 'INT');
		if(empty($d))
		{
			$d = 0;
		}
		if (!empty($query))
		{
			$totalitems = $db->query("SELECT COUNT(*)
				FROM $db_tag_references AS r LEFT JOIN $db_pastebin AS p
					ON r.tag_item = p.paste_id
				WHERE r.tag_area = 'pastebin' AND ($query)")->fetchColumn();
			$sql_pb = $db->query("SELECT p.paste_id, p.paste_title
				FROM $db_tag_references AS r LEFT JOIN $db_pastebin AS p
					ON r.tag_item = p.paste_id
				WHERE r.tag_area = 'pastebin' AND ($query)
				LIMIT $d, {$cfg['maxrowsperpage']}");
			$t->assign('TAGS_RESULT_TITLE', $L['Search_results']);
			foreach ($sql_pb->fetchAll() as $row)
			{
				$tags = cot_tag_list($row['paste_id'], 'pastebin');
				$tag_list = '';
				foreach($tags as $tag)
				{
					$tag_t = $cfg['plugin']['tags']['title'] ? cot_tag_title($tag) : $tag;
					$tag_u = $cfg['plugin']['tags']['translit'] ? cot_translit_encode($tag) : $tag;
					$tl = $lang != 'en' && $tag_u != $tag ? 1 : null;
					$tag_list .= cot_rc_link(cot_url('plug', array('e'=> 'tags', 'a' => 'pastebin', 't' => $tag_u, 'tl' => $tl)), $tag_t) . ' ';
				}
				$row['paste_title'] = (!empty($row['paste_title'])) ? $row['paste_title'] : $row['paste_id'];
				$t->assign(array(
					'TAGS_RESULT_ROW_URL' => cot_url('plug', 'e=pastebin&m=view&id='.$row['paste_id']),
					'TAGS_RESULT_ROW_TITLE' => htmlspecialchars($row['paste_title']),
					'TAGS_RESULT_ROW_PATH' => cot_rc_link(cot_url('plug', 'e=pastebin'), $L['pastebin_pastebin']),
					'TAGS_RESULT_ROW_TAGS' => $tag_list
				));
				$t->parse('MAIN.TAGS_RESULT.TAGS_RESULT_ROW');
			}

			$pagenav = cot_pagenav('plug', array(
				'e' => 'tags',
				'a' => 'pastebin',
				't' => $qs), $d, $totalitems, $cfg['maxrowsperpage']);

			$t->assign(array(
				'TAGS_PAGEPREV' => $pagenav['prev'],
				'TAGS_PAGENEXT' => $pagenav['next'],
				'TAGS_PAGNAV' => $pagenav['main']
			));
			$t->parse('MAIN.TAGS_RESULT');
		}
	}
}
?>