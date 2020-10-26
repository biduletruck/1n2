<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201023084528 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answers ADD answer_number INT NOT NULL');
        $this->addSql('ALTER TABLE choices ADD created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE questions ADD question_number INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answers DROP answer_number');
        $this->addSql('ALTER TABLE choices DROP created_at');
        $this->addSql('ALTER TABLE questions DROP question_number');
    }
}
