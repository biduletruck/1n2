<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200831114937 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bbq (id INT AUTO_INCREMENT NOT NULL, createdby_id INT DEFAULT NULL, event VARCHAR(255) NOT NULL, date_event DATETIME NOT NULL, description LONGTEXT DEFAULT NULL, date_limit DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_C4DB8ED3F0B5AF0B (createdby_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bbq_event (id INT AUTO_INCREMENT NOT NULL, salarie_id INT NOT NULL, bbq_id INT NOT NULL, conjoint TINYINT(1) NOT NULL, nombre_enfants INT DEFAULT NULL, INDEX IDX_4C19864D5859934A (salarie_id), INDEX IDX_4C19864D5D8FF004 (bbq_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bbq ADD CONSTRAINT FK_C4DB8ED3F0B5AF0B FOREIGN KEY (createdby_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE bbq_event ADD CONSTRAINT FK_4C19864D5859934A FOREIGN KEY (salarie_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE bbq_event ADD CONSTRAINT FK_4C19864D5D8FF004 FOREIGN KEY (bbq_id) REFERENCES bbq_event (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bbq_event DROP FOREIGN KEY FK_4C19864D5D8FF004');
        $this->addSql('DROP TABLE bbq');
        $this->addSql('DROP TABLE bbq_event');
    }
}
