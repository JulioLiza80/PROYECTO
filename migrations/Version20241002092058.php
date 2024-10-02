<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241002092058 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pedidos (id INT AUTO_INCREMENT NOT NULL, id_usuario_pedidos_id INT NOT NULL, id_compra_id INT DEFAULT NULL, direccion VARCHAR(255) NOT NULL, ciudad VARCHAR(255) NOT NULL, cp INT NOT NULL, precio NUMERIC(6, 2) NOT NULL, INDEX IDX_6716CCAA5127C8FF (id_usuario_pedidos_id), UNIQUE INDEX UNIQ_6716CCAA72D2B8F0 (id_compra_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pedidos ADD CONSTRAINT FK_6716CCAA5127C8FF FOREIGN KEY (id_usuario_pedidos_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pedidos ADD CONSTRAINT FK_6716CCAA72D2B8F0 FOREIGN KEY (id_compra_id) REFERENCES detalle_compra (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pedidos DROP FOREIGN KEY FK_6716CCAA5127C8FF');
        $this->addSql('ALTER TABLE pedidos DROP FOREIGN KEY FK_6716CCAA72D2B8F0');
        $this->addSql('DROP TABLE pedidos');
    }
}
