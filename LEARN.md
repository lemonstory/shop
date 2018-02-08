
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
    //设置为开发模式
    php bin/magento deploy:mode:set developer
    
    //生成静态文件
    php bin/magento setup:static-content:deploy -f
    
    //关闭module
    php bin/magento module:disable Shopial_Facebook
    
*设置线上环境*

    php环境设置
        http://devdocs.magento.com/guides/v2.2/install-gde/prereq/php-settings.html
    cd <magento root>
    php bin/magento deploy:mode:set production
    
*增加的模块*
    
    第三方登录
        https://github.com/mageplaza/magento-2-social-login
    
    增加用户头像
        https://github.com/euknyaz/magento2-customer-avatar-sm
        composer require euknyaz/magento2-customer-avatar-sm:dev-master
        
        bash-4.2$ php bin/magento indexer:reindex
        Design Config Grid index has been rebuilt successfully in 00:00:00
        PHP Fatal error:  Uncaught Error: Call to undefined method Magento\Customer\Model\Indexer\Source::addAttributeToSelect() in /data/wwwroot/shop.xiaoningmeng.net/vendor/magento/framework/Indexer/Handler/AttributeHandler.php:38
        Stack trace:
        #0 /data/wwwroot/shop.xiaoningmeng.net/vendor/magento/framework/Indexer/Action/Base.php(310): Magento\Framework\Indexer\Handler\AttributeHandler->prepareSql(Object(Magento\Customer\Model\Indexer\Source), 'e', Array)
        #1 /data/wwwroot/shop.xiaoningmeng.net/vendor/magento/framework/Indexer/Action/Entity.php(26): Magento\Framework\Indexer\Action\Base->createResultCollection()
        #2 /data/wwwroot/shop.xiaoningmeng.net/vendor/magento/framework/Indexer/Action/Base.php(179): Magento\Framework\Indexer\Action\Entity->prepareDataSource(Array)
        #3 /data/wwwroot/shop.xiaoningmeng.net/vendor/magento/framework/Indexer/Action/Base.php(189): Magento\Framework\Indexer\Action\Base->execute()
        #4 /data/wwwroot/shop.xiaoningmeng.net/vendor/magento/module-indexer/Model/Indexer.php(412): Magento\Framework\Indexer\Action\ in /data/wwwroot/shop.xiaoningmeng.net/vendor/magento/framework/Indexer/Handler/AttributeHandler.php on line 38

    
    

*设置LastName可为空*
    
    UPDATE `eav_attribute` SET `is_required`=0 WHERE `attribute_code`='lastname'
    https://magento.stackexchange.com/questions/176823/magento-2-how-to-make-lastname-optional-in-customer-registration-form
    
    
*TODO:*
    
    购物车列表返回规格信息，现在是个字符串，应该是对象合适
    
    {
        "messages": {
            "error": [
                {
                    "code": 500,
                    "message": "Fatal Error: 'Allowed memory size of 792723456 bytes exhausted (tried to allocate 262144 bytes)' in '/data/wwwroot/shop.xiaoningmeng.net/app/code/Gmart/Mobileshop/Model/ConfigurableProductOption.php' on line 26",
                    "trace": "Trace is not available."
                }
            ]
        }
    }