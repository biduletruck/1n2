<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201014124404 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answers (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, wording LONGTEXT NOT NULL, INDEX IDX_50D0C6061E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE answers_choices (answers_id INT NOT NULL, choices_id INT NOT NULL, INDEX IDX_3209079679BF1BCE (answers_id), INDEX IDX_32090796163CD901 (choices_id), PRIMARY KEY(answers_id, choices_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE choices (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, participation_id INT DEFAULT NULL, INDEX IDX_5CE96391E27F6BF (question_id), INDEX IDX_5CE96396ACE3B73 (participation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participations (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, poll_id INT DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_FDC6C6E8A76ED395 (user_id), INDEX IDX_FDC6C6E83C947C0F (poll_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE polls (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questions (id INT AUTO_INCREMENT NOT NULL, poll_id INT DEFAULT NULL, wording LONGTEXT NOT NULL, INDEX IDX_8ADC54D53C947C0F (poll_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C6061E27F6BF FOREIGN KEY (question_id) REFERENCES questions (id)');
        $this->addSql('ALTER TABLE answers_choices ADD CONSTRAINT FK_3209079679BF1BCE FOREIGN KEY (answers_id) REFERENCES answers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE answers_choices ADD CONSTRAINT FK_32090796163CD901 FOREIGN KEY (choices_id) REFERENCES choices (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE choices ADD CONSTRAINT FK_5CE96391E27F6BF FOREIGN KEY (question_id) REFERENCES questions (id)');
        $this->addSql('ALTER TABLE choices ADD CONSTRAINT FK_5CE96396ACE3B73 FOREIGN KEY (participation_id) REFERENCES participations (id)');
        $this->addSql('ALTER TABLE participations ADD CONSTRAINT FK_FDC6C6E8A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE participations ADD CONSTRAINT FK_FDC6C6E83C947C0F FOREIGN KEY (poll_id) REFERENCES polls (id)');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D53C947C0F FOREIGN KEY (poll_id) REFERENCES polls (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answers_choices DROP FOREIGN KEY FK_3209079679BF1BCE');
        $this->addSql('ALTER TABLE answers_choices DROP FOREIGN KEY FK_32090796163CD901');
        $this->addSql('ALTER TABLE choices DROP FOREIGN KEY FK_5CE96396ACE3B73');
        $this->addSql('ALTER TABLE participations DROP FOREIGN KEY FK_FDC6C6E83C947C0F');
        $this->addSql('ALTER TABLE questions DROP FOREIGN KEY FK_8ADC54D53C947C0F');
        $this->addSql('ALTER TABLE answers DROP FOREIGN KEY FK_50D0C6061E27F6BF');
        $this->addSql('ALTER TABLE choices DROP FOREIGN KEY FK_5CE96391E27F6BF');
        $this->addSql('DROP TABLE answers');
        $this->addSql('DROP TABLE answers_choices');
        $this->addSql('DROP TABLE choices');
        $this->addSql('DROP TABLE participations');
        $this->addSql('DROP TABLE polls');
        $this->addSql('DROP TABLE questions');
    }
}
