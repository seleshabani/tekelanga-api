<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201018225739 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock ADD stock_rest INT NOT NULL, ADD total_stock_init INT NOT NULL, ADD total_stock_rest INT NOT NULL, DROP quantite, DROP prix_total');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock ADD quantite INT NOT NULL, ADD prix_total INT NOT NULL, DROP stock_rest, DROP total_stock_init, DROP total_stock_rest');
    }
}
