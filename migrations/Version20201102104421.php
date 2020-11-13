<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201102104421 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hobbie_personne (hobbie_id INT NOT NULL, personne_id INT NOT NULL, INDEX IDX_F1BBD37650B678B7 (hobbie_id), INDEX IDX_F1BBD376A21BD112 (personne_id), PRIMARY KEY(hobbie_id, personne_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hobbie_personne ADD CONSTRAINT FK_F1BBD37650B678B7 FOREIGN KEY (hobbie_id) REFERENCES hobbie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hobbie_personne ADD CONSTRAINT FK_F1BBD376A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE hobbie_personne');
    }
}
