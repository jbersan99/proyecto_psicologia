<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220402163856 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A62DB38439E');
        $this->addSql('DROP INDEX IDX_3E379A62DB38439E ON cita');
        $this->addSql('ALTER TABLE cita ADD tipo_terapia_reserva_id INT NOT NULL, ADD datos_otro_reserva_id INT DEFAULT NULL, CHANGE usuario_id usuario_reserva_id INT NOT NULL');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A622541734A FOREIGN KEY (usuario_reserva_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A62165395B7 FOREIGN KEY (tipo_terapia_reserva_id) REFERENCES tipo_terapia (id)');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A62309E60ED FOREIGN KEY (datos_otro_reserva_id) REFERENCES datos_otra (id)');
        $this->addSql('CREATE INDEX IDX_3E379A622541734A ON cita (usuario_reserva_id)');
        $this->addSql('CREATE INDEX IDX_3E379A62165395B7 ON cita (tipo_terapia_reserva_id)');
        $this->addSql('CREATE INDEX IDX_3E379A62309E60ED ON cita (datos_otro_reserva_id)');
        $this->addSql('ALTER TABLE tipo_terapia ADD servicio_escogido_id INT NOT NULL');
        $this->addSql('ALTER TABLE tipo_terapia ADD CONSTRAINT FK_14785EB660DF0761 FOREIGN KEY (servicio_escogido_id) REFERENCES servicios_disponibles (id)');
        $this->addSql('CREATE INDEX IDX_14785EB660DF0761 ON tipo_terapia (servicio_escogido_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A622541734A');
        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A62165395B7');
        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A62309E60ED');
        $this->addSql('DROP INDEX IDX_3E379A622541734A ON cita');
        $this->addSql('DROP INDEX IDX_3E379A62165395B7 ON cita');
        $this->addSql('DROP INDEX IDX_3E379A62309E60ED ON cita');
        $this->addSql('ALTER TABLE cita ADD usuario_id INT NOT NULL, DROP usuario_reserva_id, DROP tipo_terapia_reserva_id, DROP datos_otro_reserva_id');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A62DB38439E FOREIGN KEY (usuario_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3E379A62DB38439E ON cita (usuario_id)');
        $this->addSql('ALTER TABLE tipo_terapia DROP FOREIGN KEY FK_14785EB660DF0761');
        $this->addSql('DROP INDEX IDX_14785EB660DF0761 ON tipo_terapia');
        $this->addSql('ALTER TABLE tipo_terapia DROP servicio_escogido_id');
    }
}
