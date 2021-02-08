<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210208130856 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE oeuvre DROP FOREIGN KEY FK_35FE2EFE3F0A9AF5');
        $this->addSql('DROP INDEX IDX_35FE2EFE3F0A9AF5 ON oeuvre');
        $this->addSql('ALTER TABLE oeuvre ADD updated_at DATETIME NOT NULL, ADD image_name VARCHAR(255) DEFAULT NULL, ADD image_original_name VARCHAR(255) DEFAULT NULL, ADD image_mime_type VARCHAR(255) DEFAULT NULL, ADD image_dimensions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', CHANGE couverture_id image_size INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE oeuvre DROP updated_at, DROP image_name, DROP image_original_name, DROP image_mime_type, DROP image_dimensions, CHANGE image_size couverture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE oeuvre ADD CONSTRAINT FK_35FE2EFE3F0A9AF5 FOREIGN KEY (couverture_id) REFERENCES fichier (id)');
        $this->addSql('CREATE INDEX IDX_35FE2EFE3F0A9AF5 ON oeuvre (couverture_id)');
    }
}
