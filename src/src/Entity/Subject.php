<?php

namespace App\Entity;

use App\DomainEvent\SubjectCreated;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;


/**
 * @ORM\Entity(repositoryClass="App\Repository\SubjectRepository")
 */
class Subject implements EntityInterface
{
    use EventGeneratorTrait;

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $data = [];

    /**
     * @Exclude()
     * @ORM\ManyToOne(targetEntity="App\Entity\IpCase", inversedBy="subjects")
     */
    private $ipCase;

    /**
     * Subject constructor.
     * @param array $data
     * @param $IpCase
     */
    public function __construct(IpCase $ipCase, array $data)
    {
        $this->data = $data;
        $this->ipCase = $ipCase;
        $ipCase->addSubject($this);
        $this->raise(new SubjectCreated($this));
    }


    public function getId(): ?string
    {
        return $this->id;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function setData(?array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function setIpCase(?IpCase $ipCase): self
    {
        $this->ipCase = $ipCase;

        return $this;
    }

    public function getIpCase(): IpCase
    {
        return $this->ipCase;
    }
}
