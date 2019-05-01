<?php

/**
 * Copyright © 2016 Magestore. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Angel\Promotion\Ui\DataProvider\Product\Form\Modifier;

use Angel\Promotion\Model\ResourceModel\Free\CollectionFactory;
use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Framework\Stdlib\ArrayManager;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Catalog\Model\ProductOptions\ConfigInterface;
use Magento\Catalog\Model\Config\Source\Product\Options\Price as ProductOptionsPrice;
use Magento\Framework\UrlInterface;
use Magento\Ui\Component\Container;
use Magento\Ui\Component\DynamicRows;
use Magento\Ui\Component\Form\Fieldset;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Element\Input;
use Magento\Ui\Component\Form\Element\Select;
use Magento\Ui\Component\Form\Element\ActionDelete;
use Magento\Ui\Component\Form\Element\DataType\Text;
use Magento\Ui\Component\Form\Element\DataType\Number;

class Promotion extends AbstractModifier
{
    const GROUP_RAFFLE_NAME = 'raffle_promotion';
    const GROUP_RAFFLE_SCOPE = 'data.product';
    const GROUP_RAFFLE_PREVIOUS_NAME = 'general';
    const GROUP_RAFFLE_DEFAULT_SORT_ORDER = 2;

    const GRID_FREE_NAME = 'frees';
    const GRID_TYPE_SELECT_NAME = 'frees';
    /**#@+
     * Field values
     */
    const FIELD_ENABLE = 'affect_product_custom_options';
    const FIELD_LABEL_NAME = 'name';
    const FIELD_IS_REQUIRE_NAME = 'is_require';
    const FIELD_SORT_ORDER_NAME = 'sort_order';
    const FIELD_FREE_ID_NAME = 'free_id';
    const FIELD_Y_NAME = 'free';
    const FIELD_X_NAME = 'buy';
    const FIELD_IS_DELETE = 'is_delete';
    const FIELD_IS_USE_DEFAULT = 'is_use_default';
    const SERIAL_FIELD = 'raffle_serial';

    /**
     * @var \Magento\Catalog\Model\Config\Source\Product\Options\Price
     * @since 101.0.0
     */
    protected $productOptionsPrice;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     * @since 101.0.0
     */
    protected $storeManager;

    /**
     * @var LocatorInterface
     */
    protected $locator;

    /**
     * @var ArrayManager
     */
    protected $arrayManager;

    protected $meta = [];
    private $freeCollectionFactory;

    public function __construct(
        LocatorInterface $locator,
        ArrayManager $arrayManager,
        ProductOptionsPrice $productOptionsPrice,
        StoreManagerInterface $storeManager,
        CollectionFactory $freeCollectionFactory

    ){
        $this->locator = $locator;
        $this->arrayManager = $arrayManager;
        $this->productOptionsPrice = $productOptionsPrice;
        $this->storeManager = $storeManager;
        $this->freeCollectionFactory = $freeCollectionFactory;
    }

    /**
     * {@inheritdoc}
     * @since 101.0.0
     */
    public function modifyData(array $data)
    {
        $product = $this->locator->getProduct();

        if (!in_array($product->getTypeId(), ['qoh', 'fifty', 'raffle', 'fd'])){
            return $data;
        }
        $collection = $this->freeCollectionFactory->create()->addFieldToFilter('product_id', $product->getId());

        $data =  array_replace_recursive(
            $data,
            [
                $this->locator->getProduct()->getId() => [
                    static::DATA_SOURCE_DEFAULT => [
                        static::GRID_FREE_NAME => $collection->getData(),
                    ]
                ]
            ]
        );
        return $data;
    }

    /**
     * {@inheritdoc}
     * @since 101.0.0
     */
    public function modifyMeta(array $meta)
    {
        /** @var Product $product */
        $product = $this->locator->getProduct();
        if (!in_array($product->getTypeId(), ['qoh', 'fifty', 'raffle', 'fd'])){
            return $meta;
        }
        $this->meta = $meta;
        $this->createCustomOptionsPanel();
        return $this->meta;
    }

    /**
     * Create "Customizable Options" panel
     *
     * @return $this
     * @since 101.0.0
     */
    protected function createCustomOptionsPanel()
    {
        $this->meta = array_replace_recursive(
            $this->meta,
            [
                static::GROUP_RAFFLE_NAME => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'label' => __('Raffle Promotion'),
                                'componentType' => Fieldset::NAME,
                                'dataScope' => static::GROUP_RAFFLE_SCOPE,
                                'collapsible' => true,
                                'sortOrder' => $this->getNextGroupSortOrder(
                                    $this->meta,
                                    static::GROUP_RAFFLE_PREVIOUS_NAME,
                                    static::GROUP_RAFFLE_DEFAULT_SORT_ORDER
                                ),
                            ],
                        ],
                    ],
                    'children' => [
                        static::GRID_TYPE_SELECT_NAME => $this->getSelectFreeGrid(300)
                    ]
                ]
            ]
        );
        return $this;
    }

    /**
     * Get config for grid for "select" types
     *
     * @param int $sortOrder
     * @return array
     * @since 101.0.0
     */
    protected function getSelectFreeGrid($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'addButtonLabel' => __('Add new Free Rule'),
                        'componentType' => DynamicRows::NAME,
                        'component' => 'Magento_Ui/js/dynamic-rows/dynamic-rows',
                        'additionalClasses' => 'admin__field-wide',
                        'deleteProperty' => static::FIELD_IS_DELETE,
                        'deleteValue' => '1',
                        'renderDefaultRecord' => false,
                        'sortOrder' => $sortOrder,
                    ],
                ],
            ],
            'children' => [
                'record' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'componentType' => Container::NAME,
                                'component' => 'Magento_Ui/js/dynamic-rows/record',
                                'positionProvider' => static::FIELD_SORT_ORDER_NAME,
                                'isTemplate' => true,
                                'is_collection' => true,
                            ],
                        ],
                    ],
                    'children' => [
                        static::FIELD_X_NAME => $this->getXFieldConfig(20),
                        static::FIELD_Y_NAME => $this->getYFieldConfig(40),
                        static::FIELD_SORT_ORDER_NAME => $this->getPositionFieldConfig(70),
                        static::FIELD_FREE_ID_NAME => $this->getFreeIdFieldConfig(80),
                        static::FIELD_IS_DELETE => $this->getIsDeleteFieldConfig(60)
                    ]
                ]
            ]
        ];
    }

    /**
     * Get config for hidden field used for removing rows
     *
     * @param int $sortOrder
     * @return array
     * @since 101.0.0
     */
    protected function getIsDeleteFieldConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'componentType' => ActionDelete::NAME,
                        'fit' => true,
                        'sortOrder' => $sortOrder
                    ],
                ],
            ],
        ];
    }

    /**
     * Get config for "SKU" field
     *
     * @param int $sortOrder
     * @return array
     * @since 101.0.0
     */
    protected function getYFieldConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Get Y'),
                        'componentType' => Field::NAME,
                        'formElement' => Input::NAME,
                        'dataScope' => static::FIELD_Y_NAME,
                        'dataType' => Number::NAME,
                        'sortOrder' => $sortOrder,
                        'validation' => [
                            'required-entry' => true,
                            'validate-number' => true,
                            'validate-digits' => true,
                            'validate-greater-than-zero' => true,
                            'less-than-equals-to' => 10000
                        ]
                    ],
                ],
            ],
        ];
    }
    /**
     * Get config for "SKU" field
     *
     * @param int $sortOrder
     * @return array
     * @since 101.0.0
     */
    protected function getXFieldConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Buy X'),
                        'componentType' => Field::NAME,
                        'formElement' => Input::NAME,
                        'dataScope' => static::FIELD_X_NAME,
                        'dataType' => Number::NAME,
                        'sortOrder' => $sortOrder,
                        'validation' => [
                            'required-entry' => true,
                            'validate-number' => true,
                            'validate-digits' => true,
                            'validate-greater-than-zero' => true,
                            'less-than-equals-to' => 10000
                        ]
                    ],
                ],
            ],
        ];
    }

    /**
     * Get config for hidden field used for sorting
     *
     * @param int $sortOrder
     * @return array
     * @since 101.0.0
     */
    protected function getPositionFieldConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'componentType' => Field::NAME,
                        'formElement' => Input::NAME,
                        'dataScope' => static::FIELD_SORT_ORDER_NAME,
                        'dataType' => Number::NAME,
                        'visible' => false,
                        'sortOrder' => $sortOrder,
                    ],
                ],
            ],
        ];
    }

    /**
     * Get config for hidden field used for sorting
     *
     * @param int $sortOrder
     * @return array
     * @since 101.0.0
     */
    protected function getFreeIdFieldConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'componentType' => Field::NAME,
                        'formElement' => Input::NAME,
                        'dataScope' => static::FIELD_FREE_ID_NAME,
                        'dataType' => Number::NAME,
                        'visible' => false,
                        'sortOrder' => $sortOrder,
                    ],
                ],
            ],
        ];
    }

}
