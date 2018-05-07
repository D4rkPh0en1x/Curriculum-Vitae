<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180504152738 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE personal_info (id INT AUTO_INCREMENT NOT NULL, surname VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, birthdate DATE DEFAULT NULL, birthplace VARCHAR(255) DEFAULT NULL, citizenship VARCHAR(255) DEFAULT NULL, maritalstatus VARCHAR(255) DEFAULT NULL, children INT DEFAULT NULL, address LONGTEXT DEFAULT NULL, salary VARCHAR(2048) DEFAULT NULL, mobilephone VARCHAR(255) DEFAULT NULL, smoker TINYINT(1) DEFAULT NULL, drivinglicence VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE education_degree (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, grade VARCHAR(255) DEFAULT NULL, mention VARCHAR(255) DEFAULT NULL, educationalfacility VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diploma (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE certifications (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE self_evaluation (id INT AUTO_INCREMENT NOT NULL, brandapplication VARCHAR(255) DEFAULT NULL, product VARCHAR(255) DEFAULT NULL, evaluation INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portfolio (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, photourl VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, technic VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eval_categories (id INT AUTO_INCREMENT NOT NULL, selfevaluation_id INT DEFAULT NULL, label VARCHAR(255) DEFAULT NULL, INDEX IDX_78C525D284150C87 (selfevaluation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE eval_categories ADD CONSTRAINT FK_78C525D284150C87 FOREIGN KEY (selfevaluation_id) REFERENCES self_evaluation (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE eval_categories DROP FOREIGN KEY FK_78C525D284150C87');
        $this->addSql('DROP TABLE personal_info');
        $this->addSql('DROP TABLE education_degree');
        $this->addSql('DROP TABLE diploma');
        $this->addSql('DROP TABLE certifications');
        $this->addSql('DROP TABLE self_evaluation');
        $this->addSql('DROP TABLE portfolio');
        $this->addSql('DROP TABLE eval_categories');
    }
}
