<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250415151949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE caller (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE incident (id INT AUTO_INCREMENT NOT NULL, operator_id_id INT DEFAULT NULL, team_id_id INT DEFAULT NULL, caller_id_id INT NOT NULL, localisation VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, reported_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_3D03A11A251935C (operator_id_id), INDEX IDX_3D03A11AB842D717 (team_id_id), INDEX IDX_3D03A11A638D1B94 (caller_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE operator (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, availability TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE incident ADD CONSTRAINT FK_3D03A11A251935C FOREIGN KEY (operator_id_id) REFERENCES operator (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE incident ADD CONSTRAINT FK_3D03A11AB842D717 FOREIGN KEY (team_id_id) REFERENCES team (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE incident ADD CONSTRAINT FK_3D03A11A638D1B94 FOREIGN KEY (caller_id_id) REFERENCES caller (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE incident DROP FOREIGN KEY FK_3D03A11A251935C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE incident DROP FOREIGN KEY FK_3D03A11AB842D717
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE incident DROP FOREIGN KEY FK_3D03A11A638D1B94
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE caller
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE incident
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE operator
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE team
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
