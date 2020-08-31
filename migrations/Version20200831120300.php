<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200831120300 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bbq_event DROP FOREIGN KEY FK_4C19864D5D8FF004');
        $this->addSql('DROP INDEX IDX_4C19864D5D8FF004 ON bbq_event');
        $this->addSql('ALTER TABLE bbq_event DROP bbq_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bbq_event ADD bbq_id INT NOT NULL');
        $this->addSql('ALTER TABLE bbq_event ADD CONSTRAINT FK_4C19864D5D8FF004 FOREIGN KEY (bbq_id) REFERENCES bbq_event (id)');
        $this->addSql('CREATE INDEX IDX_4C19864D5D8FF004 ON bbq_event (bbq_id)');
    }
}
