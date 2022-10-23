<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221023121929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cheque21 (id INT AUTO_INCREMENT NOT NULL, title_cheque VARCHAR(255) NOT NULL, description_cheque LONGTEXT NOT NULL, image_cheque VARCHAR(255) NOT NULL, profile TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande21 (id INT AUTO_INCREMENT NOT NULL, salarie_id INT NOT NULL, package_id INT NOT NULL, cheque_id INT NOT NULL, created_at DATETIME NOT NULL, email_salarie VARCHAR(255) DEFAULT NULL, INDEX IDX_585329385859934A (salarie_id), INDEX IDX_58532938F44CABFF (package_id), INDEX IDX_585329383DD3DB4B (cheque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE package21 (id INT AUTO_INCREMENT NOT NULL, title_package VARCHAR(255) NOT NULL, ref_package VARCHAR(255) NOT NULL, description_package LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande21 ADD CONSTRAINT FK_585329385859934A FOREIGN KEY (salarie_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE commande21 ADD CONSTRAINT FK_58532938F44CABFF FOREIGN KEY (package_id) REFERENCES package21 (id)');
        $this->addSql('ALTER TABLE commande21 ADD CONSTRAINT FK_585329383DD3DB4B FOREIGN KEY (cheque_id) REFERENCES cheque21 (id)');
        $this->addSql('ALTER TABLE ancv2022 ADD ancien INT NOT NULL');
        $this->addSql('ALTER TABLE questions ADD picture VARCHAR(255) DEFAULT NULL, ADD difficulty INT NOT NULL');
        $this->addSql('ALTER TABLE teams ADD thumbnail VARCHAR(100) NOT NULL, ADD updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande21 DROP FOREIGN KEY FK_585329383DD3DB4B');
        $this->addSql('ALTER TABLE commande21 DROP FOREIGN KEY FK_58532938F44CABFF');
        $this->addSql('DROP TABLE cheque21');
        $this->addSql('DROP TABLE commande21');
        $this->addSql('DROP TABLE package21');
        $this->addSql('ALTER TABLE ancv2022 DROP ancien');
        $this->addSql('ALTER TABLE questions DROP picture, DROP difficulty');
        $this->addSql('ALTER TABLE teams DROP thumbnail, DROP updated_at');
    }
}
