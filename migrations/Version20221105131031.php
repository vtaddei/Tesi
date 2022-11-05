<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221105131031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE athletes_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE entry_fee_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE medical_certificate_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE personal_data_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE races_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE results_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE roles_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE subscribers_races_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE athletes (id INT NOT NULL, fk_personal_data_id INT NOT NULL, fk_roles_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, creation_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, telephone_number INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_57A7E4D6E7927C74 ON athletes (email)');
        $this->addSql('CREATE INDEX IDX_57A7E4D6E2B8CF60 ON athletes (fk_personal_data_id)');
        $this->addSql('CREATE INDEX IDX_57A7E4D6AEF121A ON athletes (fk_roles_id)');
        $this->addSql('CREATE TABLE entry_fee (id INT NOT NULL, payment_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, expiration_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, amount DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE medical_certificate (id INT NOT NULL, delivery_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, expiration_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, typology VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE personal_data (id INT NOT NULL, fk_medical_certificate_id INT DEFAULT NULL, fk_entry_fee_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, birthdate DATE NOT NULL, birthplace VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, tax_code VARCHAR(255) NOT NULL, creation_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, disadvantage_flag INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9CF9F45ED6644769 ON personal_data (fk_medical_certificate_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9CF9F45EB5A9B06D ON personal_data (fk_entry_fee_id)');
        $this->addSql('CREATE TABLE races (id INT NOT NULL, name VARCHAR(255) NOT NULL, capacity INT DEFAULT NULL, date DATE NOT NULL, race_type INT NOT NULL, flag_disadvantage INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE results (id INT NOT NULL, fk_subscribers_races_id INT NOT NULL, race_time TIME(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9FA3E414F270EFBC ON results (fk_subscribers_races_id)');
        $this->addSql('CREATE TABLE roles (id INT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE subscribers_races (id INT NOT NULL, fk_athletes_id INT NOT NULL, fk_races_id INT NOT NULL, team INT DEFAULT NULL, registration_date DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E1CD76E4F4132072 ON subscribers_races (fk_athletes_id)');
        $this->addSql('CREATE INDEX IDX_E1CD76E4AB86DB92 ON subscribers_races (fk_races_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE athletes ADD CONSTRAINT FK_57A7E4D6E2B8CF60 FOREIGN KEY (fk_personal_data_id) REFERENCES personal_data (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE athletes ADD CONSTRAINT FK_57A7E4D6AEF121A FOREIGN KEY (fk_roles_id) REFERENCES roles (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE personal_data ADD CONSTRAINT FK_9CF9F45ED6644769 FOREIGN KEY (fk_medical_certificate_id) REFERENCES medical_certificate (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE personal_data ADD CONSTRAINT FK_9CF9F45EB5A9B06D FOREIGN KEY (fk_entry_fee_id) REFERENCES entry_fee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE results ADD CONSTRAINT FK_9FA3E414F270EFBC FOREIGN KEY (fk_subscribers_races_id) REFERENCES subscribers_races (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscribers_races ADD CONSTRAINT FK_E1CD76E4F4132072 FOREIGN KEY (fk_athletes_id) REFERENCES athletes (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscribers_races ADD CONSTRAINT FK_E1CD76E4AB86DB92 FOREIGN KEY (fk_races_id) REFERENCES races (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE athletes_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE entry_fee_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE medical_certificate_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE personal_data_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE races_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE results_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE roles_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE subscribers_races_id_seq CASCADE');
        $this->addSql('ALTER TABLE athletes DROP CONSTRAINT FK_57A7E4D6E2B8CF60');
        $this->addSql('ALTER TABLE athletes DROP CONSTRAINT FK_57A7E4D6AEF121A');
        $this->addSql('ALTER TABLE personal_data DROP CONSTRAINT FK_9CF9F45ED6644769');
        $this->addSql('ALTER TABLE personal_data DROP CONSTRAINT FK_9CF9F45EB5A9B06D');
        $this->addSql('ALTER TABLE results DROP CONSTRAINT FK_9FA3E414F270EFBC');
        $this->addSql('ALTER TABLE subscribers_races DROP CONSTRAINT FK_E1CD76E4F4132072');
        $this->addSql('ALTER TABLE subscribers_races DROP CONSTRAINT FK_E1CD76E4AB86DB92');
        $this->addSql('DROP TABLE athletes');
        $this->addSql('DROP TABLE entry_fee');
        $this->addSql('DROP TABLE medical_certificate');
        $this->addSql('DROP TABLE personal_data');
        $this->addSql('DROP TABLE races');
        $this->addSql('DROP TABLE results');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE subscribers_races');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
