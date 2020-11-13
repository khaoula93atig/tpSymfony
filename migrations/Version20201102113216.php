<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201102113216 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE hobbie_personne');
        $this->addSql('ALTER TABLE piece_identite DROP FOREIGN KEY FK_4AE6DA643256915B');
        $this->addSql('DROP INDEX UNIQ_4AE6DA643256915B ON piece_identite');
        $this->addSql('ALTER TABLE piece_identite CHANGE relation_id personne_id INT NOT NULL');
        $this->addSql('ALTER TABLE piece_identite ADD CONSTRAINT FK_4AE6DA64A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4AE6DA64A21BD112 ON piece_identite (personne_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hobbie_personne (hobbie_id INT NOT NULL, personne_id INT NOT NULL, INDEX IDX_F1BBD37650B678B7 (hobbie_id), INDEX IDX_F1BBD376A21BD112 (personne_id), PRIMARY KEY(hobbie_id, personne_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE hobbie_personne ADD CONSTRAINT FK_F1BBD37650B678B7 FOREIGN KEY (hobbie_id) REFERENCES hobbie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hobbie_personne ADD CONSTRAINT FK_F1BBD376A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE piece_identite DROP FOREIGN KEY FK_4AE6DA64A21BD112');
        $this->addSql('DROP INDEX UNIQ_4AE6DA64A21BD112 ON piece_identite');
        $this->addSql('ALTER TABLE piece_identite CHANGE personne_id relation_id INT NOT NULL');
        $this->addSql('ALTER TABLE piece_identite ADD CONSTRAINT FK_4AE6DA643256915B FOREIGN KEY (relation_id) REFERENCES personne (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4AE6DA643256915B ON piece_identite (relation_id)');
    }
}
