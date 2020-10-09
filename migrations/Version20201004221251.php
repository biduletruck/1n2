<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201004221251 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cheques (id INT AUTO_INCREMENT NOT NULL, nom_cheque VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE colis (id INT AUTO_INCREMENT NOT NULL, nom_colis VARCHAR(255) NOT NULL, description_colis LONGTEXT NOT NULL, reference_colis VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE noel (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, choix_colis_id INT DEFAULT NULL, choix_cheque_id INT DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_E5B861A0A76ED395 (user_id), INDEX IDX_E5B861A064D99810 (choix_colis_id), INDEX IDX_E5B861A070484506 (choix_cheque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE noel ADD CONSTRAINT FK_E5B861A0A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE noel ADD CONSTRAINT FK_E5B861A064D99810 FOREIGN KEY (choix_colis_id) REFERENCES colis (id)');
        $this->addSql('ALTER TABLE noel ADD CONSTRAINT FK_E5B861A070484506 FOREIGN KEY (choix_cheque_id) REFERENCES cheques (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE noel DROP FOREIGN KEY FK_E5B861A070484506');
        $this->addSql('ALTER TABLE noel DROP FOREIGN KEY FK_E5B861A064D99810');
        $this->addSql('DROP TABLE cheques');
        $this->addSql('DROP TABLE colis');
        $this->addSql('DROP TABLE noel');
    }
}
