<!-- BEGIN: MAIN -->
<div class="col70 top bottom">
	<h2 class="plugin"><a href="{PASTE_URL}">{PHP.L.pastebin_pastebin}</a></h2>
	<!-- BEGIN:NEWPASTE -->
	<form action="{PASTE_SEND}" method="post">
	<table class="flat">
		<tr>
			<td>{PHP.L.pastebin_textarea}</td>
			<td><textarea name="pastetext" cols="80" rows="20"></textarea></td>
		</tr>
		<!-- BEGIN:USERNAME -->
		<tr>
			<td>{PHP.L.pastebin_username}</td>
			<td><input name="pasteusername" size="10" maxlength="24" /></td>
		</tr>
		<!-- END:USERNAME -->
		<tr>
			<td>{PHP.L.pastebin_type}</td>
			<td>
				<select name="pastetype">
					<option value="php">PHP</option>
					<option value="SQL">SQL</option>
					<option value="html">HTML</option>
					<option value="css">CSS</option>
					<option value="js">JS</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>{PHP.L.pastebin_expire}</td>
			<td>
				<select name="pasteexpire">
				<!-- BEGIN: NEVER -->
				<option value="0" selected="selected">{PHP.L.pastebin_never}</option>
				<!-- END: NEVER -->
				<option value="5 minute">5 {PHP.L.Minutes.0}</option><option value="10 minute">10 {PHP.L.Minutes.0}</option><option value="15 minute">15 {PHP.L.Minutes.0}</option><option value="30 minute">30 {PHP.L.Minutes.0}</option><option value="45 minute">45 {PHP.L.Minutes.0}</option>
				<option value="1 hour">1 {PHP.L.Hours.1}</option><option value="2 hour">2 {PHP.L.Hours.0}</option><option value="4 hour">4 {PHP.L.Hours.0}</option><option value="8 hour">8 {PHP.L.Hours.0}</option><option value="12 hour">12 {PHP.L.Hours.0}</option>
				<option value="1 day">1 {PHP.L.Days.1}</option><option value="2 day">2 {PHP.L.Days.0}</option><option value="3 day">3 {PHP.L.Days.0}</option>
				<option value="1 week">1 {PHP.L.Week}</option><option value="2 week">2 {PHP.L.Weeks}</option><option value="3 week">3 {PHP.L.Weeks}</option>
				<option value="1 month" selected="selected">1 {PHP.L.Month}</option><option value="2 month">2 {PHP.L.Months}</option><option value="3 month">3 {PHP.L.Months}</option><option value="4 month">4 {PHP.L.Months}</option><option value="5 month">5 {PHP.L.Months}</option><option value="6 month">6 {PHP.L.Months}</option>
				<option value="1 year">1 {PHP.L.pastebin_Year}</option>
				</select>
			</td>
		</tr>
		<!-- BEGIN: PRIVATE -->
		<tr>
			<td>{PHP.L.pastebin_private}</td>
			<td>
				<input type="checkbox" name="pasteprivate" />
			</td>
		</tr>
		<!-- END: PRIAVTE -->
		<!-- BEGIN: PASS -->
		<tr>
			<td>{PHP.L.pastebin_privatepass}</td>
			<td>
				<input type="password" name="pastepass1" size="10" maxlength="16" />
				<input type="password" name="pastepass2" size="10" maxlength="16" />
			</td>
		</tr>
		<!-- END: PASS -->
		<tr>
			<td>{PHP.L.pastebin_title}</td>
			<td>
				<input type="text" name="pastetitle" size="32" maxlength="64" />
			</td>
		</tr>
		<tr>
			<td>{PHP.L.pastebin_desc}</td>
			<td>
				<input type="text" name="pastedesc" size="32" maxlength="255" />
			</td>
		</tr>
		<tr>
			<td>{PHP.L.pastebin_tags}</td>
			<td>
				<input type="text" name="pastetags" size="32" maxlength="255" />
			</td>
		</tr>
		<tr>
			<td colspan="2">
				{PHP.L.pastebin_requiredfields}
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" name="submit" value="{PHP.L.Submit}" />
			</td>
		</tr>
	</table>
	</form>
	<!-- END:NEWPASTE -->
	<!-- BEGIN:UNABLE_TO_PASTE -->
	{PHP.L.pastebin_unabletopaste}
	<!-- END:UNABLE_TO_PASTE -->
	
</div>
<aside class="col30 top bottom first">
	<div class="block">
		<h3><a href="{PASTE_URL}">{PHP.L.pastebin_newpaste}</a></h3>
		<h3>{PHP.L.pastebin_recentpastes}</h3>
		<ul>
			<!-- BEGIN: RECENTPASTES -->
			<li>{PASTE_RECENT_TITLE}<br />
			&nbsp;&nbsp;{PASTE_RECENT_USER} {PASTE_RECENT_DATE}</li>
			<!-- END: RECENTPASTES -->
		</ul>
	</div>
	<div class="block">
		<h3>{PASTE_TOP_TAG_CLOUD}</h3>
		{PASTE_TAG_CLOUD}
	</div>
</aside>

<!-- END: MAIN -->