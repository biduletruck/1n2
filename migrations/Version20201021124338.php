<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201021124338 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE choices_answers (choices_id INT NOT NULL, answers_id INT NOT NULL, INDEX IDX_D100DC9F163CD901 (choices_id), INDEX IDX_D100DC9F79BF1BCE (answers_id), PRIMARY KEY(choices_id, answers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE choices_answers ADD CONSTRAINT FK_D100DC9F163CD901 FOREIGN KEY (choices_id) REFERENCES choices (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE choices_answers ADD CONSTRAINT FK_D100DC9F79BF1BCE FOREIGN KEY (answers_id) REFERENCES answers (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE answers_choices');
        $this->addSql('ALTER TABLE participations DROP created_at');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answers_choices (answers_id INT NOT NULL, choices_id INT NOT NULL, INDEX IDX_3209079679BF1BCE (answers_id), INDEX IDX_32090796163CD901 (choices_id), PRIMARY KEY(answers_id, choices_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE answers_choices ADD CONSTRAINT FK_32090796163CD901 FOREIGN KEY (choices_id) REFERENCES choices (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE answers_choices ADD CONSTRAINT FK_3209079679BF1BCE FOREIGN KEY (answers_id) REFERENCES answers (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE choices_answers');
        $this->addSql('ALTER TABLE participations ADD created_at DATETIME NOT NULL');
    }
}
