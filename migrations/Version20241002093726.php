<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241002093726 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lentillas (id INT AUTO_INCREMENT NOT NULL, marca VARCHAR(255) NOT NULL, descripcion LONGTEXT DEFAULT NULL, tipo_producto VARCHAR(255) NOT NULL, frecuencia VARCHAR(255) DEFAULT NULL, tipo VARCHAR(255) DEFAULT NULL, material VARCHAR(255) DEFAULT NULL, precio NUMERIC(6, 2) NOT NULL, iva INT NOT NULL, descuento INT DEFAULT NULL, stock INT NOT NULL, destacado INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE lentillas');
    }
}
