<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220521175630 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cita ADD servicio_escogido_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A6260DF0761 FOREIGN KEY (servicio_escogido_id) REFERENCES servicios_disponibles (id)');
        $this->addSql('CREATE INDEX IDX_3E379A6260DF0761 ON cita (servicio_escogido_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A6260DF0761');
        $this->addSql('DROP INDEX IDX_3E379A6260DF0761 ON cita');
        $this->addSql('ALTER TABLE cita DROP servicio_escogido_id');
    }
}
