
*php-fpm*

    cd  /usr/local/opt/php70/sbin/
    ./php70-fpm start &

*magento*

    php bin/magento setup:upgrade
    php bin/magento setup:di:compile
    php bin/magento cache:flush
    
    php bin/magento app:config:dump