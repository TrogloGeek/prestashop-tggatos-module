<p class="bold">
	{if $tggatos_response && ($tggatos_response->response_code == '00')}
		{l s='Your payment has been validated and your order recorded.' mod='tggatos'}<br />
	{else}
		{l s='Your order has been recorded.' mod='tggatos'}
	{/if}
    <br />
	{l s='We will process your order as soon as possible.' mod='tggatos'}
</p>
{if $tggatos_response}
<br /><br />
<div class="table_block">
	<table class="std">
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
		</tbody>
	</table>
</div>
{/if}