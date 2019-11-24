<?php
namespace User\Service;

use User\Entity\User;
use User\Entity\Company;
use Zend\Crypt\Password\Bcrypt;
use Zend\Math\Rand;
use Zend\Mail;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;

/**
 * This service is responsible for adding/editing users
 * and changing user password.
 */
class CompanyManager
{
    /**
     * Doctrine entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Constructs the service.
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * This method adds a new company.
     */
    public function addCompany($data)
    {
        // Do not allow several users with the same email address.
        if($this->checkCompanyExists($data['name'])) {
            throw new \Exception("Company with name " . $data['name'] . " already exists");
        }

        // Create new Company entity.
        $company = new Company();
        $company->setName($data['name']);
        $company->setToken($data['token']);
        $company->setAddress($data['address']);
        $company->setPhone($data['phone']);
        // Add the entity to the entity manager.
        $this->entityManager->persist($company);

        // Apply changes to database.
        $this->entityManager->flush();

        return $company;
    }

    /**
     * This method updates data of an existing user.
     */
    public function updateCompany($company, $data)
    {
        $company->setName($data['name']);
        $company->setToken($data['token']);
        $company->setAddress($data['address']);
        $company->setPhone($data['phone']);

        // Apply changes to database.
        $this->entityManager->flush();

        return true;
    }

    /**
     * Checks whether an active user with given email address already exists in the database.
     * @param $name
     * @return bool
     */
    public function checkCompanyExists($name) {

        $company = $this->entityManager->getRepository(Company::class)
            ->findOneByName($name);

        return $company !== null;
    }
}

