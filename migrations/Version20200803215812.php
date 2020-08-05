<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200803215812 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matches ADD home_id INT NOT NULL, ADD visitor_id INT NOT NULL, DROP home, DROP visitor');
        $this->addSql('ALTER TABLE matches ADD CONSTRAINT FK_62615BA28CDC89C FOREIGN KEY (home_id) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE matches ADD CONSTRAINT FK_62615BA70BEE6D FOREIGN KEY (visitor_id) REFERENCES teams (id)');
        $this->addSql('CREATE INDEX IDX_62615BA28CDC89C ON matches (home_id)');
        $this->addSql('CREATE INDEX IDX_62615BA70BEE6D ON matches (visitor_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matches DROP FOREIGN KEY FK_62615BA28CDC89C');
        $this->addSql('ALTER TABLE matches DROP FOREIGN KEY FK_62615BA70BEE6D');
        $this->addSql('DROP INDEX IDX_62615BA28CDC89C ON matches');
        $this->addSql('DROP INDEX IDX_62615BA70BEE6D ON matches');
        $this->addSql('ALTER TABLE matches ADD home VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD visitor VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP home_id, DROP visitor_id');
    }
}
