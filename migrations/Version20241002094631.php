<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241002094631 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE detalle_pedido (id INT AUTO_INCREMENT NOT NULL, cantidad INT NOT NULL, precio NUMERIC(6, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detalle_pedido_gafas (detalle_pedido_id INT NOT NULL, gafas_id INT NOT NULL, INDEX IDX_1A2F0FD96938D47A (detalle_pedido_id), INDEX IDX_1A2F0FD98B89070 (gafas_id), PRIMARY KEY(detalle_pedido_id, gafas_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detalle_pedido_lentillas (detalle_pedido_id INT NOT NULL, lentillas_id INT NOT NULL, INDEX IDX_57566DF16938D47A (detalle_pedido_id), INDEX IDX_57566DF1AD33640B (lentillas_id), PRIMARY KEY(detalle_pedido_id, lentillas_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detalle_pedido_gafas ADD CONSTRAINT FK_1A2F0FD96938D47A FOREIGN KEY (detalle_pedido_id) REFERENCES detalle_pedido (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detalle_pedido_gafas ADD CONSTRAINT FK_1A2F0FD98B89070 FOREIGN KEY (gafas_id) REFERENCES gafas (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detalle_pedido_lentillas ADD CONSTRAINT FK_57566DF16938D47A FOREIGN KEY (detalle_pedido_id) REFERENCES detalle_pedido (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detalle_pedido_lentillas ADD CONSTRAINT FK_57566DF1AD33640B FOREIGN KEY (lentillas_id) REFERENCES lentillas (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pedidos ADD detalle_pedido_id INT NOT NULL');
        $this->addSql('ALTER TABLE pedidos ADD CONSTRAINT FK_6716CCAA6938D47A FOREIGN KEY (detalle_pedido_id) REFERENCES detalle_pedido (id)');
        $this->addSql('CREATE INDEX IDX_6716CCAA6938D47A ON pedidos (detalle_pedido_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pedidos DROP FOREIGN KEY FK_6716CCAA6938D47A');
        $this->addSql('ALTER TABLE detalle_pedido_gafas DROP FOREIGN KEY FK_1A2F0FD96938D47A');
        $this->addSql('ALTER TABLE detalle_pedido_gafas DROP FOREIGN KEY FK_1A2F0FD98B89070');
        $this->addSql('ALTER TABLE detalle_pedido_lentillas DROP FOREIGN KEY FK_57566DF16938D47A');
        $this->addSql('ALTER TABLE detalle_pedido_lentillas DROP FOREIGN KEY FK_57566DF1AD33640B');
        $this->addSql('DROP TABLE detalle_pedido');
        $this->addSql('DROP TABLE detalle_pedido_gafas');
        $this->addSql('DROP TABLE detalle_pedido_lentillas');
        $this->addSql('DROP INDEX IDX_6716CCAA6938D47A ON pedidos');
        $this->addSql('ALTER TABLE pedidos DROP detalle_pedido_id');
    }
}
