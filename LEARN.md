
*php-fpm*

    cd  /usr/local/opt/php70/sbin/
    ./php70-fpm start &

*magento*
    
    //命令列表
    php bin/magento list

    php bin/magento setup:upgrade
    php bin/magento setup:di:compile
    php bin/magento cache:clean
    php bin/magento cache:flush
    php bin/magento indexer:reindex
    
    php bin/magento app:config:dump
    
    //查看后台地址
    php bin/magento info:adminuri
    
    //当前的模环境模式
    php bin/magento deploy:mode:show
    
    //设置为生成环境
    php bin/magento deploy:mode:set production
    
*设置线上环境*

    php环境设置
        http://devdocs.magento.com/guides/v2.2/install-gde/prereq/php-settings.html
    cd <magento root>
    php bin/magento deploy:mode:set production