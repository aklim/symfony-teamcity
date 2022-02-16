<?php

namespace App\Entity\Security;

use App\Entity\User;
use App\Repository\Security\ApiTokenRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApiTokenRepository::class)]
class ApiToken
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $token;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $expiresAt;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\User', inversedBy: 'apiTokens')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user;

    public function __construct(User $user)
    {
        $this->token = bin2hex(random_bytes(60));
        $this->user = $user;
        $this->expiresAt = new DateTimeImmutable('+1 hour');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getExpiresAt(): ?DateTimeImmutable
    {
        return $this->expiresAt;
    }

    public function renewExpiresAt(): void
    {
        $this->expiresAt = new DateTimeImmutable('+1 hour');
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }
}
