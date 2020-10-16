<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class AbstractEntityService
 * @package App\Services
 */
abstract class AbstractEntityService
{
    /** @var EntityManagerInterface */
    private static $entityManager;

    /** @var boolean */
    protected $useResultCache = false;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        self::$entityManager = $entityManager;
    }

    /**
     * @param EntityManagerInterface $entityManager
     */
    public static function setEntityManager(EntityManagerInterface $entityManager): void
    {
        self::$entityManager = $entityManager;
    }

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface
    {
        return self::$entityManager;
    }

    public function clearEntityManager(): void
    {
        self::$entityManager->clear();
    }

    public function closeEntityManager(): void
    {
        self::$entityManager->close();
    }

    abstract public function getRepository();
}
