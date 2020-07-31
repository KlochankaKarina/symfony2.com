<?php

declare(strict_types=1);

namespace App\Security;

use App\Entity\UserNet;
use App\Repository\UserNetRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    /**
     * @var UserNetRepository
     */
    private $userNetRepository;

    /**
     * @param UserNetRepository $userNetRepository
     */
    public function __construct(UserNetRepository $userNetRepository)
    {
        $this->userNetRepository = $userNetRepository;
    }

    /**
     * @param string $username
     *
     * @return mixed|UserInterface
     *
     * @throws NonUniqueResultException
     */
    public function loadUserByUsername($username)
    {
        return $this->userNetRepository->loadUserByUsername($username);
    }

    /**
     * @param UserInterface $user
     *
     * @return UserInterface
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof UserNet) {
            throw  new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported. ', get_class($user))
            );
        }

        return $user;
    }

    /**
     * @param string $class
     *
     * @return bool
     */
    public function supportsClass($class): bool
    {
        return $class === 'App\Entity\UserNet';
    }
}