<?php
/**
 * Pastebin language file
 *
 * @package pastebin
 * @version 1.1
 * @author Trustmaster
 * @copyright Copyright (c) 2009-2011 Jason Booth, Cotonti Team
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL.');

$L['cfg_allownever'] = array('Разрешить не устаревающие Вставки');
$L['cfg_allowpass'] = array('Разрешить Вставки, защищенные паролем');
$L['cfg_allowprivate'] = array('Разрешить приватные Вставки');
$L['cfg_checkintreval'] = array('Интервал проверки устаревания Вставок в минутах');
$L['cfg_checktime'] = array('Метка последней проверки устаревших вставок, измените на 0 для немедленной проверки');
$L['cfg_listlimit'] = array('Число отображаемых последних Вставок');

$L['pastebin_pastebin'] = 'Pastebin';
$L['pastebin_newpaste'] = 'Сделать новую Вставку!';
$L['pastebin_unabletopaste'] = 'У вас нет доступа к Вставке.';
$L['pastebin_textarea'] = 'Вставьте текст<br /> Это должен быть ваш кусок кода.';
$L['pastebin_type'] = 'Тип кода';
$L['pastebin_username'] = 'Имя пользователя';
$L['pastebin_expire'] = 'Устаревает';
$L['pastebin_never'] = 'Никогда';
$L['pastebin_Year'] = 'год';
$L['pastebin_private'] = 'Сделать приватной';
$L['pastebin_privatepass'] = 'Пароль';
$L['pastebin_title'] = 'Заголовок';
$L['pastebin_desc'] = 'Описание';
$L['pastebin_tags'] = 'Тэги<br />(разделяя запятой)';
$L['pastebin_password'] = 'Эта Вставка защищена паролем. Вам необходимо ввести пароль для ее просмотра.';
$L['pastebin_expirein'] = 'Устаревает';
$L['pastebin_expireon'] = 'Устаревает';
$L['pastebin_recentpastes'] = 'Последние Вставки: ';
$L['pastebin_by'] = 'от: ';
$L['pastebin_createdby'] = 'Добавил: ';
$L['pastebin_flag'] = 'Сообщить об этой Вставке';
$L['pastebin_captcha'] = 'Код безопасности (регистро-зависимый)';
$L['pastebin_delete'] = 'Чтобы удалить вставку, заполните CAPTCHA внизу и отправьте форму.';
$L['pastebin_flaged'] = 'Вы должны сообщать о вставке администрации, только если она содержит нелегальную информацию, спам и т.д.<br />Чтобы пожаловаться на вставку, заполните CAPTCHA внизу и отправьте форму.';
$L['pastebin_notice'] = 'отмеченные вставки';
$L['pastebin_admin'] = 'Админ';
$L['pastebin_noflags'] = 'Нет отмеченных вставок.';
$L['pastebin_remflag'] = 'Удалить отметку';
$L['pastebin_admnote'] = 'Администраторам не нужно заполнять CAPTCHA, вы можете ее пропустить и отправить форму.<br />';
$L['pastebin_requiredfields'] = 'Необходимые поля - Текст и Устаревает.<br />*Приватность убирает вставку из списка последних добавленных, но доступ к ней по-прежнему общий. Чтобы ограничить доступ, нужно задать пароль.';

?>