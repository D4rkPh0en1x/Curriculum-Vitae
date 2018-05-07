<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180507154254 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE self_evaluation_categories (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE self_evaluation ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE self_evaluation ADD CONSTRAINT FK_80451CDABCF5E72D FOREIGN KEY (categorie_id) REFERENCES self_evaluation_categories (id)');
        $this->addSql('CREATE INDEX IDX_80451CDABCF5E72D ON self_evaluation (categorie_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE self_evaluation DROP FOREIGN KEY FK_80451CDABCF5E72D');
        $this->addSql('DROP TABLE self_evaluation_categories');
        $this->addSql('DROP INDEX IDX_80451CDABCF5E72D ON self_evaluation');
        $this->addSql('ALTER TABLE self_evaluation DROP categorie_id');
    }
}
