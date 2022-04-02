<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220402165151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE foro (id INT AUTO_INCREMENT NOT NULL, usuario_comenta_id INT NOT NULL, comentario VARCHAR(255) NOT NULL, fecha_creacion DATE NOT NULL, valoracion INT NOT NULL, INDEX IDX_BC869C631FE6A19B (usuario_comenta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE foro ADD CONSTRAINT FK_BC869C631FE6A19B FOREIGN KEY (usuario_comenta_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE foro');
    }
}
