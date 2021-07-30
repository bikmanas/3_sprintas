<?php

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="projects")
 */
class Project
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $project_id;
    /** 
     * @ORM\Column(type="string") 
     */
    protected $project_name;
    /** 
     * @ORM\Column(type="string") 
     */
    protected $project_deadline;

    /**
     * One employee has many projects. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Employee", mappedBy="project_id")
     */
    protected $team;

    public function getTeam()
    {
        return $this->team;
    }

    public function getID()
    {
        return $this->project_id;
    }
    public function setName($project_name)
    {
        $this->project_name = $project_name;
    }
    public function getName()
    {
        return $this->project_name;
    }
    public function setDeadline($project_deadline)
    {
        $this->project_deadline = $project_deadline;
    }
    public function getDeadline()
    {
        return $this->project_deadline;
    }
}
