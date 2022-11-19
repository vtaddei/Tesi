<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221119103053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE athletes DROP CONSTRAINT fk_57a7e4d6aef121a');
        $this->addSql('DROP SEQUENCE roles_id_seq CASCADE');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP INDEX idx_57a7e4d6aef121a');
        $this->addSql('ALTER TABLE athletes DROP fk_roles_id');
        $this->addSql('ALTER TABLE athletes DROP creation_date');
        $this->addSql('ALTER TABLE athletes ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE athletes ALTER roles TYPE JSON');
        $this->addSql('ALTER TABLE athletes ALTER roles DROP DEFAULT');
        $this->addSql('ALTER INDEX idx_57a7e4d6e2b8cf60 RENAME TO IDX_57A7E4D6B4D2A817');
        $this->addSql('ALTER TABLE entry_fee ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE medical_certificate ADD photo_blob BYTEA DEFAULT NULL');
        $this->addSql('ALTER TABLE medical_certificate ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE personal_data ADD photo_blob VARCHAR(50000) DEFAULT NULL');
        $this->addSql('ALTER TABLE personal_data DROP creation_date');
        $this->addSql('ALTER TABLE personal_data ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE races ADD length VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE races ADD real_length VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE races ADD social_race BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE races ADD price VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE races ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE results ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE subscribers_races ALTER id DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE roles_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE roles (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE SEQUENCE results_id_seq');
        $this->addSql('SELECT setval(\'results_id_seq\', (SELECT MAX(id) FROM results))');
        $this->addSql('ALTER TABLE results ALTER id SET DEFAULT nextval(\'results_id_seq\')');
        $this->addSql('ALTER TABLE athletes ADD fk_roles_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE athletes ADD creation_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('CREATE SEQUENCE athletes_id_seq');
        $this->addSql('SELECT setval(\'athletes_id_seq\', (SELECT MAX(id) FROM athletes))');
        $this->addSql('ALTER TABLE athletes ALTER id SET DEFAULT nextval(\'athletes_id_seq\')');
        $this->addSql('ALTER TABLE athletes ALTER roles TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE athletes ALTER roles SET DEFAULT \'ROLE_USER\'');
        $this->addSql('ALTER TABLE athletes ADD CONSTRAINT fk_57a7e4d6aef121a FOREIGN KEY (fk_roles_id) REFERENCES roles (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_57a7e4d6aef121a ON athletes (fk_roles_id)');
        $this->addSql('ALTER INDEX idx_57a7e4d6b4d2a817 RENAME TO idx_57a7e4d6e2b8cf60');
        $this->addSql('ALTER TABLE races DROP length');
        $this->addSql('ALTER TABLE races DROP real_length');
        $this->addSql('ALTER TABLE races DROP social_race');
        $this->addSql('ALTER TABLE races DROP price');
        $this->addSql('CREATE SEQUENCE races_id_seq');
        $this->addSql('SELECT setval(\'races_id_seq\', (SELECT MAX(id) FROM races))');
        $this->addSql('ALTER TABLE races ALTER id SET DEFAULT nextval(\'races_id_seq\')');
        $this->addSql('CREATE SEQUENCE subscribers_races_id_seq');
        $this->addSql('SELECT setval(\'subscribers_races_id_seq\', (SELECT MAX(id) FROM subscribers_races))');
        $this->addSql('ALTER TABLE subscribers_races ALTER id SET DEFAULT nextval(\'subscribers_races_id_seq\')');
        $this->addSql('CREATE SEQUENCE entry_fee_id_seq');
        $this->addSql('SELECT setval(\'entry_fee_id_seq\', (SELECT MAX(id) FROM entry_fee))');
        $this->addSql('ALTER TABLE entry_fee ALTER id SET DEFAULT nextval(\'entry_fee_id_seq\')');
        $this->addSql('ALTER TABLE personal_data ADD creation_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE personal_data DROP photo_blob');
        $this->addSql('CREATE SEQUENCE personal_data_id_seq');
        $this->addSql('SELECT setval(\'personal_data_id_seq\', (SELECT MAX(id) FROM personal_data))');
        $this->addSql('ALTER TABLE personal_data ALTER id SET DEFAULT nextval(\'personal_data_id_seq\')');
        $this->addSql('ALTER TABLE medical_certificate DROP photo_blob');
        $this->addSql('CREATE SEQUENCE medical_certificate_id_seq');
        $this->addSql('SELECT setval(\'medical_certificate_id_seq\', (SELECT MAX(id) FROM medical_certificate))');
        $this->addSql('ALTER TABLE medical_certificate ALTER id SET DEFAULT nextval(\'medical_certificate_id_seq\')');
    }
}
