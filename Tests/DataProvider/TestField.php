<?php
/**
 * Date: 13.05.16
 *
 * @author Portey Vasil <portey@gmail.com>
 */

namespace Youshido\Tests\DataProvider;

use Youshido\GraphQL\Field\AbstractField;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\IntType;

class TestField extends AbstractField
{

    /**
     * @return AbstractObjectType
     */
    public function getType()
    {
        return new IntType();
    }

    public function resolve($value, $args = [], $type = null)
    {
        return $value;
    }

    public function getDescription()
    {
        return 'description';
    }
}