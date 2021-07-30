<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="employees")
 */
class Employee
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /** 
     * @ORM\Column(type="string") 
     */
    protected $name;
    /** 
     * @ORM\Column(type="string") 
     */
    protected $surname;
    /**
     * @ORM\Column(type="string")
     */
    protected $role;
    /**
     * Many employees have one project. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="team")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="project_id", onDelete="SET NULL", nullable=true)
     */
    protected $project_id;

    public function getProjectData()
    {
        return $this->project_id;
    }
    public function setProjectID($id)
    {
        $this->project_id = $id;
    }

    public function getID()
    {
        return $this->id;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }
    public function getSurname()
    {
        return $this->surname;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }
    public function getRole()
    {
        return $this->role;
    }
}
