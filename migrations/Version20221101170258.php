<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221101170258 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cpclassement DROP FOREIGN KEY FK_6C5FDF7FD11E3C7');
        $this->addSql('DROP INDEX IDX_6C5FDF7FD11E3C7 ON cpclassement');
        $this->addSql('ALTER TABLE cpclassement CHANGE concours_id concours_photos_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cpclassement ADD CONSTRAINT FK_6C5FDF7FEA8510CA FOREIGN KEY (concours_photos_id) REFERENCES cpconcours_photos (id)');
        $this->addSql('CREATE INDEX IDX_6C5FDF7FEA8510CA ON cpclassement (concours_photos_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cpclassement DROP FOREIGN KEY FK_6C5FDF7FEA8510CA');
        $this->addSql('DROP INDEX IDX_6C5FDF7FEA8510CA ON cpclassement');
        $this->addSql('ALTER TABLE cpclassement CHANGE concours_photos_id concours_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cpclassement ADD CONSTRAINT FK_6C5FDF7FD11E3C7 FOREIGN KEY (concours_id) REFERENCES cpconcours_photos (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6C5FDF7FD11E3C7 ON cpclassement (concours_id)');
    }
}
