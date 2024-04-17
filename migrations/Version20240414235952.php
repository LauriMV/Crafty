<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240414235952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorias (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producto_categorias (producto_id INT NOT NULL, categorias_id INT NOT NULL, INDEX IDX_85D2DB0F7645698E (producto_id), INDEX IDX_85D2DB0F5792B277 (categorias_id), PRIMARY KEY(producto_id, categorias_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE producto_categorias ADD CONSTRAINT FK_85D2DB0F7645698E FOREIGN KEY (producto_id) REFERENCES producto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE producto_categorias ADD CONSTRAINT FK_85D2DB0F5792B277 FOREIGN KEY (categorias_id) REFERENCES categorias (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE producto_categorias DROP FOREIGN KEY FK_85D2DB0F7645698E');
        $this->addSql('ALTER TABLE producto_categorias DROP FOREIGN KEY FK_85D2DB0F5792B277');
        $this->addSql('DROP TABLE categorias');
        $this->addSql('DROP TABLE producto_categorias');
    }
}
