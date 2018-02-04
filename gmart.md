**环境相关**

    Your domain:                  shop.xiaoningmeng.net
    Virtualhost conf:             /usr/local/nginx/conf/vhost/shop.xiaoningmeng.net.conf
    Directory of:                 /data/wwwroot/shop.xiaoningmeng.net
    Let's Encrypt SSL Certificate:/etc/letsencrypt/live/shop.xiaoningmeng.net/fullchain.pem
    SSL Private Key:              /etc/letsencrypt/live/shop.xiaoningmeng.net/privkey.pem

**存在的问题**

    地址接口中的region信息
    customer auth token 有效期
    
**faq**

    Magento: Difference between order states and statuses
    http://ka.lpe.sh/2012/04/21/magento-order-state-vs-status/

**资料**

    接口文档：http://devdocs.magento.com/swagger/#/
    返回状态码：http://devdocs.magento.com/guides/v2.2/get-started/gs-web-api-response.html
    

**返回键值说明**：

    visibility = 4 ： 搜索,及分类均可见
    status = 1 : 正常(Enabled)
    
    评论状态码
    
       status_id = 1: 审核通过 (Approved)
       status_id = 2: 待审核 (Pending)
       status_id = 3: 未审核通过 (Not Approved)
       
       
**微信登录**

    文档：
        http://yj1438.github.io/2017/03/07/mini_program.html
        https://mp.weixin.qq.com/debug/wxadoc/dev/api/api-login.html
        https://mp.weixin.qq.com/debug/wxadoc/dev/api/open.html
    
    获取用户信息
        GET /rest/V1/wxlogin/{code}/{encryptedData}/{iv}
        https://shop.xiaoningmeng.net/rest/V1/wxlogin/aaabbbccc/aaaa/bbb
           
**客户**

    创建客户访问令牌(auth token)
        integrationCustomerTokenServiceV1
        POST /V1/integration/customer/token
        https://shop.xiaoningmeng.net/index.php/rest/V1/integration/customer/token
        
        测试账号:
        {
            "username": "gaoyong@xiaoningmeng.net",
            "password": "xnm2015,"
        }

    获取客户信息 - 没有头像
        customerCustomerRepositoryV1
        GET /V1/customers/me
        https://shop.xiaoningmeng.net/rest/V1/customers/me
    
        Header:
            Authorization Bearer {token}
            Content-Type application/json
    
    客户信息修改
        customerAccountManagementV1
    
**分类**
    
    获取所有分类[不推荐使用]
        GET /all/V1/categories
        https://shop.xiaoningmeng.net/index.php/rest/all/V1/categories
        
    根据名称查询分类类别【TODO:后面应该携带商店信息】
        catalogCategoryListV1
        GET  /V1/categories
        https://shop.xiaoningmeng.net/index.php/rest/V1/categories/list?searchCriteria[filterGroups][0][filters][0][field]=name&searchCriteria[filterGroups][0][filters][0][value]=%肉%&searchCriteria[filterGroups][0][filters][0][conditionType]=like&searchCriteria[sortOrders][0][field]=updated_at&searchCriteria[sortOrders][0][direction]=DESC&searchCriteria[pageSize]=20&searchCriteria[currentPage]=1
        
        
    获取分类下面的商品
        GET /V1/products
        https://shop.xiaoningmeng.net/index.php/rest/V1/products?searchCriteria[filterGroups][0][filters][0][field]=category_id&searchCriteria[filterGroups][0][filters][0][value]=52&searchCriteria[filterGroups][0][filters][0][conditionType]=in&searchCriteria[filterGroups][1][filters][0][value]=4&searchCriteria[filterGroups][1][filters][0][conditionType]=eq&searchCriteria[filterGroups][1][filters][0][field]=visibility
    
    获取分类下面的商品(按价格升序排列)
    //&searchCriteria[sortOrders][0][field]=updated_at&searchCriteria[sortOrders][0][direction]=DESC
    
    
    获取分类下面的商品(按价格降序排列)
        
        
    根据名称获取分类的信息
        catalogCategoryListV1
        GET V1/categories/list{searchCriteria}
        https://shop.xiaoningmeng.net/index.php/rest/V1/categories/list?searchCriteria[filterGroups][0][filters][0][field]=name& searchCriteria[filterGroups][0][filters][0][value]=root-1& searchCriteria[filterGroups][0][filters][0][conditionType]=eq
    
    根据id获取分类信息
        catalogCategoryListV1
        GET V1/categories/list{searchCriteria}
        https://shop.xiaoningmeng.net/index.php/rest/V1/categories/list?searchCriteria[filterGroups][0][filters][0][field]=entity_id& searchCriteria[filterGroups][0][filters][0][value]=5& searchCriteria[filterGroups][0][filters][0][conditionType]=eq
    
    
    根据id获取分类信息
        catalogCategoryRepositoryV1
        GET /V1/categories/{categoryId}
        https://shop.xiaoningmeng.net/index.php/rest/V1/categories/5
        
        
