<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200808232929 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE predictions ADD predict_id INT DEFAULT NULL, DROP predict');
        $this->addSql('ALTER TABLE predictions ADD CONSTRAINT FK_8E87BCE6A050B872 FOREIGN KEY (predict_id) REFERENCES victories (id)');
        $this->addSql('CREATE INDEX IDX_8E87BCE6A050B872 ON predictions (predict_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE predictions DROP FOREIGN KEY FK_8E87BCE6A050B872');
        $this->addSql('DROP INDEX IDX_8E87BCE6A050B872 ON predictions');
        $this->addSql('ALTER TABLE predictions ADD predict INT NOT NULL, DROP predict_id');
    }
}
