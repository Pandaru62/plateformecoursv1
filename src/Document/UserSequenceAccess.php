<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;


#[ODM\Document(collection: 'user_sequence_access')]

class UserSequenceAccess
{
    #[ODM\Id]
    public ?string $id = null;

    #[ODM\Field]
    public string $userId;

    #[ODM\Field]
    public string $sequenceId;

    // getters and setters
    public function getId(): ?string
    {
        return $this->id;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getSequenceId(): ?string
    {
        return $this->sequenceId;
    }

    public function setSequenceId(string $sequenceId): self
    {
        $this->sequenceId = $sequenceId;
        return $this;
    }
}
