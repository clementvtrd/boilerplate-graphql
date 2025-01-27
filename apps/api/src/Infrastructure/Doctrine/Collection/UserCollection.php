<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Collection;

use Application;
use Doctrine\ORM\EntityManagerInterface;
use Domain;
use Infrastructure\Doctrine\Repository\UserRepository;
use Symfony\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[AsAlias(Application\Collection\UserCollectionInterface::class)]
#[AsAlias(Domain\Collection\UserCollectionInterface::class)]
final readonly class UserCollection extends AbstractCollection implements Domain\Collection\UserCollectionInterface, Application\Collection\UserCollectionInterface
{
    public function __construct(
        private UserRepository $userRepository,
        EntityManagerInterface $entityManager,
    ) {
        parent::__construct($entityManager);
    }

    public function findOneByUsername(string $username): (PasswordAuthenticatedUserInterface & UserInterface & Domain\Model\User) | null
    {
        return $this->userRepository->findOneBy(['username' => $username]);
    }
}
