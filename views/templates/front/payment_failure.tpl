{extends file='page.tpl'}

{block name="page_content"}
	<h2>{l s='Payment' mod='tggatos'}</h2>

	<h3>
        {l s='Card payment failure' mod='tggatos'}
	</h3>
	<p>
		<img src="{$tggatos_pathURI}views/img/atos.gif" alt="{l s='Card payment' mod='tggatos'}" style="float:left; margin: 0px 10px 5px 0px;" />
        {if $tggatos_response && $tggatos_response->response_code == '17'}
            {l s='The payment has been cancelled.' mod='tggatos'}<br />
        {elseif $tggatos_response}
            {l s='The payment is a failure. It means that either your transaction has been refused by your bank or an error has prevented the transaction to complete.' mod='tggatos'}<br />
        {else}
            {l s='The payment is a failure. It means that either your transaction has been refused by your bank or you decided to cancel the payment process.' mod='tggatos'}<br />
        {/if}
        {l s='Click the other payment methods button to restart payment process with one of the available methods.' mod='tggatos'}
	</p>
	<p class="cart_navigation">
		<a href="{$link->getPageLink('order')}" class="button_large">{l s='Other payment methods' mod='tggatos'}</a>
	</p>
    {if $tggatos_response}
		<br /><br />
		<table class="table">
			<thead>
			<tr>
				<th class="first_item">{l s='Payment summary:' mod='tggatos'}</th>
				<th class="last_item">&nbsp;</th>
			</tr>
			</thead>
			<caption></caption>
			<tbody>
			<tr class="item">
				<td>{l s='Merchant ID' mod='tggatos'}</td>
				<td>{$tggatos_response->merchant_id}</td>
			</tr>
			<tr class="alternate_item">
				<td>{l s='Transaction reference' mod='tggatos'}</td>
				<td>{$tggatos_response->transaction_id}</td>
			</tr>
			<tr class="item">
				<td>{l s='Payment means' mod='tggatos'}</td>
				<td>{$tggatos_response->payment_means}</td>
			</tr>
			<tr class="alternate_item">
				<td>{l s='Authorisation ID' mod='tggatos'}</td>
				<td>{$tggatos_response->authorisation_id}</td>
			</tr>
			<tr class="item">
				<td>{l s='Payment certificate' mod='tggatos'}</td>
				<td>{$tggatos_response->payment_certificate}</td>
			</tr>
			<tr class="alternate_item">
				<td>{l s='Payment date' mod='tggatos'}</td>
				<td>{$tggatos_response->payment_date}</td>
			</tr>
			<tr class="item">
				<td>{l s='Amount' mod='tggatos'}</td>
				<td>{Tools::displayPrice($tggatos_amount, $tggatos_currency)}</td>
			</tr>
			</tbody>
		</table>
		<p class="cart_navigation">
			<a href="{$link->getPageLink('order')}" class="button_large">{l s='Other payment methods' mod='tggatos'}</a>
		</p>
    {/if}
{/block}
