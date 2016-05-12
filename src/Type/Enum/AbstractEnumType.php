<?php
/**
 * Date: 07.12.15
 *
 * @author Portey Vasil <portey@gmail.com>
 */

namespace Youshido\GraphQL\Type\Enum;


use Youshido\GraphQL\Config\Object\EnumTypeConfig;
use Youshido\GraphQL\Type\AbstractType;
use Youshido\GraphQL\Type\Traits\AutoNameTrait;
use Youshido\GraphQL\Type\TypeMap;

abstract class AbstractEnumType extends AbstractType
{

    use AutoNameTrait;

    /**
     * ObjectType constructor.
     * @param $config
     */
    public function __construct($config = [])
    {
        if (empty($config)) {
            $config['name']       = $this->getName();
            $config['values'] = $this->getValues();
        }

        $this->config = new EnumTypeConfig($config, $this);
    }

    /**
     * @return String predefined type kind
     */
    public function getKind()
    {
        return TypeMap::KIND_ENUM;
    }

    /**
     * @param $value mixed
     *
     * @return bool
     */
    public function isValidValue($value)
    {
        $values = array_map(function ($item) {
            return $item['value'];
        }, $this->getConfig()->get('values'));

        foreach ($values as $enumValue) {
            if ($enumValue === $value) {
                return true;
            }
        }

        return false;
    }

    abstract public function getValues();

    public function serialize($value)
    {
        foreach ($this->getConfig()->get('values') as $valueItem) {
            if ($value == $valueItem['name']) {
                return $valueItem['value'];
            }
        }

        return null;
    }

}
