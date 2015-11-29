{* ___________________________ SINGLE ______________________________________ *}

{if $TggAtos->canProcess(1, $cart, true)}
	<p class="payment_module tggatos tggatos-single">
		<a href="{$tggatos_modeSingleLink|escape:'html'}" title="{l s='Pay by credit card' mod='tggatos'}">
			<img src="{$module_template_dir|escape:'html'}views/img/bank_logo/{$TggAtos->get('BANK')}.gif" alt="{l s='Pay by credit card' mod='tggatos'}" width="86" height="49"/>
			{l s='Pay by credit card' mod='tggatos'}
		</a>
	</p>
{/if}

{* ___________________________ 2TIMES ______________________________________ *}

{if $TggAtos->canProcess(2, $cart, true)}
	<p class="payment_module tggatos tggatos-2t">
		<a href="{$tggatos_mode2tLink|escape:'html'}" title="{l s='Pay by credit card in two payments' mod='tggatos'}">
			<img src="{$module_template_dir|escape:'html'}views/img/bank_logo/{$TggAtos->get('BANK')}.gif" alt="{l s='Pay by credit card in two payments' mod='tggatos'}" width="86" height="49"/>
			{l s='Pay by credit card in two payments' mod='tggatos'}
		</a>
	</p>
{/if}

{* ___________________________ 3TIMES ______________________________________ *}

{if $TggAtos->canProcess(3, $cart, true)}
	<p class="payment_module tggatos-3t">
		<a href="{$tggatos_mode3tLink|escape:'html'}" title="{l s='Pay by credit card in three payments' mod='tggatos'}">
			<img src="{$module_template_dir|escape:'html'}views/img/bank_logo/{$TggAtos->get('BANK')}.gif" alt="{l s='Pay by credit card in three payments' mod='tggatos'}" width="86" height="49"/>
			{l s='Pay by credit card in three payments' mod='tggatos'}
		</a>
	</p>
{/if}
