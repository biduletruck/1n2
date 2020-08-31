<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200831120403 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bbq_event ADD new_bbq_id INT NOT NULL');
        $this->addSql('ALTER TABLE bbq_event ADD CONSTRAINT FK_4C19864DA515C82E FOREIGN KEY (new_bbq_id) REFERENCES bbq_event (id)');
        $this->addSql('CREATE INDEX IDX_4C19864DA515C82E ON bbq_event (new_bbq_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bbq_event DROP FOREIGN KEY FK_4C19864DA515C82E');
        $this->addSql('DROP INDEX IDX_4C19864DA515C82E ON bbq_event');
        $this->addSql('ALTER TABLE bbq_event DROP new_bbq_id');
    }
}
