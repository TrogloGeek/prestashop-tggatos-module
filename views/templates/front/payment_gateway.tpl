{extends file='page.tpl'}

{block name="page_content"}
	<h2>{l s='Payment' mod='tggatos'}</h2>

	{if $tggatos_sipsForm}
		<h3>
			{l s='Select your payment method' mod='tggatos'}
		</h3>
		<p class="clearfix">
			<img src="{$tggatos_pathURI}views/img/atos.gif" alt="{l s='Card payment' mod='tggatos'}" style="float:left; margin: 0px 10px 5px 0px;" />
			{l s='Please click the payment method of your choice below to be redirected on a secure bank server in order to proceed with the payment.' mod='tggatos'}
		</p>
		<div style="clear: left; margin: 2em auto;">{$tggatos_sipsForm nofilter}</div>
	{else}
		<h3>{l s='Card payment currently unavailable, we apologize for the inconvenience.' mod='tggatos'}</h3>
	{/if}
	<p style="clear: left;">
		<a class="btn btn-default" href="{$link->getPageLink('order')}" class="button_large">&lt; {l s='Other payment methods' mod='tggatos'}</a>
	</p>
{/block}
