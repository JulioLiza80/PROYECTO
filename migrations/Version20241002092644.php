<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241002092644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gafas (id INT AUTO_INCREMENT NOT NULL, marca VARCHAR(255) NOT NULL, modelo VARCHAR(255) NOT NULL, descripcion LONGTEXT DEFAULT NULL, tipo VARCHAR(255) NOT NULL, aro INT NOT NULL, puente INT NOT NULL, talla INT NOT NULL, varilla INT DEFAULT NULL, color_montura VARCHAR(255) NOT NULL, color_lentes VARCHAR(255) DEFAULT NULL, material_montura VARCHAR(255) NOT NULL, tipo_montura VARCHAR(255) NOT NULL, precio NUMERIC(6, 2) NOT NULL, iva INT NOT NULL, descuento INT DEFAULT NULL, stock INT NOT NULL, destacado INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE gafas');
    }
}
