<?php

namespace MapasCulturais\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="role")
 * @ORM\Entity
 * @ORM\entity(repositoryClass="MapasCulturais\Repository")
 */
class Role extends \MapasCulturais\Entity{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="role_id_seq", allocationSize=1, initialValue=1)
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=32, nullable=false)
     */
    protected $name;

    /**
     * @var \MapasCulturais\Entities\User
     *
     * @ORM\ManyToOne(targetEntity="MapasCulturais\Entities\User", cascade="persist", )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usr_id", referencedColumnName="id", nullable=false)
     * })
     */
    protected $user;

    /**
     * @var int
     * 
     * @TODO: REMOVER ESTE MAPEAMENTO
     *
     * @ORM\Column(name="subsite_id", type="integer", length=32, nullable=true)
     */
    protected $subsiteId;
    
    /**
     * @var \MapasCulturais\Entities\Subsite
     *
     * @ORM\ManyToOne(targetEntity="MapasCulturais\Entities\Subsite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="subsite_id", referencedColumnName="id", nullable=true)
     * })
     */
    protected $subsite;
    
    
    function setSubsiteId($subsite_id){
        if($subsite_id){
            $subsite = \MapasCulturais\App::i()->repo('Subsite')->find($subsite_id);
            
            if($subsite){
                $this->subsite = $subsite;
            } else {
                $subsite_id = null;
            }
        }
        
        $this->subsiteId = $subsite_id;
    }
    
    function setSubsite($subsite){
        if($subsite instanceof Subsite){
            $this->subsiteId = $subsite->id;
        } else {
            $this->subsiteId = null;
            $subsite = null;
        }
        
        $this->subsite = $subsite;
    }
    
    //============================================================= //
    // The following lines ara used by MapasCulturais hook system.
    // Please do not change them.
    // ============================================================ //

    /** @ORM\PrePersist */
    public function prePersist($args = null){ parent::prePersist($args); }
    /** @ORM\PostPersist */
    public function postPersist($args = null){ parent::postPersist($args); }

    /** @ORM\PreRemove */
    public function preRemove($args = null){ parent::preRemove($args); }
    /** @ORM\PostRemove */
    public function postRemove($args = null){ parent::postRemove($args); }

    /** @ORM\PreUpdate */
    public function preUpdate($args = null){ parent::preUpdate($args); }
    /** @ORM\PostUpdate */
    public function postUpdate($args = null){ parent::postUpdate($args); }
}
