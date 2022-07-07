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
        $user->setPassword('$2y$13$t4C0CuooN07nprYKD5x5UeIEab8FaVvDlhtDO13NvK8Y2SsB.me7O');
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $userUser = new User;
        $userUser->setEmail('user@user.com');
        $userUser->setPassword('$2y$13$V5/Tv9l.73QTTH4S.2snO.qWi2M2tcouxYQdq0iLPgi/4wfjb5.Pe');
        $userUser->setRoles(['ROLE_USER']);
        $manager->persist($userUser);

        $man = new User;
        $man->setEmail('manager@manager.com');
        $man->setPassword('$2y$13$P1WneVjoPsN8dR.1oTcBnOn4o0zXf/ke1ntOFHkq3BK3TMea.HNuy');
        $man->setRoles(['ROLE_MANAGER']);
        $manager->persist($man);

        $manager->flush();
    }
}
