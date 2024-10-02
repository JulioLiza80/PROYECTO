<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241002091003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE detalle_compra (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT NOT NULL, id_transaccion INT DEFAULT NULL, fecha DATE DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, id_cliente INT DEFAULT NULL, total NUMERIC(6, 2) NOT NULL, INDEX IDX_F219D2587EB2C349 (id_usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detalle_compra ADD CONSTRAINT FK_F219D2587EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detalle_compra DROP FOREIGN KEY FK_F219D2587EB2C349');
        $this->addSql('DROP TABLE detalle_compra');
    }
}
