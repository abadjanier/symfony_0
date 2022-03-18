<?php


namespace App\Backend\Controller;


use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\StringType;
use GraphQL\Type\Definition\Type;

class UserType extends ObjectType
{

    public function __construct()
    {
        $config = [
            'name' => 'User',
            'fields' => function() {
                return [
                    'email' => Type::string(),
                    'name' => Type::string()
                ];
            }
        ];
        parent::__construct($config);
    }

}