{* ___________________________ SINGLE ______________________________________ *}

{if $tggatos_singleForm}
	<p class="payment_module tggatos-direct tggatos-single">
		<img src="{$module_template_dir|escape:'html'}views/img/bank_logo/{$TggAtos->get('BANK')}.gif" alt="{l s='Pay by credit card' mod='tggatos'}" width="86" height="49"/>
		<span>
		{l s='Pay by credit card' mod='tggatos'}
		</span>
		<p style="margin-top:20px;">
			<strong>{l s='Click on one of the payment meanings logos below to proceed on a secure bank server.' mod='tggatos'}</strong>
		</p>
		{$tggatos_singleForm}
	</p>
{/if}

{* ___________________________ 2TIMES ______________________________________ *}


{if $tggatos_2tForm}
	<p class="payment_module tggatos-direct tggatos-2t">
		<img src="{$module_template_dir|escape:'html'}views/img/bank_logo/{$TggAtos->get('BANK')}.gif" alt="{l s='Pay by credit card in two payments' mod='tggatos'}" width="86" height="49"/>
		<span>
			{l s='Pay by credit card in two payments' mod='tggatos'}
		</span>
		<p style="margin-top:20px;">
			<strong>{l s='Click on one of the payment meanings logos below to proceed on a secure bank server.' mod='tggatos'}</strong>
		</p>
		{$tggatos_2tForm}
	</p>
{/if}

{* ___________________________ 3TIMES ______________________________________ *}

{if $tggatos_3tForm}
	<p class="payment_module tggatos-direct tggatos-3t">
		<img src="{$module_template_dir|escape:'html'}views/img/bank_logo/{$TggAtos->get('BANK')}.gif" alt="{l s='Pay by credit card in three payments' mod='tggatos'}" width="86" height="49"/>
		<span>
			{l s='Pay by credit card in three payments' mod='tggatos'}
		</span>
		<p style="margin-top:20px;">
			<strong>{l s='Click on one of the payment meanings logos below to proceed on a secure bank server.' mod='tggatos'}</strong>
		</p>
		{$tggatos_3tForm}
	</p>
{/if}
