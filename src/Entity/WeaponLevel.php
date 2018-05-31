<?php

namespace App\Entity;

/**
 * WeaponLevel
 */
class WeaponLevel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $x = 1;

    /**
     * @var int
     */
    private $y = 1;

    /**
     * @var int
     */
    private $b = 1;

    /**
     * @var int
     */
    private $chain = 1;

    /**
     * @var \App\Entity\Driver
     */
    private $driver;

    /**
     * @var \App\Entity\Weapon
     */
    private $weapon;


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
     * Set x.
     *
     * @param int $x
     *
     * @return WeaponLevel
     */
    public function setX($x)
    {
        $this->x = $x;

        return $this;
    }

    /**
     * Get x.
     *
     * @return int
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set y.
     *
     * @param int $y
     *
     * @return WeaponLevel
     */
    public function setY($y)
    {
        $this->y = $y;

        return $this;
    }

    /**
     * Get y.
     *
     * @return int
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Set b.
     *
     * @param int $b
     *
     * @return WeaponLevel
     */
    public function setB($b)
    {
        $this->b = $b;

        return $this;
    }

    /**
     * Get b.
     *
     * @return int
     */
    public function getB()
    {
        return $this->b;
    }

    /**
     * Set chain.
     *
     * @param int $chain
     *
     * @return WeaponLevel
     */
    public function setChain($chain)
    {
        $this->chain = $chain;

        return $this;
    }

    /**
     * Get chain.
     *
     * @return int
     */
    public function getChain()
    {
        return $this->chain;
    }

    /**
     * Set driver.
     *
     * @param \App\Entity\Driver|null $driver
     *
     * @return WeaponLevel
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

    /**
     * Set weapon.
     *
     * @param \App\Entity\Weapon|null $weapon
     *
     * @return WeaponLevel
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

    public function getName()
    {
        return $this->weapon->getName();
    }

    public function getArts()
    {
        return array(
            'x'     => $this->getX(),
            'y'     => $this->getY(),
            'b'     => $this->getB(),
            'chain' => $this->getCHain(),
        );
    }

    public function setArt($item, $level)
    {
        switch ($item) {
            case 'x':
                $this->setX($level);
                break;
            case 'y':
                $this->setY($level);
                break;
            case 'b':
                $this->setB($level);
                break;
            case 'chain':
                $this->setChain($level);
                break;
        }

        return $this;
    }
}
