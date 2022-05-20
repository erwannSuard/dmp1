<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220520145629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE contact_id_contact_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE funding_id_funding_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE project_id_project_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE romp_id_romp_seq INCREMENT BY 1 MINVALUE 1 START 1');
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
        $this->addSql('ALTER TABLE funding ALTER id_contact_funding DROP NOT NULL');
        $this->addSql('ALTER TABLE project ALTER id_funding_project DROP NOT NULL');
        $this->addSql('ALTER TABLE romp ALTER id_project_romp DROP NOT NULL');
        $this->addSql('ALTER TABLE romp ALTER id_contact_romp DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE contact_id_contact_seq CASCADE');
        $this->addSql('DROP SEQUENCE funding_id_funding_seq CASCADE');
        $this->addSql('DROP SEQUENCE project_id_project_seq CASCADE');
        $this->addSql('DROP SEQUENCE romp_id_romp_seq CASCADE');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE funding ALTER id_contact_funding SET NOT NULL');
        $this->addSql('ALTER TABLE project ALTER id_funding_project SET NOT NULL');
        $this->addSql('ALTER TABLE romp ALTER id_project_romp SET NOT NULL');
        $this->addSql('ALTER TABLE romp ALTER id_contact_romp SET NOT NULL');
    }
}
