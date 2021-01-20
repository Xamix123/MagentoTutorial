<?php

namespace Learning\BackendPlugins\Model\Plugin;

use Magento\Catalog\Model\Product;

class Plugin1
{
    public function beforeTargetForPlugin(Product $subject)
    {
        echo "i before target";
    }
}
