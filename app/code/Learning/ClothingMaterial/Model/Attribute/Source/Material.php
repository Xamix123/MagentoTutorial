<?php

namespace Learning\ClothingMaterial\Model\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Material extends AbstractSource
{
    /**
     * Get All options
     *
     * @return array
     */
    public function getAllOptions(): array
    {
        if (!$this->_options) {
            $this->_options = [
                ['label' => __('Cotton'), 'value' => 'cotton'],
                ['label' => __('Leather'), 'value' => 'leather'],
                ['label' => __('Silk'), 'value' => 'silk'],
                ['label' => __('Denim'), 'value' => 'denim'],
                ['label' => __('Fur'), 'value' => 'fur'],
                ['label' => __('Wool'), 'value' => 'wool'],
                ['label' => __('TestData1'), 'value' => 'testData'],
            ];
        }
        return $this->_options;
    }
}
