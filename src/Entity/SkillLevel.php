<?php

namespace App\Entity;

/**
 * SkillLevel
 */
class SkillLevel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $level;

    /**
     * @var \App\Entity\Blade
     */
    private $blade;

    /**
     * @var \App\Entity\Skill
     */
    private $skill;


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
     * Set level.
     *
     * @param int $level
     *
     * @return SkillLevel
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level.
     *
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set blade.
     *
     * @param \App\Entity\Blade|null $blade
     *
     * @return SkillLevel
     */
    public function setBlade(\App\Entity\Blade $blade = null)
    {
        $this->blade = $blade;

        return $this;
    }

    /**
     * Get blade.
     *
     * @return \App\Entity\Blade|null
     */
    public function getBlade()
    {
        return $this->blade;
    }

    /**
     * Set skill.
     *
     * @param \App\Entity\Skill|null $skill
     *
     * @return SkillLevel
     */
    public function setSkill(\App\Entity\Skill $skill = null)
    {
        $skill->addBlade($this);
        $this->skill = $skill;

        return $this;
    }

    /**
     * Get skill.
     *
     * @return \App\Entity\Skill|null
     */
    public function getSkill()
    {
        return $this->skill;
    }

    public function getName()
    {
        return $this->skill->getName();
    }
}
