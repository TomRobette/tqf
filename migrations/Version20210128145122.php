<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210128145122 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE transaction');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, oeuvre_id INT NOT NULL, INDEX IDX_29A5EC2788194DE8 (oeuvre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, start DATETIME NOT NULL, end DATETIME DEFAULT NULL, status SMALLINT DEFAULT 0 NOT NULL, token VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, amount NUMERIC(6, 2) DEFAULT \'0.00\' NOT NULL, response LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_723705D15F37A13B (token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2788194DE8 FOREIGN KEY (oeuvre_id) REFERENCES oeuvre (id)');
    }
}
