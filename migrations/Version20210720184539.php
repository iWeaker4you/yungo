<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210720184539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE servicio (id INT AUTO_INCREMENT NOT NULL, fk_address_id INT NOT NULL, INDEX IDX_CB86F22A5D965E6 (fk_address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE servicio ADD CONSTRAINT FK_CB86F22A5D965E6 FOREIGN KEY (fk_address_id) REFERENCES direccion (id)');
        $this->addSql('ALTER TABLE direccion DROP INDEX FK_F384BE956F030287, ADD UNIQUE INDEX UNIQ_F384BE956F030287 (fk_zone_id)');
        $this->addSql('ALTER TABLE direccion CHANGE fk_zone_id fk_zone_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE direccion ADD CONSTRAINT FK_F384BE951239C430 FOREIGN KEY (fk_inventary_id) REFERENCES inventario (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F384BE951239C430 ON direccion (fk_inventary_id)');
        $this->addSql('ALTER TABLE paquete ADD servicio_id INT NOT NULL');
        $this->addSql('ALTER TABLE paquete ADD CONSTRAINT FK_12686A9571CAA3E7 FOREIGN KEY (servicio_id) REFERENCES servicio (id)');
        $this->addSql('CREATE INDEX IDX_12686A9571CAA3E7 ON paquete (servicio_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paquete DROP FOREIGN KEY FK_12686A9571CAA3E7');
        $this->addSql('DROP TABLE servicio');
        $this->addSql('ALTER TABLE direccion DROP INDEX UNIQ_F384BE956F030287, ADD INDEX FK_F384BE956F030287 (fk_zone_id)');
        $this->addSql('ALTER TABLE direccion DROP FOREIGN KEY FK_F384BE951239C430');
        $this->addSql('DROP INDEX UNIQ_F384BE951239C430 ON direccion');
        $this->addSql('ALTER TABLE direccion CHANGE fk_zone_id fk_zone_id INT NOT NULL');
        $this->addSql('DROP INDEX IDX_12686A9571CAA3E7 ON paquete');
        $this->addSql('ALTER TABLE paquete DROP servicio_id');
    }
}
