<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/** An article */
#[ORM\Entity]
#[UniqueEntity('slug')]
#[ApiResource]
class Article
{
    /** The ID of this article. */
    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    private ?int $id = null;

    /** The title of this article. */
    #[ORM\Column(type: 'string', length: 255)]
    public string $title = '';

    /** The description of this article. */
    #[ORM\Column(type: 'string', length: 255)]
    public string $description = '';

    /** The content of this article. */
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    public string $content = '';

    /** The author of this article. */
    #[ORM\Column(type: 'string', length: 255)]
    public string $author = '';

    /** The slug of this article. */
    #[ORM\Column(type: 'string', length: 255, unique: true)]
    public string $slug = '';

    /** The state of this article. */
    #[ORM\Column(type: 'string', length: 255)]
    public string $stat = '';

    /** The tags of this article. */
    #[ORM\Column]
    public array $tags = [];

    /** The publication date of this article. */
    #[ORM\Column(nullable: true)]
    public ?\DateTimeImmutable $publicationDate = null;

    /** The creation date of this article. */
    #[ORM\Column]
    public \DateTimeImmutable $created_at;

    /** The last update of this article. */
    #[ORM\Column(nullable: true)]
    public ?\DateTimeImmutable $updated_at = null;


    /** @var Review[] Available reviews for this article. */
    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Review::class, cascade: ['persist', 'remove'])]
    public iterable $reviews;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }



}
