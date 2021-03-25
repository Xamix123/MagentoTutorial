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
     * @param $customData
     * @return array
     */
    public function getAdditionalDataFromCollection($collection, $customData): array
    {
        $data = [];
        $collectionData = $collection->getData();

        $code =  $collection->getAttribute(static::NAME_ATTRIBUTE)->getAttributeCode();
        $label = $collection->getAttribute(static::NAME_ATTRIBUTE)->getDefaultFrontendLabel();

        foreach ($collectionData as $id => $item) {
            $data[] = [
                'id' => $item['entity_id'],
                'code' => $code,
                'label' => $label
            ];
            $data[$id] = array_merge($data[$id], $customData[$id]);
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
