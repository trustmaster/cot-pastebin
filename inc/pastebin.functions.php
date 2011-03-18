<?php
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

require_once cot_langfile('pastebin', 'plug');

$db_pastebin = isset($db_pastebin) ? $db_pastebin : $db_x . 'pastebin';

$paste_times = array(
	'year' => 31556926,
	'month' => 2629744,
	'week' => 604800,
	'day' => 86400,
	'hour' => 3600,
	'minute' => 60
);

// Detect captcha functions
if (!function_exists('cot_captcha_generate'))
{
    function cot_captcha_generate($func_index = 0)
    {
        global $cot_captcha;
        if(!empty($cot_captcha[$func_index]))
        {
            $captcha=$cot_captcha[$func_index] . '_generate';
            return $captcha();
        }
        return false;
    }
}

if(!function_exists('cot_captcha_validate'))
{
    function cot_captcha_validate($verify = 0 ,$func_index = 0)
    {
        global $cot_captcha;
        if(!empty($cot_captcha[$func_index]))
        {
            $captcha = $cot_captcha[$func_index] . '_validate';
            return $captcha($verify);
        }
        return false;
    }
}

?>