<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        //*On execute les fixtures une fois
        //*A chaques executions on crée les utilisateurs

        $user = new User;
        $user->setEmail('admin@admin.com');
        $user->setPassword('$2y$13$2NgYPMZKZ/ME35j4Cmv9YOrOVNUsSVOGOw.u7IaEh4gr.Jghb00IK');
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $userUser = new User;
        $userUser->setEmail('user@user.com');
        $userUser->setPassword('$2y$13$rk8fC9BIsoVq.VcYsSan8uovcFRcj9iSUb0LI9gmBvG/5MUrf2qxG');
        $userUser->setRoles(['ROLE_USER']);
        $manager->persist($userUser);

        $man = new User;
        $man->setEmail('manager@manager.com');
        $man->setPassword('$2y$13$lN0u6acGVJBRghxhSPaPcOA3Yf8Ss6PAP4yHrbOJZauBkirUwZ106');
        $man->setRoles(['ROLE_MANAGER']);
        $manager->persist($man);

        $manager->flush();
    }
}