**商店**
    
    获取所有的商店
        storeStoreRepositoryV1
        GET /V1/store/storeViews
        https://shop.xiaoningmeng.net/index.php/rest/V1/store/storeViews
        
    
    获取商店信息
        storeStoreConfigManagerV1
        备注:增加返回rootCategoryId
        GET /V1/store/storeConfigs/{storeCodes}
        https://shop.xiaoningmeng.net/index.php/rest/V1/store/storeConfigs?storeCodes[]=default
        
    
    获取商店下面的分类信息
        catalogCategoryRepositoryV1
        GET /V1/categories
        https://shop.xiaoningmeng.net/index.php/rest/V1/categories?rootCategoryId=5
        
        product_count: 所有产品信息包含(Visibility = Not Visible Individually)

**商品**


    获取推荐商品
        catalogProductRepositoryV1
        GET /V1/products
        https://shop.xiaoningmeng.net/index.php/rest/V1/products?searchCriteria[filterGroups][0][filters][0][field]=is_featured&searchCriteria[filterGroups][0][filters][0][value]=1&searchCriteria[filterGroups][0][filters][0][conditionType]=eq&searchCriteria[filterGroups][1][filters][0][field]=visibility&searchCriteria[filterGroups][1][filters][0][value]=4&searchCriteria[filterGroups][1][filters][0][conditionType]=eq&searchCriteria[sortOrders][0][field]=updated_at&searchCriteria[sortOrders][0][direction]=DESC&searchCriteria[pageSize]=10&searchCriteria[currentPage]=1
    
    获取最新商品
        catalogProductRepositoryV1
        GET /V1/products
        https://shop.xiaoningmeng.net/index.php/rest/V1/products?searchCriteria[filterGroups][0][filters][0][field]=news_from_date&searchCriteria[filterGroups][0][filters][0][value]=2018-01-20 00:00:00&searchCriteria[filterGroups][0][filters][0][conditionType]=lteq&searchCriteria[filterGroups][1][filters][0][field]=news_to_date&searchCriteria[filterGroups][1][filters][0][value]=2018-01-20 00:00:00&searchCriteria[filterGroups][1][filters][0][conditionType]=gteq&searchCriteria[filterGroups][2][filters][0][value]=4&searchCriteria[filterGroups][2][filters][0][conditionType]=eq&searchCriteria[filterGroups][2][filters][0][field]=visibility&searchCriteria[sortOrders][0][field]=updated_at&searchCriteria[sortOrders][0][direction]=DESC&searchCriteria[pageSize]=10&searchCriteria[currentPage]=1
    
    根据Id获取商品
        catalogProductRepositoryV1
        GET /V1/products
        https://shop.xiaoningmeng.net/index.php/rest/V1/products?searchCriteria[filterGroups][0][filters][0][field]=entity_id&searchCriteria[filterGroups][0][filters][0][value]=2&searchCriteria[filterGroups][0][filters][0][conditionType]=eq
    
    根据SKU获取商品
       catalogProductRepositoryV1
       GET /V1/products/:sku
       https://shop.xiaoningmeng.net/index.php/rest/V1/products/WP13
       
       
    获取configurable商品子产品信息
        configurableProductLinkManagementV1
        GET /V1/configurable-products/{sku}/children
        https://shop.xiaoningmeng.net/index.php/rest/V1/configurable-products/XX001/children
        
        Authorization Bearer {customer token}
        Content-Type application/json
        
    商品搜索
        catalogProductRepositoryV1
        GET /V1/products
        https://shop.xiaoningmeng.net/index.php/rest/V1/products?searchCriteria[filterGroups][0][filters][0][field]=name&searchCriteria[filterGroups][0][filters][0][value]=%豆干%&searchCriteria[filterGroups][0][filters][0][conditionType]=like&searchCriteria[sortOrders][0][field]=updated_at&searchCriteria[sortOrders][0][direction]=DESC&searchCriteria[pageSize]=20&searchCriteria[currentPage]=1
        
        备注：搜索关键字在Query String中的searchCriteria[filterGroups][0][filters][0][value]字段中.
        
        
       
