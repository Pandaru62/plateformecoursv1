<?php

declare(strict_types=1);

namespace App\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

#[ODM\Document(collection: 'lessonkeys')]
class LessonKeys
{
    #[ODM\Id]
    public ?string $id = null;

    #[ODM\Field]
    public string $sequenceId;

    #[ODM\Field]
    public string $password;

}
