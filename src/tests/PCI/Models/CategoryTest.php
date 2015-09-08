<?php namespace Tests\PCI\Models;

use Mockery;
use PCI\Models\Category;
use PCI\Models\SubCategory;
use Tests\BaseTestCase;

class CategoryTest extends BaseTestCase
{

    public function testSubCategories()
    {
        $this->mockBasicModelRelation(
            Category::class,
            'subCategories',
            'hasMany',
            SubCategory::class
        );
    }
}
