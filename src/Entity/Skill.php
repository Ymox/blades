<?php

namespace App\Entity;

/**
 * Skill
 */
class Skill
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

//     public $level;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $blades;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->blades = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Skill
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
     * @param \App\Entity\SkillLevel $blade
     *
     * @return Skill
     */
    public function addBlade(\App\Entity\SkillLevel $blade)
    {
        $this->blades[] = $blade;

        return $this;
    }

    /**
     * Remove blade.
     *
     * @param \App\Entity\SkillLevel $blade
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeBlade(\App\Entity\SkillLevel $blade)
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
}
