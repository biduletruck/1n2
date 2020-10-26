<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201025131140 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE halloween (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, created_at DATETIME NOT NULL, quest1 INT DEFAULT NULL, quest2 INT DEFAULT NULL, quest3 INT DEFAULT NULL, quest4 INT DEFAULT NULL, quest5 INT DEFAULT NULL, quest6 INT DEFAULT NULL, quest7 INT DEFAULT NULL, quest8 INT DEFAULT NULL, quest9 INT DEFAULT NULL, quest10 INT DEFAULT NULL, INDEX IDX_3FC5DC48A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE halloween ADD CONSTRAINT FK_3FC5DC48A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE halloween');
    }
}
