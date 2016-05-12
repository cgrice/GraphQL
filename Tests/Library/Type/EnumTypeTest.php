<?php
/**
 * Date: 12.05.16
 *
 * @author Portey Vasil <portey@gmail.com>
 */

namespace Youshido\Tests\Library\Type;


use Youshido\GraphQL\Type\Enum\EnumType;
use Youshido\GraphQL\Type\TypeMap;
use Youshido\Tests\DataProvider\TestEnumType;

class EnumTypeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException Youshido\GraphQL\Validator\Exception\ConfigurationException
     */
    public function testInvalidInlineCreation()
    {
        new EnumType([]);
    }

    /**
     * @expectedException Youshido\GraphQL\Validator\Exception\ConfigurationException
     */
    public function testInvalidEmptyParams()
    {
        new EnumType([
            'values' => []
        ]);
    }

    /**
     * @expectedException Youshido\GraphQL\Validator\Exception\ConfigurationException
     */
    public function testInvalidValueParams()
    {
        new EnumType([
            'values' => [
                'test'  => 'asd',
                'value' => 'asdasd'
            ]
        ]);
    }

    /**
     * @expectedException Youshido\GraphQL\Validator\Exception\ConfigurationException
     */
    public function testExistingNameParams()
    {
        new EnumType([
            'values' => [
                [
                    'test'  => 'asd',
                    'value' => 'asdasd'
                ]
            ]
        ]);
    }

    /**
     * @expectedException Youshido\GraphQL\Validator\Exception\ConfigurationException
     */
    public function testInvalidNameParams()
    {
        new EnumType([
            'values' => [
                [
                    'name'  => false,
                    'value' => 'asdasd'
                ]
            ]
        ]);
    }

    public function testNormalCreatingParams()
    {
        $valuesData = [
            [
                'name'  => 'ENABLE',
                'value' => true
            ],
            [
                'name'  => 'DISABLE',
                'value' => 'disable'
            ]
        ];
        $enumType   = new EnumType([
            'name'   => 'BoolEnum',
            'values' => $valuesData
        ]);

        $this->assertEquals($enumType->getKind(), TypeMap::KIND_ENUM);
        $this->assertEquals($enumType->getName(), 'BoolEnum');
        $this->assertEquals($enumType->getType(), $enumType);
        $this->assertEquals($enumType->getNamedType(), $enumType);

        $this->assertFalse($enumType->isValidValue($enumType));
        $this->assertFalse($enumType->isValidValue(null));

        $this->assertTrue($enumType->isValidValue(true));
        $this->assertTrue($enumType->isValidValue('disable'));

        $this->assertNull($enumType->serialize('NOT EXIST'));
        $this->assertTrue($enumType->serialize('ENABLE'));

        $this->assertEquals($valuesData, $enumType->getValues());
    }

    public function testExtendedObject()
    {
        $testEnumType = new TestEnumType();
        $this->assertEquals('TestEnum', $testEnumType->getName());
    }

}
