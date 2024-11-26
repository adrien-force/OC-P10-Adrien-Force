<?php

namespace App\DataFixtures;

use App\Factory\ProjectFactory;
use App\Factory\TagFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        TagFactory::createMany(10);
        $master = ProjectFactory::createOne([
            'name' => 'Master Project',
        ]);
        /**  ADMIN CREATION  **/
        $users = $master->getUsers();
        $users[0]->setEmail('admin@tasklinker.com');
        $users[0]->setRoles(['ROLE_ADMIN']);
        $users[0]->setFirstname('Admin');
        $users[0]->setLastname('Tasklinker');
        /** **/
        ProjectFactory::createMany(4);
    }
}
