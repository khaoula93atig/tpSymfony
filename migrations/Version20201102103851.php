<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201102103851 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piece_identite ADD relation_id INT NOT NULL');
        $this->addSql('ALTER TABLE piece_identite ADD CONSTRAINT FK_4AE6DA643256915B FOREIGN KEY (relation_id) REFERENCES personne (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4AE6DA643256915B ON piece_identite (relation_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piece_identite DROP FOREIGN KEY FK_4AE6DA643256915B');
        $this->addSql('DROP INDEX UNIQ_4AE6DA643256915B ON piece_identite');
        $this->addSql('ALTER TABLE piece_identite DROP relation_id');
    }
}
