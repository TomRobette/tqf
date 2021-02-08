<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210208125743 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE biblio DROP FOREIGN KEY FK_D90CBB253DA5256D');
        $this->addSql('DROP INDEX IDX_D90CBB253DA5256D ON biblio');
        $this->addSql('ALTER TABLE biblio ADD updated_at DATETIME NOT NULL, ADD image_name VARCHAR(255) DEFAULT NULL, ADD image_original_name VARCHAR(255) DEFAULT NULL, ADD image_mime_type VARCHAR(255) DEFAULT NULL, ADD image_dimensions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', CHANGE image_id image_size INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE biblio DROP updated_at, DROP image_name, DROP image_original_name, DROP image_mime_type, DROP image_dimensions, CHANGE image_size image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE biblio ADD CONSTRAINT FK_D90CBB253DA5256D FOREIGN KEY (image_id) REFERENCES fichier (id)');
        $this->addSql('CREATE INDEX IDX_D90CBB253DA5256D ON biblio (image_id)');
    }
}
