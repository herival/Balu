<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200506205158 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commande ADD membre_id INT NOT NULL, CHANGE recette_id recette_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D6A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D6A99F74A ON commande (membre_id)');
        $this->addSql('ALTER TABLE commentaire ADD membre_id INT DEFAULT NULL, CHANGE recette_id recette_id INT DEFAULT NULL, CHANGE note note INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC6A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('CREATE INDEX IDX_67F068BC6A99F74A ON commentaire (membre_id)');
        $this->addSql('ALTER TABLE membre CHANGE roles roles JSON NOT NULL, CHANGE prenom prenom VARCHAR(255) DEFAULT NULL, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE recette ADD membre_id INT DEFAULT NULL, CHANGE categorie_id categorie_id INT DEFAULT NULL, CHANGE pack_ingredient_id pack_ingredient_id INT DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB63906A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('CREATE INDEX IDX_49BB63906A99F74A ON recette (membre_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D6A99F74A');
        $this->addSql('DROP INDEX IDX_6EEAA67D6A99F74A ON commande');
        $this->addSql('ALTER TABLE commande DROP membre_id, CHANGE recette_id recette_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC6A99F74A');
        $this->addSql('DROP INDEX IDX_67F068BC6A99F74A ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP membre_id, CHANGE recette_id recette_id INT DEFAULT NULL, CHANGE note note INT DEFAULT NULL');
        $this->addSql('ALTER TABLE membre CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE prenom prenom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE adresse adresse VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB63906A99F74A');
        $this->addSql('DROP INDEX IDX_49BB63906A99F74A ON recette');
        $this->addSql('ALTER TABLE recette DROP membre_id, CHANGE categorie_id categorie_id INT DEFAULT NULL, CHANGE pack_ingredient_id pack_ingredient_id INT DEFAULT NULL, CHANGE image image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
