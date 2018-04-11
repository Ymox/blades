<?php

namespace App\Listener;

use App\Entity\Blade;
use App\Entity\WeaponLevel;
use Doctrine\ORM\Event\LifecycleEventArgs;

class BladeListener
{
    public function createWeaponLevel(Blade $blade, LifecycleEventArgs $event)
    {
        $em = $event->getEntityManager();
        $weaponLevelRepository = $em->getRepository(WeaponLevel::class);
        if (!($weaponLevel = $weaponLevelRepository->findOneBy(array(
            'driver' => $blade->getDriver(),
            'weapon' => $blade->getWeapon(),
        )))) {
            $weaponLevel = (new WeaponLevel())
                ->setDriver($blade->getDriver())
                ->setWeapon($blade->getWeapon())
            ;
            $em->persist($weaponLevel);
        }
    }
}