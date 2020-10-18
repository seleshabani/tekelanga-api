<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201018020722 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE addresse (id INT AUTO_INCREMENT NOT NULL, ville VARCHAR(100) NOT NULL, commune VARCHAR(100) NOT NULL, quartier VARCHAR(100) NOT NULL, numero VARCHAR(4) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agent (id INT AUTO_INCREMENT NOT NULL, id_addresse_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, sexe VARCHAR(1) NOT NULL, telephone VARCHAR(13) NOT NULL, mail VARCHAR(255) DEFAULT NULL, INDEX IDX_268B9C9DAA8B4A8D (id_addresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, detail VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, id_addresse_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, sexe VARCHAR(1) NOT NULL, telephone VARCHAR(13) NOT NULL, mail VARCHAR(255) DEFAULT NULL, INDEX IDX_C7440455AA8B4A8D (id_addresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, id_produit_id INT NOT NULL, label VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, INDEX IDX_E01FBE6AAABEFE2C (id_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_panier (id INT AUTO_INCREMENT NOT NULL, id_panier_id INT NOT NULL, id_produit_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_A235783D77482E5B (id_panier_id), UNIQUE INDEX UNIQ_A235783DAABEFE2C (id_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, idclient_id INT DEFAULT NULL, id_agent_id INT DEFAULT NULL, date_creation VARCHAR(255) NOT NULL, date_validation DATETIME DEFAULT NULL, prix_total INT DEFAULT NULL, valide TINYINT(1) DEFAULT NULL, INDEX IDX_24CC0DF267F0C0D4 (idclient_id), INDEX IDX_24CC0DF264CF9D9E (id_agent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, id_categories_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, INDEX IDX_29A5EC271C3AC5D2 (id_categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, id_produit_id INT NOT NULL, quantite INT NOT NULL, prix_unitaire INT NOT NULL, prix_total INT NOT NULL, UNIQUE INDEX UNIQ_4B365660AABEFE2C (id_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9DAA8B4A8D FOREIGN KEY (id_addresse_id) REFERENCES addresse (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455AA8B4A8D FOREIGN KEY (id_addresse_id) REFERENCES addresse (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6AAABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE item_panier ADD CONSTRAINT FK_A235783D77482E5B FOREIGN KEY (id_panier_id) REFERENCES panier (id)');
        $this->addSql('ALTER TABLE item_panier ADD CONSTRAINT FK_A235783DAABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF267F0C0D4 FOREIGN KEY (idclient_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF264CF9D9E FOREIGN KEY (id_agent_id) REFERENCES agent (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC271C3AC5D2 FOREIGN KEY (id_categories_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660AABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9DAA8B4A8D');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455AA8B4A8D');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF264CF9D9E');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC271C3AC5D2');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF267F0C0D4');
        $this->addSql('ALTER TABLE item_panier DROP FOREIGN KEY FK_A235783D77482E5B');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6AAABEFE2C');
        $this->addSql('ALTER TABLE item_panier DROP FOREIGN KEY FK_A235783DAABEFE2C');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660AABEFE2C');
        $this->addSql('DROP TABLE addresse');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE item_panier');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE stock');
    }
}
