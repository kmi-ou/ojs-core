{**
 * Core Plugin settings
 *}

{assign var="pageTitle" value="plugins.generic.corePlugin.manager.corePluginSettings"}
{include file="common/header.tpl"}

{translate key="plugins.generic.corePlugin.manager.settings.description"}

<div class="separator"></div>

<br />

<form method="post" action="{plugin_url path="settings"}">
{include file="common/formErrors.tpl"}

<table width="100%" class="data">
	<tr valign="top">
		<td width="20%" class="label">{fieldLabel name="coreApiKey" required="true" key="plugins.generic.corePlugin.manager.settings.coreApiKey"}</td>
		<td width="80%" class="value"><input type="text" name="coreApiKey" id="coreApiKey" value="{if $coreApiKey}{$coreApiKey|escape}{/if}" size="30" maxlength="255" class="textField" />
		<br />
		<span class="instruct">{translate key="plugins.generic.corePlugin.manager.settings.coreApiKeyInstructions"}</span>
	</td>
	</tr>
   	<tr valign="top">
		<td width="20%" class="label">{fieldLabel name="corePluginTitle" required="false" key="plugins.generic.corePlugin.manager.settings.corePluginTitle"}</td>
		<td width="80%" class="value"><input type="text" name="corePluginTitle" id="corePluginTitle" value="{if $corePluginTitle}{$corePluginTitle|escape}{else}Similar Articles (Provided by CORE){/if}" size="30" maxlength="255" class="textField" />
		<br />
		<span class="instruct">{translate key="plugins.generic.corePlugin.manager.settings.corePluginTitleInstructions"}</span>
	</td>
	</tr>
</table>

<br/>

<input type="submit" name="save" class="button defaultButton" value="{translate key="common.save"}"/><input type="button" class="button" value="{translate key="common.cancel"}" onclick="history.go(-1)"/>
</form>

<p><span class="formRequired">{translate key="common.requiredField"}</span></p>

{include file="common/footer.tpl"}
