<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210113123730 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fichier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(80) NOT NULL, extension VARCHAR(5) NOT NULL, taille INT NOT NULL, vrai_nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE auteur ADD image_id INT DEFAULT NULL, DROP image');
        $this->addSql('ALTER TABLE auteur ADD CONSTRAINT FK_55AB1403DA5256D FOREIGN KEY (image_id) REFERENCES fichier (id)');
        $this->addSql('CREATE INDEX IDX_55AB1403DA5256D ON auteur (image_id)');
        $this->addSql('ALTER TABLE oeuvre ADD couverture_id INT DEFAULT NULL, DROP couverture');
        $this->addSql('ALTER TABLE oeuvre ADD CONSTRAINT FK_35FE2EFE3F0A9AF5 FOREIGN KEY (couverture_id) REFERENCES fichier (id)');
        $this->addSql('CREATE INDEX IDX_35FE2EFE3F0A9AF5 ON oeuvre (couverture_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auteur DROP FOREIGN KEY FK_55AB1403DA5256D');
        $this->addSql('ALTER TABLE oeuvre DROP FOREIGN KEY FK_35FE2EFE3F0A9AF5');
        $this->addSql('DROP TABLE fichier');
        $this->addSql('DROP INDEX IDX_55AB1403DA5256D ON auteur');
        $this->addSql('ALTER TABLE auteur ADD image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP image_id');
        $this->addSql('DROP INDEX IDX_35FE2EFE3F0A9AF5 ON oeuvre');
        $this->addSql('ALTER TABLE oeuvre ADD couverture VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP couverture_id');
    }
}
