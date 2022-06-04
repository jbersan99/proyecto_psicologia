<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220521175520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A62165395B7');
        $this->addSql('DROP INDEX IDX_3E379A62165395B7 ON cita');
        $this->addSql('ALTER TABLE cita DROP tipo_terapia_reserva_id, DROP tipo_servicio_reserva_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cita ADD tipo_terapia_reserva_id INT NOT NULL, ADD tipo_servicio_reserva_id INT NOT NULL');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A62165395B7 FOREIGN KEY (tipo_terapia_reserva_id) REFERENCES tipo_terapia (id)');
        $this->addSql('CREATE INDEX IDX_3E379A62165395B7 ON cita (tipo_terapia_reserva_id)');
    }
}
