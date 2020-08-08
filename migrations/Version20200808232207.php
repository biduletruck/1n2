<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200808232207 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE victories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE matches ADD victory_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matches ADD CONSTRAINT FK_62615BA5BD90422 FOREIGN KEY (victory_id) REFERENCES victories (id)');
        $this->addSql('CREATE INDEX IDX_62615BA5BD90422 ON matches (victory_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matches DROP FOREIGN KEY FK_62615BA5BD90422');
        $this->addSql('DROP TABLE victories');
        $this->addSql('DROP INDEX IDX_62615BA5BD90422 ON matches');
        $this->addSql('ALTER TABLE matches DROP victory_id');
    }
}
