<?php namespace Tests\PCI\Models;

use PCI\Models\Item;
use PCI\Models\ItemType;
use Tests\BaseTestCase;

class ItemTypeTest extends BaseTestCase
{

    public function testItems()
    {
        $this->mockBasicModelRelation(
            ItemType::class,
            'items',
            'hasMany',
            Item::class
        );
    }
}
