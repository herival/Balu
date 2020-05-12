<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200511092500 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentaire CHANGE recette_id recette_id INT DEFAULT NULL, CHANGE membre_id membre_id INT DEFAULT NULL, CHANGE note note INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detailcommande DROP FOREIGN KEY FK_7D6DC7D582EA2E54');
        $this->addSql('ALTER TABLE detailcommande CHANGE commande_id commande_id INT DEFAULT NULL, CHANGE recette_id recette_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detailcommande ADD CONSTRAINT FK_7D6DC7D582EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE membre ADD cp INT NOT NULL, ADD ville VARCHAR(50) NOT NULL, CHANGE roles roles JSON NOT NULL, CHANGE prenom prenom VARCHAR(255) DEFAULT NULL, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE pack_ingredient DROP FOREIGN KEY FK_49C7F06689312FE9');
        $this->addSql('ALTER TABLE pack_ingredient CHANGE unite unite VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE pack_ingredient ADD CONSTRAINT FK_49C7F06689312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE recette CHANGE categorie_id categorie_id INT DEFAULT NULL, CHANGE membre_id membre_id INT DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL, CHANGE prix prix DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentaire CHANGE recette_id recette_id INT DEFAULT NULL, CHANGE membre_id membre_id INT DEFAULT NULL, CHANGE note note INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detailcommande DROP FOREIGN KEY FK_7D6DC7D582EA2E54');
        $this->addSql('ALTER TABLE detailcommande CHANGE commande_id commande_id INT DEFAULT NULL, CHANGE recette_id recette_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detailcommande ADD CONSTRAINT FK_7D6DC7D582EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE membre DROP cp, DROP ville, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE prenom prenom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE adresse adresse VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE pack_ingredient DROP FOREIGN KEY FK_49C7F06689312FE9');
        $this->addSql('ALTER TABLE pack_ingredient CHANGE unite unite VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE pack_ingredient ADD CONSTRAINT FK_49C7F06689312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette CHANGE categorie_id categorie_id INT DEFAULT NULL, CHANGE membre_id membre_id INT DEFAULT NULL, CHANGE image image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE prix prix DOUBLE PRECISION DEFAULT \'NULL\'');
    }
}
