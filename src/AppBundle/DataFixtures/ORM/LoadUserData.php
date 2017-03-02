<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadUserData
 */
class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{

    private $users = [
        [
            'role'      => User::USER_ROLE_SUPER_ADMIN,
            'civility'  => User::USER_CIVILITY_MAN,
            'firstName' => 'Corentin',
            'lastName'  => 'Regnier',
            'email'     => 'admin@gmail.com',
            'username'  => 'admin',
            'password'  => '1234',
            'enabled'   => true,
        ],
        [
            'role'      => User::USER_ROLE_USER,
            'civility'  => User::USER_CIVILITY_MAN,
            'firstName' => 'Réno',
            'lastName'  => 'Loureiro',
            'email'     => 'user@gmail.com',
            'username'  => 'user',
            'password'  => '1234',
            'enabled'   => true,
        ],
    ];

    /**
     * @param ObjectManager $manager
     * insérer en bdd le jeu d'essai des utilisateurs
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->users as $key => $user) {
            /** @var User $thisUser */
            $thisUser = new User();
            $thisUser->addRole($user['role'])
                ->setCivility($user['civility'])
                ->setFirstName($user['firstName'])
                ->setlastName($user['lastName'])
                ->setEmail($user['email'])
                ->setUsername($user['username'])
                ->setPlainPassword($user['password'])
                ->setEnabled($user['enabled']);
            $manager->persist($thisUser);
            $this->setReference('user-'.$key, $thisUser);
        }
        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}
