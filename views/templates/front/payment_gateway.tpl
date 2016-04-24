{capture name=path}{l s='Card payment' mod='tggatos'}{/capture}
{if version_compare($smarty.const._PS_VERSION_, '1.5', '>=') && version_compare($smarty.const._PS_VERSION_, '1.6', '<')}
	{include file=$tpl_dir|cat:'breadcrumb.tpl'}
{/if}

<h2>{l s='Payment' mod='tggatos'}</h2>

{assign var='current_step' value='payment'}
{include file=$tpl_dir|cat:'order-steps.tpl'}


<h3>
	{l s='Card payment' mod='tggatos'}
	{if $tggatos_mode > tggatos::MODE_SINGLE}
		{capture assign='tggatos_splitMsg'}{l s='in %u times' mod='tggatos'}{/capture}
		{capture assign='tggatos_splitMsg'}{$tggatos_splitMsg|sprintf:$tggatos_mode}{/capture}
		{$tggatos_splitMsg}
	{/if}
</h3>
<p>
	<img src="{$tggatos_pathURI}views/img/atos.gif" alt="{l s='Card payment' mod='tggatos'}" style="float:left; margin: 0px 10px 5px 0px;" />
	{l s='You have chosen to pay by card' mod='tggatos'}{if $tggatos_mode > tggatos::MODE_SINGLE} {$tggatos_splitMsg}{/if}.<br />
    {l s='You will be redirected to a secure bank server where your card informations will be asked.' mod='tggatos'}<br />
	{l s='At any moment you can hit the cancel button in order to come back to our payment methods choice from bank server' mod='tggatos'}<br />
	{l s='Total amount to be paid:' mod='tggatos'}
	<span id="amount" class="price">{displayPrice price=$tggatos_totalAmount currency=$tggatos_paymentCurrency->id}</span>
	{if $tggatos_feesAmount}
		<br />
		<span class="payment_fees">{l s='Including payment fees:' mod='tggatos'} {displayPrice price=$tggatos_feesAmount currency=$tggatos_paymentCurrency->id}</span>
	{/if}
</p>

{if $tggatos_form}
    <p style="margin-top:20px;">
        <strong>{l s='Click on one of the payment meanings logos below to proceed on a secure bank server.' mod='tggatos'}</strong>
    </p>
    {$tggatos_form}
{else}
    <div class="error">
        <strong>{l s='Sorry, no more CB payments can be processed today, bank server should be available again at midnight.' mod='tggatos'}</strong>
    </div>
{/if}

<p class="cart_navigation">
	<a href="{$link->getPageLink('order.php', true, null)|cat:'?step=3&cgv=1'}" class="button_large">{l s='Other payment methods' mod='tggatos'}</a>
</p>
