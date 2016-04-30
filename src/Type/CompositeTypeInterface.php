<?php

namespace Youshido\GraphQL\Type;
/*
 * This file is a part of GraphQL project.
 *
 * @author Alexandr Viniychuk <a@viniychuk.com>
 * created: 3:48 PM 4/29/16
 */
Interface CompositeTypeInterface {

    /**
     * @return AbstractType
     */
    public function getTypeOf();
}