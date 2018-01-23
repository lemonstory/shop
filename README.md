返回键值说明：
visibility = 4 ： 搜索,及分类均可见
status = 1 : 正常(Enabled)
http://devdocs.magento.com/swagger/#/

#####客户

    创建客户访问令牌(auth token)
        POST /V1/integration/customer/token
        http://dev.magento.com/index.php/rest/V1/integration/customer/token
        
        测试账号:
        {
            "username": "gaoyong@xiaoningmeng.net",
            "password": "xnm2015,"
        }

    获取客户信息 - 没有头像
        GET /V1/customers/me
        http://dev.magento.com/rest/V1/customers/me
    
        Header:
            Authorization Bearer {token}
            Content-Type application/json
    
#####分类
    
    获取所有分类[不推荐使用]
        GET /V1/categories/{categoryId}
        http://dev.magento.com/index.php/rest/all/V1/categories
        
    获取分类下面的商品
    
        GET /V1/products
        
    根据名称获取分类的信息
        GET V1/categories/list{searchCriteria}
        http://dev.magento.com/index.php/rest/V1/categories/list?searchCriteria[filterGroups][0][filters][0][field]=name& searchCriteria[filterGroups][0][filters][0][value]=root-1& searchCriteria[filterGroups][0][filters][0][conditionType]=eq
    
    根据id获取分类信息
        GET V1/categories/list{searchCriteria}
        http://dev.magento.com/index.php/rest/V1/categories/list?searchCriteria[filterGroups][0][filters][0][field]=entity_id& searchCriteria[filterGroups][0][filters][0][value]=5& searchCriteria[filterGroups][0][filters][0][conditionType]=eq
    
    
    根据id获取分类信息
        GET /V1/categories/{categoryId}
        http://dev.magento.com/index.php/rest/V1/categories/5
        
        
#####商店
    
    获取所有的商店
        `GET /V1/store/storeViews
         http://dev.magento.com/index.php/rest/V1/store/storeViews`
        
    
    获取商店信息
        备注:增加返回rootCategoryId
        GET /V1/store/storeConfigs/{storeCodes}
        http://dev.magento.com/index.php/rest/V1/store/storeConfigs?storeCodes[]=default
        
    
    获取商店下面的分类信息
        GET /V1/categories
        http://dev.magento.com/index.php/rest/V1/categories?rootCategoryId=5
        
        product_count: 所有产品信息包含(Visibility = Not Visible Individually)

#####商品



    获取推荐商品
        GET /V1/products
        http://dev.magento.com/index.php/rest/V1/products?searchCriteria[filterGroups][0][filters][0][field]=is_featured&searchCriteria[filterGroups][0][filters][0][value]=1&searchCriteria[filterGroups][0][filters][0][conditionType]=eq&searchCriteria[sortOrders][0][field]=updated_at&searchCriteria[sortOrders][0][direction]=DESC&searchCriteria[pageSize]=10&searchCriteria[currentPage]=1
    
    获取最新商品
        GET /V1/products
        http://dev.magento.com/index.php/rest/V1/products?searchCriteria[filterGroups][0][filters][0][field]=news_from_date&searchCriteria[filterGroups][0][filters][0][value]=2018-01-20 00:00:00&searchCriteria[filterGroups][0][filters][0][conditionType]=lteq&searchCriteria[filterGroups][1][filters][0][field]=news_to_date&searchCriteria[filterGroups][1][filters][0][value]=2018-01-20 00:00:00&searchCriteria[filterGroups][1][filters][0][conditionType]=gteq&searchCriteria[sortOrders][0][field]=updated_at&searchCriteria[sortOrders][0][direction]=DESC&searchCriteria[pageSize]=10&searchCriteria[currentPage]=1
    
    根据Id获取商品
        GET /V1/products
        http://dev.magento.com/index.php/rest/V1/products?searchCriteria[filterGroups][0][filters][0][field]=entity_id&searchCriteria[filterGroups][0][filters][0][value]=2&searchCriteria[filterGroups][0][filters][0][conditionType]=eq
    
    根据SKU获取商品
       GET /V1/products/:sku
       http://dev.magento.com/index.php/rest/V1/products/女孩衣服
   

#####商品评论
     无
     
#####购物车
     获取购物车信息
         GET /V1/carts/mine
         http://dev.magento.com/index.php/rest/V1/carts/mine
         
         Authorization Bearer {token}
         Content-Type application/json
         
     添加商品至购物车
        



