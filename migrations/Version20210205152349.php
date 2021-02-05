<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210205152349 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE biblio ADD oeuvre_id INT NOT NULL, ADD note VARCHAR(255) NOT NULL, ADD statut VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE biblio ADD CONSTRAINT FK_D90CBB2588194DE8 FOREIGN KEY (oeuvre_id) REFERENCES oeuvre (id)');
        $this->addSql('CREATE INDEX IDX_D90CBB2588194DE8 ON biblio (oeuvre_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE biblio DROP FOREIGN KEY FK_D90CBB2588194DE8');
        $this->addSql('DROP INDEX IDX_D90CBB2588194DE8 ON biblio');
        $this->addSql('ALTER TABLE biblio DROP oeuvre_id, DROP note, DROP statut');
    }
}
