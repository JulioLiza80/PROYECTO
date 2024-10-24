<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241023133641 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detalle_compra CHANGE id_transaccion id_transaccion VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE pedidos CHANGE id_transaccion id_transaccion VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detalle_compra CHANGE id_transaccion id_transaccion INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pedidos CHANGE id_transaccion id_transaccion INT NOT NULL');
    }
}
