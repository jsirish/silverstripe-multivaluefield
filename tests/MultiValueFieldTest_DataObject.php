<?php

namespace Symbiote\MultiValueField\Tests\TestOnly;

use SilverStripe\Dev\TestOnly;
use SilverStripe\ORM\DataObject;
use Symbiote\MultiValueField\Fields\MultiValueField;

class MultiValueFieldTest_DataObject extends DataObject implements TestOnly {

    private static $db = [
        'Title' => 'Varchar(255)',
        'MVField' => MultiValueField::class
    ];

    private static $table_name = 'MultiValueFieldTest_Test';
}