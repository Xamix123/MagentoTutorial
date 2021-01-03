<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Cms\Test\Block\Adminhtml\Wysiwyg;

use Magento\Mtf\Block\Block;
use Magento\Mtf\Client\Locator;

/**
 * System variables management block.
 */
class Config extends Block
{
    /**
     * Selector for getting all variables in list.
     *
     * @var string
     */
    protected $variablesSelector = '.insert-variables > li > a';

    /**
     * Variable link selector.
     *
     * @var string
     */
    protected $variableSelector = '//*[@class="insert-variables"]//a[contains(text(),"%s")]';

    /**
     * Returns array with all variables.
     *
     * @return array
     */
    public function getAllVariables()
    {
        $values = [];

        $variableElements = $this->_rootElement->getElements($this->variablesSelector);
        foreach ($variableElements as $variableElement) {
            if ($variableElement->isVisible()) {
                $values[] = $variableElement->getText();
            }
        }

        return $values;
    }

    /**
     * Select variables by name.
     *
     * @param string $variableName
     * @return void
     */
    public function selectVariableByName($variableName)
    {
        $this->_rootElement->find(sprintf($this->variableSelector, $variableName), Locator::SELECTOR_XPATH)->click();
    }
}
