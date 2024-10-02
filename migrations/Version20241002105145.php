<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241002105145 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campanias ADD image_name2 VARCHAR(255) DEFAULT NULL, ADD image_size2 INT DEFAULT NULL, ADD updated_at2 DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD image_name3 VARCHAR(255) DEFAULT NULL, ADD image_size3 INT DEFAULT NULL, ADD updated_at3 DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD image_name4 VARCHAR(255) DEFAULT NULL, ADD image_size4 INT DEFAULT NULL, ADD updated_at4 DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campanias DROP image_name2, DROP image_size2, DROP updated_at2, DROP image_name3, DROP image_size3, DROP updated_at3, DROP image_name4, DROP image_size4, DROP updated_at4');
    }
}
