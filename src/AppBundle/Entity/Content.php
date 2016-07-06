<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Content
 *
 * @ORM\Table(name="content")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContentRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Content
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", nullable=true)
     */
    private $value;

    /**
     * @var boolean
     *
     * @ORM\Column(name="collapsed", type="boolean")
     */
    private $collapsed = false;

    /**
     * @ORM\ManyToOne(targetEntity="Subject")
     */
    private $subject;

    /**
     * @var integer
     *
     * @ORM\Column(name="block", type="integer", nullable=true)
     */
    private $block = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="content_order", type="integer", nullable=true)
     */
    private $order;

    /**
     * @var string
     *
     * @ORM\Column(name="content_class", type="string", length=255, nullable=true)
     */
    private $contentClass = 'panel-default';

    /**
     * @var User $createdBy
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Content
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return Content
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set subject
     *
     * @param \AppBundle\Entity\Subject $subject
     * @return Content
     */
    public function setSubject(\AppBundle\Entity\Subject $subject = null)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return \AppBundle\Entity\Subject 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set createdBy
     *
     * @param \AppBundle\Entity\User $createdBy
     * @return Content
     */
    public function setCreatedBy(\AppBundle\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \AppBundle\Entity\User 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     * @return Content
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime 
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set collapsed
     *
     * @param boolean $collapsed
     * @return Content
     */
    public function setCollapsed($collapsed)
    {
        $this->collapsed = $collapsed;

        return $this;
    }

    /**
     * Get collapsed
     *
     * @return boolean 
     */
    public function isCollapsed()
    {
        return $this->collapsed;
    }

    /**
     * Get collapsed
     *
     * @return boolean 
     */
    public function getCollapsed()
    {
        return $this->collapsed;
    }

    /**
     * Set block
     *
     * @param $block
     * @return Content
     */
    public function setBlock($block)
    {
        $this->block = $block;

        return $this;
    }

    /**
     * Get block
     *
     * @return \integet 
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * Set order
     *
     * @param integer $order
     * @return Content
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set contentClass
     *
     * @param string $contentClass
     * @return Content
     */
    public function setContentClass($contentClass)
    {
        $this->contentClass = $contentClass;

        return $this;
    }

    /**
     * Get contentClass
     *
     * @return string 
     */
    public function getContentClass()
    {
        return $this->contentClass;
    }
}
