<?php

namespace App\Entity;

/**
 * Weapon
 */
class Weapon
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
    private $levels;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->blades = new \Doctrine\Common\Collections\ArrayCollection();
        $this->levels = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Weapon
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
     * @return Weapon
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
     * Add level.
     *
     * @param \App\Entity\WeaponLevel $level
     *
     * @return Weapon
     */
    public function addLevel(\App\Entity\WeaponLevel $level)
    {
        $this->levels[] = $level;

        return $this;
    }

    /**
     * Remove level.
     *
     * @param \App\Entity\WeaponLevel $level
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeLevel(\App\Entity\WeaponLevel $level)
    {
        return $this->levels->removeElement($level);
    }

    /**
     * Get levels.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLevels()
    {
        return $this->levels;
    }
}
