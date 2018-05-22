<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180522120238 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE web_portfolio_images ADD webportfolio_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE web_portfolio_images ADD CONSTRAINT FK_10900525EEE1C82C FOREIGN KEY (webportfolio_id) REFERENCES web_portfolio (id)');
        $this->addSql('CREATE INDEX IDX_10900525EEE1C82C ON web_portfolio_images (webportfolio_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE web_portfolio_images DROP FOREIGN KEY FK_10900525EEE1C82C');
        $this->addSql('DROP INDEX IDX_10900525EEE1C82C ON web_portfolio_images');
        $this->addSql('ALTER TABLE web_portfolio_images DROP webportfolio_id');
    }
}
