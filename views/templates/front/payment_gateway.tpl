{**
 * 2007-2017 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2017 PrestaShop SA
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
<!doctype html>
<html lang="{$language.iso_code}">

<head>
    {block name='head'}
        {include file='_partials/head.tpl'}
    {/block}
</head>

<body id="{$page.page_name}" class="{$page.body_classes|classnames}">

{block name='hook_after_body_opening_tag'}
    {hook h='displayAfterBodyOpeningTag'}
{/block}

<header id="header">
    {block name='header'}
        {include file='checkout/_partials/header.tpl'}
    {/block}
</header>

{block name='notifications'}
    {include file='_partials/notifications.tpl'}
{/block}

<section id="wrapper">
    {hook h="displayWrapperTop"}
	<div class="container">

        {block name='content'}
			<section id="content">
				<div class="row">
					<div class="col-md-8">
                        {block name='cart_summary'}
                            {render file='checkout/checkout-process.tpl' ui=$checkout_process}
                        {/block}

						<h2>{l s='Payment' mod='tggatos'}</h2>

                        {print_r($context, true)}

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
							<span id="amount" class="price">{Tools::displayPrice($tggatos_totalAmount, $tggatos_paymentCurrency->id)}</span>
						</p>

                        {if $tggatos_form}
							<p style="margin-top:20px;">
								<strong>{l s='Click on one of the payment meanings logos below to proceed on a secure bank server.' mod='tggatos'}</strong>
							</p>
                            {$tggatos_form nofilter}
                        {else}
							<div class="error">
								<strong>{l s='Sorry, no more CB payments can be processed today, bank server should be available again at midnight.' mod='tggatos'}</strong>
							</div>
                        {/if}

						<p class="cart_navigation">
							<a href="{$link->getPageLink('order.php', true, null)|cat:'?step=3&cgv=1'}" class="button_large">{l s='Other payment methods' mod='tggatos'}</a>
						</p>

					</div>
					<div class="col-md-4">

                        {block name='cart_summary'}
                            {include file='checkout/_partials/cart-summary.tpl' cart = $cart}
                        {/block}

                        {hook h='displayReassurance'}
					</div>
				</div>
			</section>
        {/block}
	</div>
    {hook h="displayWrapperBottom"}
</section>

<footer id="footer">
    {block name='footer'}
        {include file='checkout/_partials/footer.tpl'}
    {/block}
</footer>

{block name='javascript_bottom'}
    {include file="_partials/javascript.tpl" javascript=$javascript.bottom}
{/block}

{block name='hook_before_body_closing_tag'}
    {hook h='displayBeforeBodyClosingTag'}
{/block}

</body>

</html>
