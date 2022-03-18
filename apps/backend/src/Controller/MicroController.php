<?php

namespace App\Backend\Controller;

use App\Backoffice\Users\Domain\User;
use App\Shared\Infrastructure\Doctrine\MysqlSchemaSQL;
use Doctrine\ORM\EntityManager;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MicroController extends AbstractController
{

    /**
     * @Route("/random/{limit}", name="micasaloco")
     * @param int $limit
     * @param EntityManager $entityManager
     * @param MysqlSchemaSQL $mysqlSchemaSQL
     * @return Response
     * @throws Exception
     */
    public function randomNumber(int $limit, EntityManager $entityManager, MysqlSchemaSQL $mysqlSchemaSQL): Response
    {
        dump(implode(';'.PHP_EOL,$mysqlSchemaSQL->__invoke()));
        dump($entityManager->getRepository(User::class)->find(1));
        $number = random_int(0, $limit);
        return $this->render('micro/random.html.twig', [
            'number' => $number,
        ]);
    }
}