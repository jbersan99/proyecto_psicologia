<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220601183734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tipo_terapia DROP FOREIGN KEY FK_14785EB660DF0761');
        $this->addSql('DROP INDEX IDX_14785EB660DF0761 ON tipo_terapia');
        $this->addSql('ALTER TABLE tipo_terapia DROP servicio_escogido_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tipo_terapia ADD servicio_escogido_id INT NOT NULL');
        $this->addSql('ALTER TABLE tipo_terapia ADD CONSTRAINT FK_14785EB660DF0761 FOREIGN KEY (servicio_escogido_id) REFERENCES servicios_disponibles (id)');
        $this->addSql('CREATE INDEX IDX_14785EB660DF0761 ON tipo_terapia (servicio_escogido_id)');
    }
}
