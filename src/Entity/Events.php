<?php
declare(strict_types=1);
namespace App\Entity;

use Doctrine\DBAL\Types\DateType;
use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Events
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", nullable=true)
     */
    private $isRead;
/**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\Length(min=10, max=255)
     */
    private $username;
/**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\Length(min=10, max=255)
     */
    private $body;
    

    public function getIsRead(): ?int
    {
        return $this->isRead;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->data;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }

    
}
