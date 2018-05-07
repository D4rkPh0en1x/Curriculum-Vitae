<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180504153506 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE web (id INT AUTO_INCREMENT NOT NULL, personalinfo_id INT DEFAULT NULL, label VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, INDEX IDX_15C938515034CA6C (personalinfo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hobbies (id INT AUTO_INCREMENT NOT NULL, personalinfo_id INT DEFAULT NULL, label VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_38CA341D5034CA6C (personalinfo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soft_skills (id INT AUTO_INCREMENT NOT NULL, personalinfo_id INT DEFAULT NULL, label VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_9AA6932A5034CA6C (personalinfo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acquired_skills (id INT AUTO_INCREMENT NOT NULL, personalinfo_id INT DEFAULT NULL, label VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_2D3FDDC45034CA6C (personalinfo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE languages (id INT AUTO_INCREMENT NOT NULL, personalinfo_id INT DEFAULT NULL, label VARCHAR(255) DEFAULT NULL, written VARCHAR(255) DEFAULT NULL, spoken VARCHAR(255) DEFAULT NULL, INDEX IDX_A0D153795034CA6C (personalinfo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE web ADD CONSTRAINT FK_15C938515034CA6C FOREIGN KEY (personalinfo_id) REFERENCES personal_info (id)');
        $this->addSql('ALTER TABLE hobbies ADD CONSTRAINT FK_38CA341D5034CA6C FOREIGN KEY (personalinfo_id) REFERENCES personal_info (id)');
        $this->addSql('ALTER TABLE soft_skills ADD CONSTRAINT FK_9AA6932A5034CA6C FOREIGN KEY (personalinfo_id) REFERENCES personal_info (id)');
        $this->addSql('ALTER TABLE acquired_skills ADD CONSTRAINT FK_2D3FDDC45034CA6C FOREIGN KEY (personalinfo_id) REFERENCES personal_info (id)');
        $this->addSql('ALTER TABLE languages ADD CONSTRAINT FK_A0D153795034CA6C FOREIGN KEY (personalinfo_id) REFERENCES personal_info (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE web');
        $this->addSql('DROP TABLE hobbies');
        $this->addSql('DROP TABLE soft_skills');
        $this->addSql('DROP TABLE acquired_skills');
        $this->addSql('DROP TABLE languages');
    }
}
