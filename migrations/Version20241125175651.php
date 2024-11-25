<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241125175651 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campanias (id INT AUTO_INCREMENT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', image_description LONGTEXT DEFAULT NULL, estado TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detalle_compra (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT NOT NULL, id_transaccion VARCHAR(255) DEFAULT NULL, fecha DATE DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, id_cliente INT DEFAULT NULL, total NUMERIC(6, 2) NOT NULL, INDEX IDX_F219D2587EB2C349 (id_usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detalle_pedido (id INT AUTO_INCREMENT NOT NULL, id_pedido INT NOT NULL, id_producto INT NOT NULL, categoria_producto INT NOT NULL, cantidad INT NOT NULL, precio INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gafas (id INT AUTO_INCREMENT NOT NULL, marca VARCHAR(255) NOT NULL, modelo VARCHAR(255) NOT NULL, descripcion LONGTEXT DEFAULT NULL, tipo VARCHAR(255) NOT NULL, aro INT NOT NULL, puente INT NOT NULL, talla VARCHAR(255) NOT NULL, varilla INT DEFAULT NULL, color_montura VARCHAR(255) NOT NULL, color_lentes VARCHAR(255) DEFAULT NULL, material_montura VARCHAR(255) NOT NULL, tipo_montura VARCHAR(255) NOT NULL, precio NUMERIC(6, 2) NOT NULL, iva INT NOT NULL, descuento INT DEFAULT NULL, stock INT NOT NULL, destacado INT DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', image_name2 VARCHAR(255) DEFAULT NULL, image_size2 INT DEFAULT NULL, updated_at2 DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', image_name3 VARCHAR(255) DEFAULT NULL, image_size3 INT DEFAULT NULL, updated_at3 DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', categoria INT NOT NULL, estado TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lentillas (id INT AUTO_INCREMENT NOT NULL, marca VARCHAR(255) NOT NULL, descripcion LONGTEXT DEFAULT NULL, tipo_producto VARCHAR(255) NOT NULL, frecuencia VARCHAR(255) DEFAULT NULL, tipo VARCHAR(255) DEFAULT NULL, material VARCHAR(255) DEFAULT NULL, precio NUMERIC(6, 2) NOT NULL, iva INT NOT NULL, descuento INT DEFAULT NULL, stock INT NOT NULL, destacado INT DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', categoria INT NOT NULL, estado TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pedidos (id INT AUTO_INCREMENT NOT NULL, id_usuario_pedidos_id INT NOT NULL, id_compra_id INT DEFAULT NULL, direccion VARCHAR(255) NOT NULL, ciudad VARCHAR(255) NOT NULL, cp INT NOT NULL, precio NUMERIC(6, 2) NOT NULL, id_transaccion VARCHAR(255) NOT NULL, INDEX IDX_6716CCAA5127C8FF (id_usuario_pedidos_id), UNIQUE INDEX UNIQ_6716CCAA72D2B8F0 (id_compra_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nombre VARCHAR(255) NOT NULL, apellido1 VARCHAR(255) NOT NULL, apellido2 VARCHAR(255) DEFAULT NULL, is_verified TINYINT(1) NOT NULL, direccion VARCHAR(255) DEFAULT NULL, ciudad VARCHAR(255) DEFAULT NULL, cp INT DEFAULT NULL, document_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detalle_compra ADD CONSTRAINT FK_F219D2587EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pedidos ADD CONSTRAINT FK_6716CCAA5127C8FF FOREIGN KEY (id_usuario_pedidos_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pedidos ADD CONSTRAINT FK_6716CCAA72D2B8F0 FOREIGN KEY (id_compra_id) REFERENCES detalle_compra (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detalle_compra DROP FOREIGN KEY FK_F219D2587EB2C349');
        $this->addSql('ALTER TABLE pedidos DROP FOREIGN KEY FK_6716CCAA5127C8FF');
        $this->addSql('ALTER TABLE pedidos DROP FOREIGN KEY FK_6716CCAA72D2B8F0');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE campanias');
        $this->addSql('DROP TABLE detalle_compra');
        $this->addSql('DROP TABLE detalle_pedido');
        $this->addSql('DROP TABLE gafas');
        $this->addSql('DROP TABLE lentillas');
        $this->addSql('DROP TABLE pedidos');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
