<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200831235130 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE bbq');
        $this->addSql('ALTER TABLE bbq_event ADD reglement TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bbq (id INT AUTO_INCREMENT NOT NULL, createdby_id INT DEFAULT NULL, event VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_event DATETIME NOT NULL, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, date_limit DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_C4DB8ED3F0B5AF0B (createdby_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE bbq ADD CONSTRAINT FK_C4DB8ED3F0B5AF0B FOREIGN KEY (createdby_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE bbq_event DROP reglement');
    }
}
