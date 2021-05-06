<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210506115035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE type (id INT NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE garbage ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE garbage DROP code');
        $this->addSql('ALTER TABLE garbage ADD CONSTRAINT FK_5C99346DC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5C99346DC54C8C93 ON garbage (type_id)');
        $this->addSql('ALTER TABLE wish ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE wish DROP code');
        $this->addSql('ALTER TABLE wish ADD CONSTRAINT FK_D7D174C9C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D7D174C9C54C8C93 ON wish (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE garbage DROP CONSTRAINT FK_5C99346DC54C8C93');
        $this->addSql('ALTER TABLE wish DROP CONSTRAINT FK_D7D174C9C54C8C93');
        $this->addSql('DROP SEQUENCE type_id_seq CASCADE');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP INDEX IDX_5C99346DC54C8C93');
        $this->addSql('ALTER TABLE garbage ADD code VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE garbage DROP type_id');
        $this->addSql('DROP INDEX IDX_D7D174C9C54C8C93');
        $this->addSql('ALTER TABLE wish ADD code VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE wish DROP type_id');
    }
}
