<?php

namespace Symbiote\MultiValueField\Tests;

use SilverStripe\Dev\Debug;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\FieldType\DBField;
use Symbiote\MultiValueField\Fields\MultiValueField;
use Symbiote\MultiValueField\Tests\TestOnly\MultiValueFieldTest_DataObject;

/**
 * @author Marcus Nyeholt <marcus@symbiote.com.au>
 */
class MultiValueFieldTest extends SapphireTest {

    protected static $extra_dataobjects = array(
		MultiValueFieldTest_DataObject::class
	);

    //protected static $fixture_file = 'fixtures.yml';

	public function testMultiValueField() {
		$first = array('One', 'Two', 'Three');

		//$obj = $this->objFromFixture(MultiValueFieldTest_DataObject::class, 'default');
        $obj = new MultiValueFieldTest_DataObject();
		$obj->MVField = $first;
		$obj->write();
        //Debug::show(print_r($obj->MVField));
        //Debug::show(($obj->ID));

		$this->assertTrue($obj->isInDB());
		$obj = MultiValueFieldTest_DataObject::get()->byID($obj->ID);
        //Debug::show($obj);

		$this->assertNotNull($obj->MVField);
		$this->assertEquals($first, $obj->MVField->getValues());

		$second = array('Four', 'Five');
		$obj->MVField = $second;
		$obj->write();

		$this->assertEquals($second, $obj->MVField->getValues());
	}

	public function testIsChanged() {
		$field = new MultiValueField();
		$this->assertFalse($field->isChanged());

		$field->setValue(array(1, 2, 3));
		$this->assertTrue($field->isChanged());

		$field = new MultiValueField();
		$field->setValue(array(1, 2, 3), null, false);
		$this->assertFalse($field->isChanged());

		$field = DBField::create_field('MultiValueField', array(1, 2, 3));
		$field->setValue(null);
		$this->assertTrue($field->isChanged());
	}

}