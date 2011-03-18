<?php
/**
 * Pastebin language file
 *
 * @package pastebin
 * @version 1.1
 * @author Kilandor
 * @copyright Copyright (c) 2009-2011 Jason Booth, Cotonti Team
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL.');

$L['cfg_allownever'] = array('Allow Pastes to Never Expire');
$L['cfg_allowpass'] = array('Allow Passworded Pastes');
$L['cfg_allowprivate'] = array('Allow Private Pastes');
$L['cfg_checkintreval'] = array('How many mintues to check for expired Pastes');
$L['cfg_checktime'] = array('Placeholder for last checked time Reset to 0 to check instantly');
$L['cfg_listlimit'] = array('Number of Recent pastes to show');

$L['pastebin_pastebin'] = 'Pastebin';
$L['pastebin_newpaste'] = 'Make a new Paste!';
$L['pastebin_unabletopaste'] = 'You currently do not have access to Paste.';
$L['pastebin_textarea'] = 'Paste Text<br /> This should be your code snippet.';
$L['pastebin_type'] = 'Code Type';
$L['pastebin_username'] = 'Username';
$L['pastebin_expire'] = 'Expire';
$L['pastebin_never'] = 'Never';
$L['pastebin_Week'] = 'week';
$L['pastebin_Weeks'] = 'weeks';
$L['pastebin_Month'] = 'month';
$L['pastebin_Months'] = 'months';
$L['pastebin_Year'] = 'year';
$L['pastebin_private'] = 'Make Private';
$L['pastebin_privatepass'] = 'Password';
$L['pastebin_title'] = 'Title';
$L['pastebin_desc'] = 'Description';
$L['pastebin_tags'] = 'Tags<br />(comma separated)';
$L['pastebin_password'] = 'This Paste is password protected to view it you must have the password.';
$L['pastebin_expirein'] = 'Expires in';
$L['pastebin_expireon'] = 'Expires on';
$L['pastebin_recentpastes'] = 'Recent Pastes: ';
$L['pastebin_by'] = 'by: ';
$L['pastebin_createdby'] = 'Created by: ';
$L['pastebin_flag'] = 'Report this Paste';
$L['pastebin_captcha'] = 'Security Code (case-sensitive)';
$L['pastebin_delete'] = 'To delete this paste fill out the CAPTCHA below and submit.';
$L['pastebin_flaged'] = 'You should only report a paste if it is inappropriate, spam, etc.<br />To report this paste, fill out the CAPTCHA below and submit.';
$L['pastebin_notice'] = 'flagged pastes';
$L['pastebin_admin'] = 'Admin';
$L['pastebin_noflags'] = 'There are no flagged pastes.';
$L['pastebin_remflag'] = 'Remove Flag';
$L['pastebin_admnote'] = 'Admins do not have to fill in the captcha, you may bypass it, And just submit.<br />';
$L['pastebin_requiredfields'] = 'The only required fields are Text, and Expire.<br />*Note Private only hides the paste from the recent list, it is still accessible. To restrict access you must provide a password.';

?>