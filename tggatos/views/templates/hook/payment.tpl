{* ___________________________ SINGLE ______________________________________ *}

{if $TggAtos->canProcess(1, $cart, true)}
	<p class="payment_module tggatos tggatos-single">
		<img src="{$module_template_dir|escape:'html'}images/bank_logo/{$TggAtos->get('BANK')}.gif" alt="{l s='Pay by credit card' mod='tggatos'}" width="86" height="49"/>
		<a href="{$tggatos_modeSingleLink|escape:'html'}" title="{l s='Pay by credit card' mod='tggatos'}">
			{l s='Pay by credit card' mod='tggatos'}
		</a>
	</p>
{/if}

{* ___________________________ 2TIMES ______________________________________ *}

{if $TggAtos->canProcess(2, $cart, true)}
	<p class="payment_module tggatos tggatos-2t">
		<img src="{$module_template_dir|escape:'html'}images/bank_logo/{$TggAtos->get('BANK')}.gif" alt="{l s='Pay by credit card in two payments' mod='tggatos'}" width="86" height="49"/>
		<a href="{$tggatos_mode2tLink|escape:'html'}" title="{l s='Pay by credit card in two payments' mod='tggatos'}">
			{l s='Pay by credit card in two payments' mod='tggatos'}
		</a>
	</p>
{/if}

{* ___________________________ 3TIMES ______________________________________ *}

{if $TggAtos->canProcess(3, $cart, true)}
	<p class="payment_module tggatos-3t">
		<img src="{$module_template_dir|escape:'html'}images/bank_logo/{$TggAtos->get('BANK')}.gif" alt="{l s='Pay by credit card in three payments' mod='tggatos'}" width="86" height="49"/>
		<a href="{$tggatos_mode3tLink|escape:'html'}" title="{l s='Pay by credit card in three payments' mod='tggatos'}">
			{l s='Pay by credit card in three payments' mod='tggatos'}
		</a>
	</p>
{/if}
