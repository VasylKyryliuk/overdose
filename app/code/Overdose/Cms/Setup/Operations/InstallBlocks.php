<?php

declare(strict_types=1);

namespace Overdose\Cms\Setup\Operations;


use Overdose\Cms\Model\CmsBlockSetup;

/**
 * Class InstallBlocks
 *
 * @package Overdose\Cms\Setup\Operations
 */
class InstallBlocks
{
    /**
     * @var CmsBlockSetup
     */
    private $cmsBlockSetup;

    /**
     * @var array
     */
    private $blockFixtures;

    /**
     * @param CmsBlockSetup $cmsBlockSetup
     * @param array $blockFixtures
     */
    public function __construct(
        CmsBlockSetup $cmsBlockSetup,
        array $blockFixtures = []
    ) {
        $this->cmsBlockSetup = $cmsBlockSetup;
        $this->blockFixtures = $blockFixtures;
    }

    /**
     * Run install
     *
     * @throws \Exception
     * @return void
     */
    public function execute(): void
    {
        $this->cmsBlockSetup->install(array_values($this->blockFixtures));
    }
}
