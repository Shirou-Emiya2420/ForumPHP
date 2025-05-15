<?php
namespace Model\Entities;

use App\Entity;

final class Topic extends Entity {

    private int $id;
    private string $title;
    private \DateTime $creationDate;
    private $user;         // instance de User
    private $category;     // instance de Category
    private bool $isClose;

    public function __construct($data) {
        $this->hydrate($data);
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title): self {
        $this->title = $title;
        return $this;
    }

    public function getCreationDate(): \DateTime {
        return $this->creationDate;
    }

    public function setCreationDate($date): self {
        if (!$date instanceof \DateTime) {
            $date = new \DateTime($date);
        }
        $this->creationDate = $date;
        return $this;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user): self {
        $this->user = $user;
        return $this;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category): self {
        $this->category = $category;
        return $this;
    }

    public function getIsClosed(): bool {
        return $this->isClose;
    }

    public function setIsClose($value): self {
        $this->isClose = (bool)$value;
        return $this;
    }

    public function __toString(): string {
        return $this->title;
    }
}
