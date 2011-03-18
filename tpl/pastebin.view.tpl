<!-- BEGIN: MAIN -->
<div class="col70 top bottom">
	<h2 class="plugin"><a href="{PASTE_URL}">{PHP.L.pastebin_pastebin}</a> / {PASTE_TITLE}</h2>
	<!-- BEGIN: VIEW -->
	<div class="page_text">{PASTE_TEXT}</div>
	<div class="block">
		<h4>{PHP.L.Tags}:</h4>
		<!-- BEGIN: TAGS_ROW -->
		<a href="{PASTE_TAGS_ROW_URL}">{PASTE_TAGS_ROW_TAG}</a>&nbsp;
		<!-- END: TAGS_ROW -->
		<!-- BEGIN: NO_TAGS -->
		{PASTE_NO_TAGS}
		<!-- END: NO_TAGS -->
	</div>

</div>

<aside class="col30 top bottom first">
	<div class="block">
		<h3>{PHP.L.Item}</h3>
		<h4>{PASTE_USER}</h4>
		<p>{PHP.L.Date}: {PASTE_DATE}</p>
		<ul>
			<li>{PASTE_FLAG}</li>
			<li>{PASTE_DELETE}</li>
			<li>{PASTE_USERIP}</li>
			<li>{PASTE_EXPIRE}</li>
		</ul>
	</div>
</aside>

<!-- END: VIEW -->

<!-- BEGIN: PASSWORDED -->
	<div class="block">
		{PHP.L.pastebin_password}<br />
		<form action="{PASTE_SEND}" method="post">
		{PHP.L.pastebin_privatepass}<input type="password" name="pastepass" size="16" maxlength="16" /><br />
		<input type="submit" name="submit" value="{PHP.L.Submit}" />
		</form>
	</div>
</div>
<!-- END: PASSWORDED -->

<!-- END: MAIN -->