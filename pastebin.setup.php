<?php
/* ====================
[BEGIN_COT_EXT]
Code=pastebin
Name=Pastebin
Description=Pastebin for posting code snippets
Version=1.1.1
Date=2011-11-26
Author=Kilandor
Copyright=Copyright (c) 2009-2011 Jason Booth, Cotonti Team
Notes=Requires a CAPTCHA plugin
SQL=
Auth_guests=R
Lock_guests=12345A
Auth_members=RW
Lock_members=12345A
[END_COT_EXT]

[BEGIN_COT_EXT_CONFIG]
allowprivate=10:radio:Yes,No:1:Allow Private Pastes
allownever=11:radio:Yes,No:1:Allow Pastes to Never Expire
allowpass=12:radio:Yes,No:1:Allow Passworded Pastes
listlimit=13:string::10:Number of Recent pastes to show
checkintreval=14:string::5:How many mintues to check for expired Pastes
checktime=15:string::0:Placeholder for last checked time Reset to 0 to check instantly
[END_COT_EXT_CONFIG]
==================== */

defined('COT_CODE') or die('Wrong URL.');

?>