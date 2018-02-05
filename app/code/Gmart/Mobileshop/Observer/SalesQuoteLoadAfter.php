<?php
namespace Gmart\Mobileshop\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Catalog\Api\ProductRepositoryInterfaceFactory as ProductRepository;
use Magento\Catalog\Helper\ImageFactory as ProductImageHelper;
use Magento\Store\Model\StoreManagerInterface as StoreManager;
use Magento\Store\Model\App\Emulation as AppEmulation;
use Magento\Quote\Api\Data\CartItemExtensionFactory;

class SalesQuoteLoadAfter implements ObserverInterface
{
    /**
     * @var ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     *@var \Magento\Catalog\Helper\ImageFactory
     */
    protected $productImageHelper;

    /**
     *@var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     *@var \Magento\Store\Model\App\Emulation
     */
    protected $appEmulation;

    /**
     * @var CartItemExtensionFactory
     */
    protected $extensionFactory;

    /**
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param ProductRepository $productRepository
     * @param \Magento\Catalog\Helper\ImageFactory
     * @param \Magento\Store\Model\StoreManagerInterface
     * @param \Magento\Store\Model\App\Emulation
     * @param CartItemExtensionFactory $extensionFactory
     */
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        ProductRepository $productRepository,
        ProductImageHelper $productImageHelper,
        StoreManager $storeManager,
        AppEmulation $appEmulation,
        CartItemExtensionFactory $extensionFactory
    ) {
        $this->_objectManager = $objectManager;
        $this->productRepository = $productRepository;
        $this->productImageHelper = $productImageHelper;
        $this->storeManager = $storeManager;
        $this->appEmulation = $appEmulation;
        $this->extensionFactory = $extensionFactory;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $quote = $observer->getQuote();

        /**
         * Code to add the items attribute to extension_attributes
         */
        foreach ($quote->getAllItems() as $quoteItem) {
            $product = $this->productRepository->create()->getById($quoteItem->getProductId());

            $itemExtAttr = $quoteItem->getExtensionAttributes();
            if ($itemExtAttr === null) {
                $itemExtAttr = $this->extensionFactory->create();
            }
            $imageurl = $this->getImageUrl($product, 'product_thumbnail_image');
            $itemExtAttr->setImageUrl($imageurl);

            $options = [];
            $optionsItem = [];

            $productSku = $quoteItem->getSku();
            $productType = $quoteItem->getProductType();

            if(strcmp($productType,'configurable') == 0) {
                $productOptions = $product->getTypeInstance()->getConfigurableOptions($product);
                foreach ($productOptions as $optionId => $productOptionItemArr) {
                    foreach ($productOptionItemArr as $productOptionItem) {
                        if(strcmp($productSku,$productOptionItem['sku']) == 0) {

                            $optionsItem['option_id'] = $optionId;
                            $optionsItem['option_value'] = $productOptionItem['value_index'];
                            $optionsItem['option_label'] = $productOptionItem['option_title'];
                        }
                    }
                    $options[] = $optionsItem;
                }
            }


//            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
//            $attributeCode = 141;
//
//            $eavAttributeRepository = $objectManager->create('Magento\Eav\Model\AttributeRepository');
//
//            $attributes = $eavAttributeRepository->get(\Magento\Catalog\Api\Data\ProductAttributeInterface::ENTITY_TYPE_CODE,$attributeCode);
//            $options = $attributes->getSource()->getSpecificOptions([91,167],false);

//            var_dump($options);
//            exit;

            $itemExtAttr->setOptions($options);
            $quoteItem->setExtensionAttributes($itemExtAttr);

        }
        return;
    }


    /**
     * Helper function that provides full cache image url
     * @param \Magento\Catalog\Model\Product
     * @return string
     */
    protected function getImageUrl($product, string $imageType = '')
    {
        $storeId = $this->storeManager->getStore()->getId();

        $this->appEmulation->startEnvironmentEmulation($storeId, \Magento\Framework\App\Area::AREA_FRONTEND, true);
        $imageUrl = $imageUrl = $this->productImageHelper->create()->init($product, $imageType)->getUrl();

        $this->appEmulation->stopEnvironmentEmulation();

        return $imageUrl;
    }
}

?>