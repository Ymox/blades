<?php

namespace App\Entity;

/**
 * Blade
 */
class Blade
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
     * @var int
     */
    private $rareness;

    /**
     * @var string
     */
    private $class;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var int
     */
    private $strength;

    /**
     * @var int
     */
    private $trustLevel;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $skills;

    /**
     * @var \App\Entity\Element
     */
    private $element;

    /**
     * @var \App\Entity\Weapon
     */
    private $weapon;

    /**
     * @var \App\Entity\Driver
     */
    private $driver;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->skills = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Blade
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
     * Set rareness.
     *
     * @param int $rareness
     *
     * @return Blade
     */
    public function setRareness($rareness)
    {
        $this->rareness = $rareness;

        return $this;
    }

    /**
     * Get rareness.
     *
     * @return int
     */
    public function getRareness()
    {
        return $this->rareness;
    }

    /**
     * Set class.
     *
     * @param string $class
     *
     * @return Blade
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class.
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set gender.
     *
     * @param string $gender
     *
     * @return Blade
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender.
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set strength.
     *
     * @param int $strength
     *
     * @return Blade
     */
    public function setStrength($strength)
    {
        $this->strength = $strength;

        return $this;
    }

    /**
     * Get strength.
     *
     * @return int
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * Set trustLevel.
     *
     * @param int $trustLevel
     *
     * @return Blade
     */
    public function setTrustLevel($trustLevel)
    {
        $this->trustLevel = $trustLevel;

        return $this;
    }

    /**
     * Get trustLevel.
     *
     * @return int
     */
    public function getTrustLevel()
    {
        return $this->trustLevel;
    }

    /**
     * Add skill.
     *
     * @param \App\Entity\SkillLevel $skill
     *
     * @return Blade
     */
    public function addSkill(\App\Entity\SkillLevel $skill)
    {
        $skill->setBlade($this);
        $this->skills[] = $skill;

        return $this;
    }

    /**
     * Remove skill.
     *
     * @param \App\Entity\SkillLevel $skill
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeSkill(\App\Entity\SkillLevel $skill)
    {
        return $this->skills->removeElement($skill);
    }

    /**
     * Get skills.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * Set element.
     *
     * @param \App\Entity\Element|null $element
     *
     * @return Blade
     */
    public function setElement(\App\Entity\Element $element = null)
    {
        $this->element = $element;

        return $this;
    }

    /**
     * Get element.
     *
     * @return \App\Entity\Element|null
     */
    public function getElement()
    {
        return $this->element;
    }

    /**
     * Set weapon.
     *
     * @param \App\Entity\Weapon|null $weapon
     *
     * @return Blade
     */
    public function setWeapon(\App\Entity\Weapon $weapon = null)
    {
        $this->weapon = $weapon;

        return $this;
    }

    /**
     * Get weapon.
     *
     * @return \App\Entity\Weapon|null
     */
    public function getWeapon()
    {
        return $this->weapon;
    }

    /**
     * Set driver.
     *
     * @param \App\Entity\Driver|null $driver
     *
     * @return Blade
     */
    public function setDriver(\App\Entity\Driver $driver = null)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Get driver.
     *
     * @return \App\Entity\Driver|null
     */
    public function getDriver()
    {
        return $this->driver;
    }
}
