prestashop-tggatos-module
=========================

TggAtos Module for Prestashop 1.5, ATOS SIPS 600 payment gateway

#### TODO
- Take into account the "add logs as order message" option.
- Add a nagging message as module warning when `param/` and `log/` folders are at their default locations. I know it is annoying but many of installations I was requested to repair had potential security leaks due to lack of interest for the safety of previous intervenant(s).
- Improve security by completely forbidding HTTP requests outside of `autodispatch/` folders with exception for images.
- Make a Wiki documentation about installation, configuration and usage of the module. Dual ODT/PDF formats requieres too much time to maintain and does not allow easy participation to it's redaction.
- Add a similar fonctionnality to the 2.1 branch params.xml allowing to set static ATOS SIPS request call parameters without extending the module.
- Develop a new parser for params.xml file allowing more context sensitive switches (allowing for exemple changing `payment_means` parameter depending on the payment amount expressed in default currency).
