<?php


namespace Darkanakin41\CoreBundle\Tests\Model;


use PHPUnit\Framework\TestCase;

abstract class AbstractEntityTestCase extends TestCase
{
    public function testId()
    {
        $stream = $this->getEntity();
        $this->assertNull($stream->getId());
    }

    abstract protected function getEntity();

    protected function getFieldValue($entity, $fieldname, $value){
        if(is_bool($value)){
            return call_user_func([$entity, sprintf('is%s', ucfirst($fieldname))]);
        }
        return call_user_func([$entity, sprintf('get%s', ucfirst($fieldname))]);
    }

    protected function setFieldValue($entity, $fieldname, $value){
        call_user_func([$entity, sprintf('set%s', ucfirst($fieldname))], $value);
    }

    /**
     * @param $fieldname
     * @param $testValue
     *
     * @dataProvider nullableFieldProvider
     */
    public function testNullableField($fieldname, $testValue)
    {
        $entity = $this->getEntity();
        $before = $this->getFieldValue($entity, $fieldname, $testValue);
        $this->assertNull($before);

        $this->setFieldValue($entity, $fieldname, $testValue);
        $after = $this->getFieldValue($entity, $fieldname, $testValue);
        $this->assertEquals($testValue, $after);
    }

    /**
     * @return array example : [fieldname, testValue]
     */
    abstract public function nullableFieldProvider();


    /**
     * @param $fieldname
     * @param $testValue
     *
     * @dataProvider notNullableFieldProvider
     */
    public function testNotNullableField($fieldname, $testValue)
    {
        $entity = $this->getEntity();

        $this->setFieldValue($entity, $fieldname, $testValue);
        $after = $this->getFieldValue($entity, $fieldname, $testValue);
        $this->assertEquals($testValue, $after);
    }

    /**
     * @return array example : [fieldname, testValue]
     */
    abstract public function notNullableFieldProvider();

    /**
     * @param $fieldname
     * @param $defaultValue
     * @param $updatedValue
     *
     * @dataProvider defaultValueProvider
     */
    public function testDefaultValue($fieldname, $defaultValue, $updatedValue)
    {
        $entity = $this->getEntity();
        $value = $this->getFieldValue($entity, $fieldname, $defaultValue);
        $this->assertEquals($defaultValue, $value);

        $this->setFieldValue($entity, $fieldname, $updatedValue);
        $after = $this->getFieldValue($entity, $fieldname, $defaultValue);
        $this->assertEquals($updatedValue, $after);
    }

    /**
     * @return array example : [fieldname, defaultValue, updatedValue]
     */
    abstract public function defaultValueProvider();

}
