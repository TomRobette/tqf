<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210208133958 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auteur DROP FOREIGN KEY FK_55AB1403DA5256D');
        $this->addSql('DROP INDEX IDX_55AB1403DA5256D ON auteur');
        $this->addSql('ALTER TABLE auteur ADD updated_at DATETIME NOT NULL, ADD image_name VARCHAR(255) DEFAULT NULL, ADD image_original_name VARCHAR(255) DEFAULT NULL, ADD image_mime_type VARCHAR(255) DEFAULT NULL, ADD image_dimensions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', CHANGE image_id image_size INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auteur DROP updated_at, DROP image_name, DROP image_original_name, DROP image_mime_type, DROP image_dimensions, CHANGE image_size image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE auteur ADD CONSTRAINT FK_55AB1403DA5256D FOREIGN KEY (image_id) REFERENCES fichier (id)');
        $this->addSql('CREATE INDEX IDX_55AB1403DA5256D ON auteur (image_id)');
    }
}
