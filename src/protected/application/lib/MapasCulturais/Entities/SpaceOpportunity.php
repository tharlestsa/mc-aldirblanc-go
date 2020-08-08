<?php
namespace MapasCulturais\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\entity(repositoryClass="MapasCulturais\Repository")
 */
class SpaceOpportunity extends Opportunity{

    /**
     * @var \MapasCulturais\Entities\Space
     *
     * @ORM\ManyToOne(targetEntity="MapasCulturais\Entities\Space")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id")
     */
    protected $ownerEntity;

    /**
     * @var \MapasCulturais\Entities\SpaceOpportunity
     *
     * @ORM\ManyToOne(targetEntity="MapasCulturais\Entities\SpaceOpportunity", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     */
    protected $parent;
    
    public function getSpecializedClassName() {
        return get_class();
    }
}