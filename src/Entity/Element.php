<?php

namespace App\Entity;

/**
 * Element
 */
class Element
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
     * @var string
     */
    private $color;

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
     * @return Element
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
     * Set color.
     *
     * @param string $color
     *
     * @return Element
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color.
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Add blade.
     *
     * @param \App\Entity\Blade $blade
     *
     * @return Element
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
}
