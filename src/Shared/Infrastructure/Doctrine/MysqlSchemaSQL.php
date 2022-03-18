<?php


namespace App\Shared\Infrastructure\Doctrine;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;

class MysqlSchemaSQL
{

    private EntityManager $em;

    /**
     * MysqlSchemaSQL constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function __invoke(): array
    {
        $loadedMetadata = [];
        $allClassNames = DoctrineEntityManagerFactory::getMetadataDriver(DoctrinePrefixesSearcher::inPath(__DIR__ . '/../../../Backoffice', 'App\Backoffice'), [])->getAllClassNames();

        foreach ($allClassNames as $class)
        {
            $loadedMetadata[] = $this->em->getClassMetadata($class);
        }
        $schemaTool = new SchemaTool($this->em);
        return $schemaTool->getUpdateSchemaSql($loadedMetadata);
    }


}