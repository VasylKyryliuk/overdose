<?php

declare(strict_types=1);

namespace Overdose\Cms\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Overdose\Cms\Setup\Operations\InstallBlocks;
use Overdose\Cms\Setup\Operations\InstallPages;

/**
 * This script is used to keep on date CMS data during development process.
 * Should be removed after finish of development
 */
class Recurring implements InstallSchemaInterface
{
    /**
     * @var InstallBlocks
     */
    private $installBlocks;

    /**
     * @var InstallPages
     */
    private $installPages;

    /**
     * @param InstallBlocks $installBlocks
     * @param InstallPages $installPages
     */
    public function __construct(
        InstallBlocks $installBlocks,
        InstallPages $installPages
    ) {
        $this->installBlocks = $installBlocks;
        $this->installPages = $installPages;
    }

    /**
     * @inheritdoc
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $this->installBlocks->execute();
        $this->installPages->execute();

        $installer->endSetup();
    }
}
