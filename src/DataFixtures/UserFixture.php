<?php

namespace App\DataFixtures;

use App\Entity\Security\ApiToken;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixture extends BaseFixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {

    }

    protected function loadData(ObjectManager $manager): void
    {
        $this->createMany(10, 'api_users', function () use ($manager) {

            $user = new User();
            $user->setEmail($this->faker->email());
            $user->setPassword(
                $this->passwordHasher->hashPassword(
                    $user,
                    'engage'
                )
            );

            $apiToken1 = new ApiToken($user);
            $apiToken2 = new ApiToken($user);

            $manager->persist($apiToken1);
            $manager->persist($apiToken2);

            return $user;
        });

        $manager->flush();
    }
}
