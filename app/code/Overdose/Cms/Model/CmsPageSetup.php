<?php

declare(strict_types=1);

namespace Overdose\Cms\Model;

use Magento\Framework\File\Csv;
use Magento\Framework\Setup\SampleData\Context as SampleDataContext;
use Magento\Cms\Api\Data\PageInterface;
use Magento\Cms\Api\Data\PageInterfaceFactory;
use Magento\Framework\Setup\SampleData\FixtureManager;
use Magento\Store\Model\Store;

/**
 * Class CmsPageSetup
 *
 * @package Overdose\Cms\Model
 */
class CmsPageSetup
{
    /**
     * @var PageInterfaceFactory
     */
    private $pageFactory;

    /**
     * @var FixtureManager
     */
    private $fixtureManager;

    /**
     * @var Csv
     */
    private $csvReader;

    /**
     * @param SampleDataContext $sampleDataContext
     * @param PageInterfaceFactory $pageFactory
     */
    public function __construct(
        SampleDataContext $sampleDataContext,
        PageInterfaceFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
        $this->fixtureManager = $sampleDataContext->getFixtureManager();
        $this->csvReader = $sampleDataContext->getCsvReader();
    }

    /**
     * Install Data
     *
     * @param array $fixtures
     * @throws \Exception
     */
    public function install(array $fixtures): void
    {
        foreach ($fixtures as $fileName) {
            $fileName = $this->fixtureManager->getFixture($fileName);
            if (!file_exists($fileName)) {
                continue;
            }

            $rows = $this->csvReader->getData($fileName);
            $header = array_shift($rows);

            foreach ($rows as $row) {
                $data = [];
                foreach ($row as $key => $value) {
                    $data[$header[$key]] = $value;
                }
                $storeIds = [Store::DEFAULT_STORE_ID];
                if (key_exists(Store::STORE_ID, $data)) {
                    $storeIds = is_array($data[Store::STORE_ID]) ?: explode(',', $data[Store::STORE_ID]);
                }
                $this->pageFactory->create()
                    ->setStoreId($storeIds[0])
                    ->load($data[PageInterface::IDENTIFIER], PageInterface::IDENTIFIER)
                    ->addData($data)
                    ->setStores([Store::DEFAULT_STORE_ID])
                    ->save();
            }
        }
    }
}
