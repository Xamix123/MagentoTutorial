<?php

namespace Learning\ClothingMaterial\Block;

use Magento\Framework\View\Element\Template;

abstract class FrontendModelShow extends Template
{
    const NAME_ATTRIBUTE = "";
    const TITLE = "";

    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * @param $collection
     * @param $entity
     * @return array
     */
    public function getAdditionalDataFromCollection($collection, $entity): array
    {
        $data = [];
        $collectionData = $collection->getData();

        $code =  $collection->getAttribute(static::NAME_ATTRIBUTE)->getAttributeCode();
        $value = $collection->getAttribute(static::NAME_ATTRIBUTE)->getFrontend()->getValue($entity);
        $label = $collection->getAttribute(static::NAME_ATTRIBUTE)->getDefaultFrontendLabel();

        foreach ($collectionData as $item) {
            $data[] = [
                'id' => $item['entity_id'],
//                'name' => self::getName($item),
//                'email' => $item['email'],
                'label' => $label,
                'code' => $code,
                'value' => $value
            ];
        }
        return $data;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return static::TITLE;
    }
}
