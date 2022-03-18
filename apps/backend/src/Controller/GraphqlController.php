<?php


namespace App\Backend\Controller;


use GraphQL\GraphQL;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GraphqlController extends AbstractController
{

    /**
     * @Route("/graphql", name="graphql")
     */
    public function graphqlAction(Request $request): JsonResponse
    {
        $queryType = new ObjectType([
            'name' => 'Query',
            'fields' => [
                'getUsers' => [
                    'type' => new UserType(),
                    'args' => [
                        'name' => [
                            'type' => Type::string(),
                            'description' => 'nombre del blabla',
                        ]
                    ],
                    'resolve' => function($rootValue,$args) {

                        return $args['name']=='abad'?['email'=>'abad@foxize.com','name'=>'abad']:[];
                    }
                ],

            ]
        ]);

        $mutationType = new ObjectType([
            'name' => 'Mutation',
            'fields' => [
                'createReview' => [
                    'type'=>Type::string(),
                    'args' => [
                    ],
                    'resolve' => function($rootValue, $args) {
                        // TODOC
                    }
                ]
            ]
        ]);

        $queryType2 = new ObjectType([
            'name' => 'User',
            'fields' => [
                'hello' => [
                    'type' => Type::string(),
                    'resolve' => function() {
                        return 'Hello World!';
                    }
                ],
            ]
        ]);

        $schema = new Schema([
            'query' => $queryType,
            'mutation' => $mutationType
        ]);

        $rawInput = file_get_contents('php://input');
        $input = json_decode($rawInput, true);
        $query = $input['query'];
        $variableValues = isset($input['variables']) ? $input['variables'] : null;

        try {
            $rootValue = ['prefix' => 'You said: '];
            $result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
            $output = $result->toArray();
        } catch (\Exception $e) {
            $output = [
                'errors' => [
                    [
                        'message' => $e->getMessage()
                    ]
                ]
            ];
        }
        return new JsonResponse($output,200);
    }

}