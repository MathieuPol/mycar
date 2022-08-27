<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class UserFixture extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {

        //*On execute les fixtures une fois
        //*A chaques executions on crée les utilisateurs

        $user = new User;
        $user->setEmail('admin@admin.com');
        $user->setPassword('$2y$13$Fn.MijcGwngMBDWhc.sHvOlWYSxu89YCrSxIq1J5zn8BlUF82yHvK');
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $userUser = new User;
        $userUser->setEmail('user@user.com');
        $userUser->setPassword('$2y$13$xjwK4lez02pkisWQR4i1g.tmUfERpOmDpFw9uhzTKREkKd9lOOe1y');
        $userUser->setRoles(['ROLE_USER']);
        $manager->persist($userUser);

        $man = new User;
        $man->setEmail('manager@manager.com');
        $man->setPassword('$2y$13$8mHp4TX0yUo.U0UpDcjZTO7NnqdJtE1pCJbT5fF50pqDM6Rx2hhPC');
        $man->setRoles(['ROLE_MANAGER']);
        $manager->persist($man);

        $manager->flush();
    }

        /**
     * Nous permet de classer les fixtures pour pouvoir les éxecuter séparement
     *
     * @return array
     */
    public static function getGroups(): array
    {
        return ['userGroup'];
    }
}
