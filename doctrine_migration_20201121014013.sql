-- Doctrine Migration File Generated on 2020-11-21 01:40:13

-- Version DoctrineMigrations\Version20201121013501
ALTER TABLE panier ADD livrer TINYINT(1) DEFAULT 0, CHANGE date_creation date_creation DATETIME DEFAULT now();
