<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220610080119 extends AbstractMigration
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
        $this->addSql('CREATE SEQUENCE messenger_messages_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE project_id_project_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE romp_id_romp_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE contact (id_contact INT NOT NULL, type_contact TEXT NOT NULL, last_name TEXT NOT NULL, first_name TEXT DEFAULT NULL, mail TEXT NOT NULL, affiliation TEXT NOT NULL, identifier TEXT DEFAULT NULL, PRIMARY KEY(id_contact))');
        $this->addSql('CREATE TABLE contact_project (id_contact INT NOT NULL, id_project INT NOT NULL, PRIMARY KEY(id_contact, id_project))');
        $this->addSql('CREATE INDEX IDX_B59CF16F92FF4F48 ON contact_project (id_contact)');
        $this->addSql('CREATE INDEX IDX_B59CF16FF12E799E ON contact_project (id_project)');
        $this->addSql('CREATE TABLE funding (id_funding INT NOT NULL, id_contact_funding INT DEFAULT NULL, grant_funding INT NOT NULL, PRIMARY KEY(id_funding))');
        $this->addSql('CREATE INDEX IDX_D30DD1D6A07C33DF ON funding (id_contact_funding)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_75ea56e0e3bd61ce ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX idx_75ea56e016ba31db ON messenger_messages (delivered_at)');
        $this->addSql('CREATE INDEX idx_75ea56e0fb7336f0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE TABLE project (id_project INT NOT NULL, id_ref_project INT DEFAULT NULL, id_funding_project INT DEFAULT NULL, title TEXT NOT NULL, abstract TEXT NOT NULL, acronyme TEXT NOT NULL, start_date DATE NOT NULL, duration INT DEFAULT NULL, type TEXT NOT NULL, website TEXT DEFAULT NULL, objectives TEXT NOT NULL, PRIMARY KEY(id_project))');
        $this->addSql('CREATE INDEX IDX_2FB3D0EEF3B54EC9 ON project (id_ref_project)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EEDA89326 ON project (id_funding_project)');
        $this->addSql('CREATE TABLE romp (id_romp INT NOT NULL, id_project_romp INT DEFAULT NULL, id_contact_romp INT DEFAULT NULL, identifier TEXT DEFAULT NULL, submission_date DATE NOT NULL, version TEXT NOT NULL, deliverable TEXT NOT NULL, licence TEXT DEFAULT \'CC-BY-4.0\', PRIMARY KEY(id_romp))');
        $this->addSql('CREATE INDEX IDX_23AF5FC039FFE2AA ON romp (id_project_romp)');
        $this->addSql('CREATE INDEX IDX_23AF5FC02891A84D ON romp (id_contact_romp)');
        $this->addSql('ALTER TABLE contact_project ADD CONSTRAINT FK_B59CF16F92FF4F48 FOREIGN KEY (id_contact) REFERENCES contact (id_contact) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE contact_project ADD CONSTRAINT FK_B59CF16FF12E799E FOREIGN KEY (id_project) REFERENCES project (id_project) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE funding ADD CONSTRAINT FK_D30DD1D6A07C33DF FOREIGN KEY (id_contact_funding) REFERENCES contact (id_contact) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEF3B54EC9 FOREIGN KEY (id_ref_project) REFERENCES project (id_project) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEDA89326 FOREIGN KEY (id_funding_project) REFERENCES funding (id_funding) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE romp ADD CONSTRAINT FK_23AF5FC039FFE2AA FOREIGN KEY (id_project_romp) REFERENCES project (id_project) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE romp ADD CONSTRAINT FK_23AF5FC02891A84D FOREIGN KEY (id_contact_romp) REFERENCES contact (id_contact) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE contact_project DROP CONSTRAINT FK_B59CF16F92FF4F48');
        $this->addSql('ALTER TABLE funding DROP CONSTRAINT FK_D30DD1D6A07C33DF');
        $this->addSql('ALTER TABLE romp DROP CONSTRAINT FK_23AF5FC02891A84D');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT FK_2FB3D0EEDA89326');
        $this->addSql('ALTER TABLE contact_project DROP CONSTRAINT FK_B59CF16FF12E799E');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT FK_2FB3D0EEF3B54EC9');
        $this->addSql('ALTER TABLE romp DROP CONSTRAINT FK_23AF5FC039FFE2AA');
        $this->addSql('DROP SEQUENCE contact_id_contact_seq CASCADE');
        $this->addSql('DROP SEQUENCE funding_id_funding_seq CASCADE');
        $this->addSql('DROP SEQUENCE messenger_messages_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE project_id_project_seq CASCADE');
        $this->addSql('DROP SEQUENCE romp_id_romp_seq CASCADE');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE contact_project');
        $this->addSql('DROP TABLE funding');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE romp');
    }
}
