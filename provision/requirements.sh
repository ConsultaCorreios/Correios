#! /bin/bash

echo -e "\n"
echo -e "       "
echo -e "\n"
echo -e "   ______                     _"
echo -e "  / ____/___  _____________  (_)___  _____"
echo -e " / /   / __ \/ ___/ ___/ _ \/ / __ \/ ___/"
echo -e "/ /___/ /_/ / /  / /  /  __/ / /_/ (__  )"
echo -e "\____/\____/_/  /_/   \___/_/\____/____/"
echo -e "       __             __     _ __      "  
echo -e "  ____/ /___         / /__  (_) /_____"  
echo -e " / __  / __ \   __  / / _ \/ / __/ __ \\"   
echo -e "/ /_/ / /_/ /  / /_/ /  __/ / /_/ /_/ /"
echo -e "\__,_/\____/   \____/\___/_/\__/\____/"    
echo -e "       ______          __"   
echo -e "      / ____/__  _____/ /_____"
echo -e "     / /   / _ \/ ___/ __/ __ \\"               
echo -e "    / /___/  __/ /  / /_/ /_/ /"               
echo -e "    \____/\___/_/   \__/\____/"                
echo -e "       "
echo -e "       "
echo -e "...e tudo começou com um fork e um TOC..."
echo -e "       "
echo -e "       "

echo -e "\n--- Installing basic system requirements ---\n"
apt-get -y install vim curl build-essential python-software-properties git > /dev/null 2>&1
add-apt-repository ppa:ondrej/php5-5.6 > /dev/null 2>&1
apt-get -qq update

echo -e "\n--- Installing PHP ---\n"
apt-get -y install php5 php5-curl php5-gd php5-mcrypt php-apc > /dev/null 2>&1

echo -e "\n--- Installing Composer ---\n"
if [ ! -f "/usr/local/bin/composer" ]; then
	curl --silent https://getcomposer.org/installer | php > /dev/null 2>&1
	mv composer.phar /usr/local/bin/composer
else
	composer self-update
fi

echo -e "\n--- Installing PHPUnit ---\n"
composer global require 'phpunit/phpunit=5.1.*'
sudo chmod -R 777 /root
ln -fs /root/.composer/vendor/bin/phpunit /usr/local/bin/phpunit
