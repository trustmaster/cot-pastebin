<!-- BEGIN: MAIN -->
<div class="col top bottom">
	<h2 class="plugin"><a href="{PASTE_URL}">{PHP.L.pastebin_pastebin}</a> / {PASTE_TITLE}</h2>
	<form action="{PASTE_SEND}" method="post">
	{PHP.L.pastebin_flaged}<br />
	{PASTE_CAPTCHA}<br />
	{PHP.L.pastebin_captcha}<br />
	{PASTE_ADMNOTE}
	<input type="text" name="pastecaptcha" size="4" maxlength="4" />&nbsp;&nbsp;
	<input type="submit" name="submit" value="{PHP.L.Submit}" />
	</form>
</div>
<!-- END: MAIN -->