<?php
namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This class represents a registered user.
 * @ORM\Entity(repositoryClass="\User\Repository\UserRepository")
 * @ORM\Table(name="company")
 */
class Company
{

    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(name="name", nullable=true)
     */
    protected $name;

    /**
     * @ORM\Column(name="token", nullable=true)
     */
    protected $token;

    /**
     * @ORM\Column(name="phone", nullable=true)
     */
    protected $phone;

    /**
     * @ORM\Column(name="address", nullable=true)
     */
    protected $address;

    /**
     * INVERSE SIDE
     *
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
    targetEntity="User\Entity\User", mappedBy="company",
    )
     * @ORM\OrderBy({"id" = "ASC"})
     */
    protected $user;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

    /**
     * Returns user ID.
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets user ID.
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Returns name.
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets name.
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Returns token.
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Sets token.
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return ArrayCollection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param ArrayCollection $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
}