<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200402175647 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_movies_relation_types (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_movies DROP FOREIGN KEY FK_A34CF60D53F590A4');
        $this->addSql('ALTER TABLE user_movies DROP FOREIGN KEY FK_A34CF60DA76ED395');
        $this->addSql('DROP INDEX IDX_A34CF60DA76ED395 ON user_movies');
        $this->addSql('DROP INDEX IDX_A34CF60D53F590A4 ON user_movies');
        $this->addSql('ALTER TABLE user_movies ADD id INT AUTO_INCREMENT NOT NULL, ADD user_id_id INT NOT NULL, ADD movie_id_id INT NOT NULL, ADD relation_type INT NOT NULL, DROP user_id, DROP movies_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE user_movies ADD CONSTRAINT FK_A34CF60D9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_movies ADD CONSTRAINT FK_A34CF60D10684CB FOREIGN KEY (movie_id_id) REFERENCES movies (id)');
        $this->addSql('CREATE INDEX IDX_A34CF60D9D86650F ON user_movies (user_id_id)');
        $this->addSql('CREATE INDEX IDX_A34CF60D10684CB ON user_movies (movie_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_movies_relation_types');
        $this->addSql('ALTER TABLE user_movies MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE user_movies DROP FOREIGN KEY FK_A34CF60D9D86650F');
        $this->addSql('ALTER TABLE user_movies DROP FOREIGN KEY FK_A34CF60D10684CB');
        $this->addSql('DROP INDEX IDX_A34CF60D9D86650F ON user_movies');
        $this->addSql('DROP INDEX IDX_A34CF60D10684CB ON user_movies');
        $this->addSql('ALTER TABLE user_movies DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE user_movies ADD user_id INT NOT NULL, ADD movies_id INT NOT NULL, DROP id, DROP user_id_id, DROP movie_id_id, DROP relation_type');
        $this->addSql('ALTER TABLE user_movies ADD CONSTRAINT FK_A34CF60D53F590A4 FOREIGN KEY (movies_id) REFERENCES movies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_movies ADD CONSTRAINT FK_A34CF60DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_A34CF60DA76ED395 ON user_movies (user_id)');
        $this->addSql('CREATE INDEX IDX_A34CF60D53F590A4 ON user_movies (movies_id)');
        $this->addSql('ALTER TABLE user_movies ADD PRIMARY KEY (user_id, movies_id)');
    }
}
