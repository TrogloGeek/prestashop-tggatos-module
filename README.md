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

#### Release cycle
I do not have enough feedback to manage a real release cycle, and I don't use it myself, I do run alpha tests on it but it is only a set of basic tests to try to check if I introduced side effects with last changes, never trust my checks, please run your owns.
so it's mainly based on the lack of error reporting for a given release candidate.
- Release candidates are symbolized by branches with a name starting with `RC_` followed by the version number. There are no build number management because commit history does the job as well.
- When I feel enough time have passed without error report, I set a tag with version number to the tip of the RC branch, symbolizing a production release. But please do not trust it as a real production release, it's just an hint to let you know my opinion about it, you really should do a staging cycle with every version to check if I didn't introduced new bugs/incompatibilities.

#### I have you module running well in production, but there is a new release, should I blindly update?
The hell no! This is a payment gateway, you should be really careful about it.
Read the commit history between your release and the new one. 
- Did I fix a bug which can affect your use of the module, or a security breach?
- Did I introduced new features you need/want?
If one answer is yes, you should consider updating, but you have to run you own checks to the new version prior to use it in production.
You also have to check wordings and manage translations before putting any version in production, remember that I'm a developper, not a commercial expert, don't expect my wordings to be well written, there are more placeholder than real wordings, your clients might be frightened by any oddity on the payment process. 

#### I use your module and I feel there have to be implied warranties with the use of it.
I don't feel that way.
This module is provided as is, I really try to provide you with a reliable high quality gateway, but hey, I'm human!
I'm mainly working alone on this project, with some help from others in the form of feedbacks and push requests once and then, but it's not enough for the module to be fully trusted.
I initiated this project because I have good experience with ATOS/SIPS gateway and I didn't feel any existing Prestashop ATOS/SIPS module to be reliable enough, but my good will on this project is not a reliability proof.

#### What if I want a gateway offering more warranties?
I don't know, sorry, I created this one because I did not trust existing others, so I can't help you finding a more reliable module.

[by TrogloGeek](//plus.google.com/117473197520914751616/about?rel=author")
[Project's blog](http://prestashop.blog.capillotracteur.fr/category/modules/tgg-atos-sips-prestashop-module-gratuit/)
