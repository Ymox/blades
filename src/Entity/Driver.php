<?php

namespace App\Entity;

/**
 * Driver
 */
class Driver
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $blades;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $weaponLevels;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->blades = new \Doctrine\Common\Collections\ArrayCollection();
        $this->weaponLevels = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Driver
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add blade.
     *
     * @param \App\Entity\Blade $blade
     *
     * @return Driver
     */
    public function addBlade(\App\Entity\Blade $blade)
    {
        $this->blades[] = $blade;

        return $this;
    }

    /**
     * Remove blade.
     *
     * @param \App\Entity\Blade $blade
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeBlade(\App\Entity\Blade $blade)
    {
        return $this->blades->removeElement($blade);
    }

    /**
     * Get blades.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBlades()
    {
        return $this->blades;
    }

    /**
     * Add weaponLevel.
     *
     * @param \App\Entity\WeaponLevel $weaponLevel
     *
     * @return Driver
     */
    public function addWeaponLevel(\App\Entity\WeaponLevel $weaponLevel)
    {
        $this->weaponLevels[] = $weaponLevel;

        return $this;
    }

    /**
     * Remove weaponLevel.
     *
     * @param \App\Entity\WeaponLevel $weaponLevel
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeWeaponLevel(\App\Entity\WeaponLevel $weaponLevel)
    {
        return $this->weaponLevels->removeElement($weaponLevel);
    }

    /**
     * Get weaponLevels.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWeaponLevels()
    {
        return $this->weaponLevels;
    }
}
