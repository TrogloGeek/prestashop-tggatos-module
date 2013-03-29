# TggAtos Module for Prestashop 1.5
## ATOS SIPS 600 payment gateway

###### This module helped you earning money ?
Please contribute back

[![Donate to help development and support of TggAtos] (https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)] (https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=UEN4JZ24FVDXU)

Suggested donation: 25 &euro; for basic user, 80 &euro; for professionals which often use the module.

Donations help me to find time to develop and maintain the module and to answer support requests.

### Release Candidate for production release 3.0.0

#### RELEASE-CANDIDATE feedback requests
- Check that silent response works well (not yet checked due the use of a local virtual machine as server)
- Production use feedbacks with:
	- details about used functionnalities
	- details about production environment configuration:
		- general public Web Hosting if relevant (exemple: "Mutualised Pro hosting from OVH company" or "Dedicated web server from OVH company", the last one is only relevant if you didn't change much of the configuration options that may affect module operation)
		- OS used with distribution and version
		- HTTP server, and multi process module if relevant, with version
		- PHP integration type and version
		- any HTTP and PHP configuration options alteration you may think relevant
		- PrestaShop version
		- PrestaShop functionnalities used that may affect module operation (multi-shop, splitted-orders...)
		- anything else you think relevant
- As I am not a native english speaker please report any bad wording

Feedbacks which are not issues can be submitted as comments to the following blog ticket:
http://prestashop.blog.capillotracteur.fr/2013/02/10/debut-de-la-phase-release-cadidate-pour-la-version-3-0-0-de-tggatos/

Sorry, it is a french blog, but they can be submitted in english as well.

#### Environment used to test current version
- Debian 6 x86_64 up-to-date (2013-02-09)
- apache2-mpm-prefork (I prefer mpm-worker for production server but this is a dedicated local virtual machine with Eclipse project folder mounted from Windows host machine)
- libapache2-mod-php5
- PHP5 with suhosin (Debian's default)

#### Prerequisites
- (hosting) PHP5 >= 5.3
- (hosting) safe_mode off
- (hosting) exec() function not disabled, and able to execute ATOS SIPS binaries
- (prestashop) version >= 1.5
- (you) good web hosting configuration technical level and good knowledge of security issues
- (you) basic undestanding of the way an ATOS SIPS gateway works and it's configuration

#### Installation (differences with a simple PrestaShop module)
- Replace `tggatos/bin/` content with binaries compatible with your system provided by your SIPS service provider
- Update `tggatos/param/parmcom.<sips_service_provider_codename>` with content of default parmcom provided by your SIPS service provider 
- `tggatos/bin/` folder, it's content and upper folders in file system needs execution right set to PHP user
- `tggatos/param/` folder and it's content must be writable by PHP user
- `tggatos/log/` folder must be writable by PHP user
- Install module
- Relocate `tggatos/param` somewhere safe from public access, outside HTTP document root, update module configuration in advanced panel.
- Relocate `tggatos/log` folder, update module configuration in basic panel.
- Check if access control policies match your environment and configuration, modify if needed.
- If you experience any trouble please set PrestaShop constant `_PS_MODE_DEV_` to TRUE, enable PHP error logging and set error reporting to -1 (all) while troubleshooting 
