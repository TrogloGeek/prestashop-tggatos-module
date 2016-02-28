{capture name=path}{l s='Card payment' mod='tggatos'}{/capture}
{if version_compare($smarty.const._PS_VERSION_, '1.5', '>=') && version_compare($smarty.const._PS_VERSION_, '1.6', '<')}
	{include file=$tpl_dir|cat:'breadcrumb.tpl'}
{/if}

<h2>{l s='Payment' mod='tggatos'}</h2>

{assign var='current_step' value='payment'}
{include file=$tpl_dir|cat:'order-steps.tpl'}


<h3>
	{l s='Waiting for bank validation' mod='tggatos'}
</h3>
<p>
	<img src="{$tggatos_pathURI}views/img/atos.gif" alt="{l s='Card payment' mod='tggatos'}" style="float:left; margin: 0px 10px 5px 0px;" />
	{l s='We are waiting for the bank to process your payment. We will send you an email confirmation as soon as we receive it.' mod='tggatos'}
</p>
