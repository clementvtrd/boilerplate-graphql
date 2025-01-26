<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Domain\Model\User;
use Infrastructure\Doctrine\Entity\UserEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

final readonly class UserRepository extends AbstractRepository implements PasswordUpgraderInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, UserEntity::class);
    }

    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new \RuntimeException("Unknown object, expect Domain\\Model\\User got ".get_class($user));
        }

        $user->password = $newHashedPassword;
    }
}
