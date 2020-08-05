<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200803205457 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE matches (id INT AUTO_INCREMENT NOT NULL, home VARCHAR(255) NOT NULL, visitor VARCHAR(255) NOT NULL, start_time DATETIME NOT NULL, home_result INT DEFAULT NULL, visitor_result INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE predictions (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, user_id INT NOT NULL, created_at DATETIME NOT NULL, predict INT NOT NULL, home_result INT NOT NULL, visitor_result INT NOT NULL, INDEX IDX_8E87BCE6E48FD905 (game_id), INDEX IDX_8E87BCE6A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teams (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE predictions ADD CONSTRAINT FK_8E87BCE6E48FD905 FOREIGN KEY (game_id) REFERENCES matches (id)');
        $this->addSql('ALTER TABLE predictions ADD CONSTRAINT FK_8E87BCE6A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE predictions DROP FOREIGN KEY FK_8E87BCE6E48FD905');
        $this->addSql('ALTER TABLE predictions DROP FOREIGN KEY FK_8E87BCE6A76ED395');
        $this->addSql('DROP TABLE matches');
        $this->addSql('DROP TABLE predictions');
        $this->addSql('DROP TABLE teams');
        $this->addSql('DROP TABLE users');
    }
}
