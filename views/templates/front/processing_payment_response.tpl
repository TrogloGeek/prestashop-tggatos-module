{extends file='page.tpl'}

{block name="page_content"}
	<h2>{l s='Processing payment' mod='tggatos'}</h2>
	<div class="tggatos-status-wrapper tggatos-status-awaiting" data-ajax-url="{$tggatos_ajaxUrl}">
		<div class="tggatos-awaiting-silentesponse">
			<p>
				<img src="{$tggatos_pathURI}views/img/atos.gif" alt="{l s='Card payment' mod='tggatos'}" style="float:left; margin: 0px 10px 5px 0px;" />
				{l s='We are currently processing your payment. It may take a few moments, you can wait here or close this page and wait for our order confirmation email.' mod='tggatos'}
			</p>
			<div class="tggatos-status-icon-wrapper">
				<i class="material-icons tggatos-status-icon">sync</i>
			</div>
		</div>
		<div class="tggatos-silentresponse-completed">
			<p>
				<img src="{$tggatos_pathURI}views/img/atos.gif" alt="{l s='Card payment' mod='tggatos'}" style="float:left; margin: 0px 10px 5px 0px;" />
				{l s='Your payment has been processed, you will be redirected in a few seconds.' mod='tggatos'}
			</p>
			<div class="tggatos-status-icon-wrapper">
				<i class="material-icons tggatos-status-icon">done</i>
			</div>
		</div>
	</div>
{/block}
