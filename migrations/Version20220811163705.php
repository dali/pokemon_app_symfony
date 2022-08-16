<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220811163705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE base_stats (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, pokemon_id INTEGER DEFAULT NULL, hp INTEGER NOT NULL, attack INTEGER NOT NULL, defence INTEGER NOT NULL, sp_atk INTEGER NOT NULL, sp_def INTEGER NOT NULL, speed INTEGER NOT NULL, total INTEGER NOT NULL, CONSTRAINT FK_EA6CF6782FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EA6CF6782FE71C3E ON base_stats (pokemon_id)');
        $this->addSql('CREATE TABLE item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, japanese VARCHAR(255) DEFAULT NULL, english VARCHAR(255) DEFAULT NULL, chinese VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE move (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER NOT NULL, accuracy INTEGER DEFAULT NULL, category VARCHAR(255) NOT NULL, cname VARCHAR(255) NOT NULL, ename VARCHAR(255) NOT NULL, jname VARCHAR(255) NOT NULL, power VARCHAR(255) DEFAULT NULL, pp INTEGER DEFAULT NULL, tm INTEGER DEFAULT NULL, CONSTRAINT FK_EF3E3778C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_EF3E3778C54C8C93 ON move (type_id)');
        $this->addSql('CREATE TABLE pokemon (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, english VARCHAR(255) NOT NULL, japanese VARCHAR(255) DEFAULT NULL, chinese VARCHAR(255) DEFAULT NULL, french VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE pokemon_type (pokemon_id INTEGER NOT NULL, type_id INTEGER NOT NULL, PRIMARY KEY(pokemon_id, type_id), CONSTRAINT FK_B077296A2FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B077296AC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_B077296A2FE71C3E ON pokemon_type (pokemon_id)');
        $this->addSql('CREATE INDEX IDX_B077296AC54C8C93 ON pokemon_type (type_id)');
        $this->addSql('CREATE TABLE type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, english VARCHAR(255) DEFAULT NULL, chinese VARCHAR(255) DEFAULT NULL, japanese VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE base_stats');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE move');
        $this->addSql('DROP TABLE pokemon');
        $this->addSql('DROP TABLE pokemon_type');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
