Overdose CMS Extension
======================

Custom extension for installing Cms Blocks and Pages during development process.
If page or block already exists it will update it.
This extensions updates all blocks and pages during `bin/magento setup:upgrade` that are mentioned in `Overdose\Cms\etc\di.xml`.
If something is changed in admin for blocks or pages that are created by this extension, content should be updated in fixtures too.

### How to install CMS Blocks

Create `.csv` file in `Overdose\Cms\fixtures\blocks\` using template `empty.csv`.
Add dependency in file `Overdose\Cms\etc\di.xml`:

```
    <type name="Overdose\Cms\Setup\Operations\InstallBlocks">
        <arguments>
            <argument name="blockFixtures" xsi:type="array">
                <item name="BLOCK_NAME" xsi:type="string">Overdose_Cms::fixtures/blocks/BLOCK_FILE_NAME.csv</item>
            </argument>
        </arguments>
    </type>
```

### How to install CMS Pages

Create `.csv` file in `Overdose\Cms\fixtures\pages\` using template `empty.csv`.
Add dependency in file `Overdose\Cms\etc\di.xml`:

```
    <type name="Overdose\Cms\Setup\Operations\InstallPages">
        <arguments>
            <argument name="pageFixtures" xsi:type="array">
                <item name="PAGE_NAME" xsi:type="string">Overdose_Cms::fixtures/pages/PAGE_FILE_NAME.csv</item>
            </argument>
        </arguments>
    </type>
```

### How to install Cms Page or Block from another extension

#### For Pages
Create `.csv` file in `VENDOR\MODULE\fixtures\pages\` using template `empty.csv` from `Overdose\Cms\fixtures\pages\`
Add dependency in file `VENDOR\MODULE\etc\di.xml`:

```
    <type name="Overdose\Cms\Setup\Operations\InstallPages">
        <arguments>
            <argument name="pageFixtures" xsi:type="array">
                <item name="PAGE_NAME" xsi:type="string">VENDOR_MODULE::fixtures/pages/PAGE_FILE_NAME.csv</item>
            </argument>
        </arguments>
    </type>
```

#### For Blocks
Create `.csv` file in `VENDOR\MODULE\fixtures\blocks\` using template `empty.csv` from `Overdose\Cms\fixtures\blocks\`
Add dependency in file `VENDOR\MODULE\etc\di.xml`:

```
    <type name="Overdose\Cms\Setup\Operations\InstallBlocks">
        <arguments>
            <argument name="blockFixtures" xsi:type="array">
                <item name="BLOCK_NAME" xsi:type="string">VENDOR_MODULE::fixtures/blocks/BLOCK_FILE_NAME.csv</item>
            </argument>
        </arguments>
    </type>
```

### Before go to production

The file `Overdose\Cms\Setup\Recurring.php` should be removed.

