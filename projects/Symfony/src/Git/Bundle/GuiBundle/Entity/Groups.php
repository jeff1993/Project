<?php

namespace Git\Bundle\GuiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groups
 */
class Groups
{
    /**
     * @var integer
     */
    private $group_id;
    
    /**
     * @var integer
     */
    private $ref_id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var boolean
     */
    private $permRead;

    /**
     * @var boolean
     */
    private $permWrite;

    /**
     * @var boolean
     */
    private $permManage;

    /**
     * @var boolean
     */
    private $permDelete;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->group_id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Groups
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set permRead
     *
     * @param boolean $permRead
     * @return Groups
     */
    public function setRead($permRead)
    {
        $this->permRead = $permRead;
    
        return $this;
    }

    /**
     * Get permRead
     *
     * @return boolean 
     */
    public function getRead()
    {
        return $this->permRead;
    }

    /**
     * Set permWrite
     *
     * @param boolean $permWrite
     * @return Groups
     */
    public function setWrite($permWrite)
    {
        $this->permWrite = $permWrite;
    
        return $this;
    }

    /**
     * Get permWrite
     *
     * @return boolean 
     */
    public function getWrite()
    {
        return $this->permWrite;
    }

    /**
     * Set permManage
     *
     * @param boolean $permManage
     * @return Groups
     */
    public function setManage($permManage)
    {
        $this->permManage = $permManage;
    
        return $this;
    }

    /**
     * Get permManage
     *
     * @return boolean 
     */
    public function getManage()
    {
        return $this->permManage;
    }
    
    
    public function getRefID()
    {
        return $this->ref_id;
    }


    /**
     * Set permDelete
     *
     * @param boolean $permDelete
     * @return Groups
     */
    public function setDelete($permDelete)
    {
        $this->permDelete = $permDelete;
    
        return $this;
    }

    /**
     * Get permDelete
     *
     * @return boolean 
     */
    public function getDelete()
    {
        return $this->permDelete;
    }
}
