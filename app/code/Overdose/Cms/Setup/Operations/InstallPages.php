<?php

declare(strict_types=1);

namespace Overdose\Cms\Setup\Operations;

use Overdose\Cms\Model\CmsPageSetup;

/**
 * Class InstallPages
 *
 * @package Overdose\Cms\Setup\Operations
 */
class InstallPages
{
    /**
     * @var CmsPageSetup
     */
    private $cmsPageSetup;

    /**
     * @var array
     */
    private $pageFixtures;

    /**
     * @param CmsPageSetup $cmsPageSetup
     * @param array $pageFixtures
     */
    public function __construct(
        CmsPageSetup $cmsPageSetup,
        array $pageFixtures = []
    ) {
        $this->cmsPageSetup = $cmsPageSetup;
        $this->pageFixtures = $pageFixtures;
    }

    /**
     * Run install
     *
     * @throws \Exception
     * @return void
     */
    public function execute(): void
    {
        $this->cmsPageSetup->install(array_values($this->pageFixtures));
    }
}
