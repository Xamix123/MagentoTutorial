<?php

namespace Learning\UiFormTest\Setup\Patch\Data;

use Learning\UiFormTest\Model\ResourceModel\UiFormTest;
use Learning\UiFormTest\Model\UiFormTestFactory;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;

class AddData implements DataPatchInterface, PatchVersionInterface
{
    private $testModelFactory;
    private $testModelResource;
    private $moduleDataSetup;

    public function __construct(
        UiFormTestFactory $testModelFactory,
        UiFormTest $testModelResource,
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->testModelFactory = $testModelFactory;
        $this->testModelResource = $testModelResource;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * @throws AlreadyExistsException
     */
    public function apply()
    {
        //Install data row into contact_details table
        $this->moduleDataSetup->startSetup();
        $testModelDTO = $this->testModelFactory->create();
        $testModelDTO->setEmail('test@gmail.com')
            ->setDescription('test description 123 123')
            ->setStatus("testStatus");

        $this->testModelResource->save($testModelDTO);
        $this->moduleDataSetup->endSetup();
    }
    public static function getDependencies()
    {
        return [];
    }

    public static function getVersion()
    {
        return '1.0.1';
    }

    public function getAliases()
    {
        return [];
    }
}
