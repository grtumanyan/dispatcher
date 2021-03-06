<?php
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use User\Service\CompanyManager;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Controller\IndexController;

/**
 * This is the factory for IndexController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $companyManager = $container->get(CompanyManager::class);

        // Instantiate the controller and inject dependencies
        return new IndexController($entityManager, $companyManager);
    }
}