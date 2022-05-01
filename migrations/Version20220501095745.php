<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220501095745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ancv2022 (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, activated TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ancv2022commande (id INT AUTO_INCREMENT NOT NULL, cheque_id INT DEFAULT NULL, user_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_890323BC3DD3DB4B (cheque_id), INDEX IDX_890323BCA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ancv2022commande ADD CONSTRAINT FK_890323BC3DD3DB4B FOREIGN KEY (cheque_id) REFERENCES ancv2022 (id)');
        $this->addSql('ALTER TABLE ancv2022commande ADD CONSTRAINT FK_890323BCA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ancv2022commande DROP FOREIGN KEY FK_890323BC3DD3DB4B');
        $this->addSql('DROP TABLE ancv2022');
        $this->addSql('DROP TABLE ancv2022commande');
    }
}
