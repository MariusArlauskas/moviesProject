<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200402180000 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_movies DROP FOREIGN KEY FK_A34CF60D10684CB');
        $this->addSql('ALTER TABLE user_movies DROP FOREIGN KEY FK_A34CF60D9D86650F');
        $this->addSql('DROP INDEX IDX_A34CF60D10684CB ON user_movies');
        $this->addSql('DROP INDEX IDX_A34CF60D9D86650F ON user_movies');
        $this->addSql('ALTER TABLE user_movies ADD user_id INT NOT NULL, ADD movie_id INT NOT NULL, DROP user_id_id, DROP movie_id_id');
        $this->addSql('ALTER TABLE user_movies ADD CONSTRAINT FK_A34CF60DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_movies ADD CONSTRAINT FK_A34CF60D8F93B6FC FOREIGN KEY (movie_id) REFERENCES movies (id)');
        $this->addSql('CREATE INDEX IDX_A34CF60DA76ED395 ON user_movies (user_id)');
        $this->addSql('CREATE INDEX IDX_A34CF60D8F93B6FC ON user_movies (movie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_movies DROP FOREIGN KEY FK_A34CF60DA76ED395');
        $this->addSql('ALTER TABLE user_movies DROP FOREIGN KEY FK_A34CF60D8F93B6FC');
        $this->addSql('DROP INDEX IDX_A34CF60DA76ED395 ON user_movies');
        $this->addSql('DROP INDEX IDX_A34CF60D8F93B6FC ON user_movies');
        $this->addSql('ALTER TABLE user_movies ADD user_id_id INT NOT NULL, ADD movie_id_id INT NOT NULL, DROP user_id, DROP movie_id');
        $this->addSql('ALTER TABLE user_movies ADD CONSTRAINT FK_A34CF60D10684CB FOREIGN KEY (movie_id_id) REFERENCES movies (id)');
        $this->addSql('ALTER TABLE user_movies ADD CONSTRAINT FK_A34CF60D9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A34CF60D10684CB ON user_movies (movie_id_id)');
        $this->addSql('CREATE INDEX IDX_A34CF60D9D86650F ON user_movies (user_id_id)');
    }
}
