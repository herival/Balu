<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200512083727 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie ADD image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire CHANGE recette_id recette_id INT DEFAULT NULL, CHANGE membre_id membre_id INT DEFAULT NULL, CHANGE note note INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detailcommande CHANGE commande_id commande_id INT DEFAULT NULL, CHANGE recette_id recette_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE membre CHANGE roles roles JSON NOT NULL, CHANGE prenom prenom VARCHAR(255) DEFAULT NULL, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE pack_ingredient CHANGE unite unite VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE recette CHANGE categorie_id categorie_id INT DEFAULT NULL, CHANGE membre_id membre_id INT DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL, CHANGE prix prix DOUBLE PRECISION DEFAULT NULL, CHANGE cuisson cuisson TIME DEFAULT NULL, CHANGE tpspreparation tpspreparation TIME DEFAULT NULL, CHANGE nbrepersonne nbrepersonne INT DEFAULT NULL, CHANGE difficulte difficulte VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie DROP image');
        $this->addSql('ALTER TABLE commentaire CHANGE recette_id recette_id INT DEFAULT NULL, CHANGE membre_id membre_id INT DEFAULT NULL, CHANGE note note INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detailcommande CHANGE commande_id commande_id INT DEFAULT NULL, CHANGE recette_id recette_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE membre CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE prenom prenom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE adresse adresse VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE pack_ingredient CHANGE unite unite VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE recette CHANGE categorie_id categorie_id INT DEFAULT NULL, CHANGE membre_id membre_id INT DEFAULT NULL, CHANGE image image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE prix prix DOUBLE PRECISION DEFAULT \'NULL\', CHANGE cuisson cuisson TIME DEFAULT \'NULL\', CHANGE tpspreparation tpspreparation TIME DEFAULT \'NULL\', CHANGE nbrepersonne nbrepersonne INT DEFAULT NULL, CHANGE difficulte difficulte VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
