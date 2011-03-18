<!-- BEGIN: MAIN -->
<div class="col top bottom">
	<h2 class="plugin"><a href="{PASTE_URL}">{PHP.L.pastebin_pastebin}</a> / <a href="{PASTE_ADMINURL}">{PHP.L.pastebin_admin}</a></h2>
	<ul>
	<!-- BEGIN: FLAGGED -->
	<li>
	{PASTE_TITLE} - {PASTE_REMFLAG} - {PASTE_DELETE}<br />
	&nbsp;&nbsp;{PASTE_USER} {PASTE_DATE}<br />
	</li>
	<!-- END: FLAGGED -->
	</ul>
	<!-- BEGIN: NOFLAGS -->
	{PHP.L.pastebin_noflags}
	<!-- END: NOFLAGS -->
</div>
<!-- END: MAIN -->