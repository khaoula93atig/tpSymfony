<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201104080447 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personne ADD piece_identite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EF1B21CC5E FOREIGN KEY (piece_identite_id) REFERENCES piece_identite (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FCEC9EF1B21CC5E ON personne (piece_identite_id)');
        $this->addSql('ALTER TABLE piece_identite DROP FOREIGN KEY FK_4AE6DA64A21BD112');
        $this->addSql('DROP INDEX UNIQ_4AE6DA64A21BD112 ON piece_identite');
        $this->addSql('ALTER TABLE piece_identite DROP personne_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EF1B21CC5E');
        $this->addSql('DROP INDEX UNIQ_FCEC9EF1B21CC5E ON personne');
        $this->addSql('ALTER TABLE personne DROP piece_identite_id');
        $this->addSql('ALTER TABLE piece_identite ADD personne_id INT NOT NULL');
        $this->addSql('ALTER TABLE piece_identite ADD CONSTRAINT FK_4AE6DA64A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4AE6DA64A21BD112 ON piece_identite (personne_id)');
    }
}