**商品属性信息**

    根据属性id获取属性信息
        catalogProductAttributeOptionManagementV1
        GET /V1/products/attributes/{attributeCode}/options
        https://shop.xiaoningmeng.net/index.php/rest/V1/products/attributes/141/options
        
    商品sku返回的详情详情中的custom_attributes根据attribute_code获取default_frontend_label
        catalogProductAttributeOptionManagementV1
        GET /V1/products/attributes/options
        https://shop.xiaoningmeng.net/index.php/rest/V1/products/attributes?searchCriteria[filterGroups][0][filters][0][field]=attribute_code&searchCriteria[filterGroups][0][filters][0][value]=%product_options_%&searchCriteria[filterGroups][0][filters][0][conditionType]=like
        
        //备注
        

**商品评论**
     
     根据商品id获取评论
         GET /V1/gmart/products/id/{productId}/reviews/{curPage}/{pageSize}
         https://
         
         shop.xiaoningmeng.net/index.php/rest/V1/gmart/products/id/6/reviews/1/4
         返回值：
             [
                  {
                      "review_id": "348",                                //评论id
                      "created_at": "2018-01-27 13:29:00",               //评论创建时间
                      "entity_id": "1",                                  //
                      "entity_pk_value": "6",                            //实体id(商品id)
                      "status_id": "1",                                  //评论状态(见 返回键值说明->评论状态码 )
                      "detail_id": "348",                                //评论id
                      "title": "看起来还不错",                             //评论标题
                      "detail": "看起来还不错，看起来还不错，看起来还不错",      //评论内容
                      "nickname": "帅帅",                                 //客户姓名
                      "customer_id": null,                               //客户id (null 表示是游客)
                      "entity_code": "product",                          //实体类型：商品
                      "rating": "4"                                      //评级：4星
                  }
                 ...
             ]
     
     根据商品sku获取评论
         GET /V1/gmart/products/{sku}/reviews/{curPage}/{pageSize}
         https://shop.xiaoningmeng.net/index.php/rest/V1/gmart/products/24-MB02/reviews/1/4
         返回值：
            同上
     
     
     发布评论
         POST /V1/gmart/review/product/post/id/{productId}
         https://shop.xiaoningmeng.net/index.php/rest/V1/gmart/review/product/post/id/6
         
         {
             "ratings":1,           //评级：1：1颗星...5:5颗星
             "customerId":0,        //客户Id 游客customerId=0
             "nickname": "姓名555",  //客户姓名
             "title": "简介啊啊啊",   //评论标题
             "detail": "评论内容哈哈"  //评论内容
         }
         
         Authorization Bearer {token}
         Content-Type application/json
     
     
**购物车**
    
    文档
    https://www.ipragmatech.com/magento-mobile-app-shopping-cart/

    获取购物车信息
        quoteCartManagementV1
        GET /V1/carts/mine
        https://shop.xiaoningmeng.net/index.php/rest/V1/carts/mine
         
        Authorization Bearer {token}
        Content-Type application/json
        
    查看购物车中的商品
       quoteCartItemRepositoryV1
       GET /V1/carts/mine/items
       https://shop.xiaoningmeng.net/index.php/rest/V1/carts/mine/items
       
       Authorization Bearer {token}
       Content-Type application/json
        
    添加商品至购物车
       quoteCartItemRepositoryV1
       POST /V1/carts/mine/items
        
       POST参数
       {
           "cartItem": {
               "sku": "111法师法师法师",     //商品sku
               "qty": 1,                   //商品数量
               "name": "111法师法师法师",    //商品名称
               "product_type": "simple",   //商品
               "quote_id": "3"             //购物车id (获取购物车信息 id)
           }
       }
       
       //示例
       {
          "cartItem":{ 
            "sku": "24-WB02",
             "qty": 2,
             "name": "Compete Track Tote",
             "product_type": "simple",
             "quote_id": "13"
           }
       }
       
       //参考：https://magento.stackexchange.com/questions/174997/magento-2-add-color-option-to-cart-rest-api
       //完整的参数列表
       {
         "cartItem": {
           "sku": "string",
           "qty": 0,
           "name": "string",
           "price": 0,
           "product_type": "string",
           "quote_id": "string",
           "product_option": {
           "extension_attributes": {
              "configurable_item_options": [
                {
                 "option_id": "string",
                 "option_value": 0,
                 "extension_attributes": {}
               }
             ]
           }
         },
         "extension_attributes": {}
         }
       }
        
    修改购物车某一种商品数量(覆盖)
       quoteCartItemRepositoryV1
       POST /V1/carts/mine/items
        
       POST参数
       {
           "cartItem": {
               "item_id": "10",            //商品在购物车中的id【重要】
               "qty": 1,                   //商品数量 (覆盖旧值)
               "name": "111法师法师法师",    //商品名称
               "product_type": "simple",   //商品
               "quote_id": "3"             //购物车id (获取购物车信息 id)
           }
       }
        
    删除购物车中的商品
        quoteCartItemRepositoryV1
        DELETE /V1/carts/mine/items/{itemId}
        https://shop.xiaoningmeng.net/index.php/rest/V1/carts/mine/items/10
        
        Path参数
            itemId：购物车中商品id
            
    清空购物车
        
       
