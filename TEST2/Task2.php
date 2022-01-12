<?php

namespace Vendor\ModuleName\Model; // Removed ProductInformation

use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Event\Manager;

/**
 * Class ProductInformation
 */
class ProductInformation
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var Manager
     */
    private $eventManager;

    /**
     * @var array
     */
    protected $productSku = [];

    /**
     * ProductInformation constructor.
     * @param array $productSku
     * @param ProductRepository $productRepository
     * @param Manager $eventManager
     */
    public function __construct(
        array $productSku,
        ProductRepository $productRepository,
        Manager $eventManager
    ) {
        $this->productSku = $productSku;
        $this->eventManager = $eventManager;
        $this->productRepository = $productRepository;

        $this->eventManager->dispatch(
            'product_data_load',
            $productSku
        );
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getProductsData()
    {
        $productData = [];
        foreach ($this->productSku as $sku) {// Removed 's' in productSku as 'productSkus' is not declared.
            $product = $this->productRepository->get($sku);
            $productData[$product->getId()] = [
                'name' => $product->getName(),
                'price' => $product->getPrice()
            ];
        }

        return $productData;
    }
}