<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240724051420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document ADD is_archived TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE seance ADD is_archived TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE sequence ADD is_archived TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document DROP is_archived');
        $this->addSql('ALTER TABLE seance DROP is_archived');
        $this->addSql('ALTER TABLE sequence DROP is_archived');
    }
}
