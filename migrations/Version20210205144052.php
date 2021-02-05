<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210205144052 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE biblio (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, image_id INT DEFAULT NULL, prix_total DOUBLE PRECISION NOT NULL, nb_exemplaires INT NOT NULL, INDEX IDX_D90CBB25C54C8C93 (type_id), INDEX IDX_D90CBB253DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE biblio ADD CONSTRAINT FK_D90CBB25C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE biblio ADD CONSTRAINT FK_D90CBB253DA5256D FOREIGN KEY (image_id) REFERENCES fichier (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE biblio DROP FOREIGN KEY FK_D90CBB25C54C8C93');
        $this->addSql('DROP TABLE biblio');
        $this->addSql('DROP TABLE type');
    }
}