**收获地址**
    
    文档
    https://magento.stackexchange.com/questions/197887/magento-2-rest-api-update-single-customer-address
            
    获取客户地址信息(同获取用户信息接口)
        customerCustomerRepositoryV1
        GET /V1/customers/me
        https://shop.xiaoningmeng.net/rest/V1/customers/me
    
        Header:
            Authorization Bearer {token}
            Content-Type application/json
            
        备注：
            default_billing: true   //默认账单地址
            default_shipping: true  //默认物流地址
    
    获取默认的物流地址【不推荐使用】
        customerAccountManagementV1
        GET /V1/customers/me/shippingAddress
        https://shop.xiaoningmeng.net/index.php/rest/V1/customers/me/shippingAddress
        
        {
            "id": 2,                    //地址id
            "customer_id": 2,           //客户id
            "region": {                 //区域信息
                "region_code": null,
                "region": null,
                "region_id": 0
            },
            "region_id": 0,             //区域id
            "country_id": "CN",         //国家
            "street": [
                "北京的地址1",            //街道信息1
                "北京的地址2"             //街道信息2
            ],
            "telephone": "18600001234", //手机号
            "postcode": "710065",       //邮政编码
            "city": "北京市",            //城市
            "firstname": "黄",          //名字
            "lastname": "元",           //姓氏
            "default_shipping": true    //是否是默认物流地址
        }
        
    添加/添加并设置为默认地址/修改/删除/物流地址:
        customerCustomerRepositoryV1
        PUT /V1/customers/me
        https://shop.xiaoningmeng.net/rest/V1/customers/me
        
        $Body 值
        {
            "customer": {
                "id": 2,
                "group_id": 1,
                "default_billing": "1",
                "default_shipping": "2",
                "created_at": "2018-01-23 13:36:44",
                "updated_at": "2018-01-24 07:33:16",
                "created_in": "Default Store View",
                "email": "huangyuan@xiaoningmeng.net",
                "firstname": "黄",
                "lastname": "元",
                "store_id": 1,
                "website_id": 1,
                "addresses": [
                    {
                        "id": 2,
                        "customer_id": 2,
                        "region": {
                            "region_code": null,
                            "region": null,
                            "region_id": 0
                        },
                        "region_id": 0,
                        "country_id": "CN",
                        "street": [
                            "北京的地址1",
                            "北京的地址2"
                        ],
                        "telephone": "18600001234",
                        "postcode": "710065",
                        "city": "北京市",
                        "firstname": "黄",
                        "lastname": "元",
                        "default_shipping": true
                    },
                    {
                        "customer_id": 2,
                        "region": {
                            "region_code": null,
                            "region": null,
                            "region_id": 0
                        },
                        "region_id": 0,
                        "country_id": "CN",
                        "street": [
                            "北京的地址1111",
                            "北京的地址22222"
                        ],
                        "telephone": "18600001234",
                        "postcode": "710065",
                        "city": "北京市",
                        "firstname": "黄",
                        "lastname": "元",
                        "default_shipping": false
                    }
                ],
                "disable_auto_group_change": 0
            }
        }
        
        备注：
            添加,修改,删除 物流地址实际上调用的是修改用户信息的接口.
            Tips:
                请求类型为PUT
                发送请求是Body部分的根节点为：customer(获取用户信息的返回值没有该节点)
                添加地址时：是在addresses数组中增加一项,后发起put请求提交
                添加地址且将该地址设置为默认地址时：被添加项的default_shipping赋值为true即可
                修改地址时：修改addresses的地址项,后发起put请求提交
                删除地址时：删除addresses的地址项,后发起put请求提交
                
                
**订单**
        
        获取客户订单列表
            salesOrderRepositoryV1
            GET /V1/orders
            https://shop.xiaoningmeng.net/index.php/rest/V1/orders?searchCriteria[filterGroups][0][filters][0][field]=customer_id&searchCriteria[filterGroups][0][filters][0][value]=2&searchCriteria[filterGroups][0][filters][0][conditionType]=eq                                                      
             
            Authorization Bearer {admin token}
            Content-Type application/json
            
        客户订单按条件(全部\待付款\待发货\已发货\待评价)筛选
        
            
        
               
   


