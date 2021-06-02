<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210601091207 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actors (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(200) NOT NULL, bio TEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, musical_id INT NOT NULL, author_id INT UNSIGNED DEFAULT NULL, content LONGTEXT NOT NULL, INDEX IDX_5F9E962A839489F9 (musical_id), INDEX IDX_5F9E962AF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composers (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(200) NOT NULL, bio TEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE directors (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(200) NOT NULL, bio TEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favourites (id INT AUTO_INCREMENT NOT NULL, musical_id INT DEFAULT NULL, INDEX IDX_7F07C501839489F9 (musical_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE musicals (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, year INT NOT NULL, place VARCHAR(100) NOT NULL, description TEXT NOT NULL, history TEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE musical_director (musical_id INT NOT NULL, director_id INT NOT NULL, INDEX IDX_25173744839489F9 (musical_id), INDEX IDX_25173744899FB366 (director_id), PRIMARY KEY(musical_id, director_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE musical_composer (musical_id INT NOT NULL, composer_id INT NOT NULL, INDEX IDX_A3F4E26C839489F9 (musical_id), INDEX IDX_A3F4E26C7A8D2620 (composer_id), PRIMARY KEY(musical_id, composer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE musical_actor (musical_id INT NOT NULL, actor_id INT NOT NULL, INDEX IDX_FA46311D839489F9 (musical_id), INDEX IDX_FA46311D10DAF24A (actor_id), PRIMARY KEY(musical_id, actor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE songs (id INT AUTO_INCREMENT NOT NULL, musical_id INT NOT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_BAECB19B839489F9 (musical_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT UNSIGNED AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, login VARCHAR(100) NOT NULL, name VARCHAR(255) DEFAULT NULL, UNIQUE INDEX email_idx (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A839489F9 FOREIGN KEY (musical_id) REFERENCES musicals (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AF675F31B FOREIGN KEY (author_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE favourites ADD CONSTRAINT FK_7F07C501839489F9 FOREIGN KEY (musical_id) REFERENCES musicals (id)');
        $this->addSql('ALTER TABLE musical_director ADD CONSTRAINT FK_25173744839489F9 FOREIGN KEY (musical_id) REFERENCES musicals (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE musical_director ADD CONSTRAINT FK_25173744899FB366 FOREIGN KEY (director_id) REFERENCES directors (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE musical_composer ADD CONSTRAINT FK_A3F4E26C839489F9 FOREIGN KEY (musical_id) REFERENCES musicals (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE musical_composer ADD CONSTRAINT FK_A3F4E26C7A8D2620 FOREIGN KEY (composer_id) REFERENCES composers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE musical_actor ADD CONSTRAINT FK_FA46311D839489F9 FOREIGN KEY (musical_id) REFERENCES musicals (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE musical_actor ADD CONSTRAINT FK_FA46311D10DAF24A FOREIGN KEY (actor_id) REFERENCES actors (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE songs ADD CONSTRAINT FK_BAECB19B839489F9 FOREIGN KEY (musical_id) REFERENCES musicals (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE musical_actor DROP FOREIGN KEY FK_FA46311D10DAF24A');
        $this->addSql('ALTER TABLE musical_composer DROP FOREIGN KEY FK_A3F4E26C7A8D2620');
        $this->addSql('ALTER TABLE musical_director DROP FOREIGN KEY FK_25173744899FB366');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A839489F9');
        $this->addSql('ALTER TABLE favourites DROP FOREIGN KEY FK_7F07C501839489F9');
        $this->addSql('ALTER TABLE musical_director DROP FOREIGN KEY FK_25173744839489F9');
        $this->addSql('ALTER TABLE musical_composer DROP FOREIGN KEY FK_A3F4E26C839489F9');
        $this->addSql('ALTER TABLE musical_actor DROP FOREIGN KEY FK_FA46311D839489F9');
        $this->addSql('ALTER TABLE songs DROP FOREIGN KEY FK_BAECB19B839489F9');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AF675F31B');
        $this->addSql('DROP TABLE actors');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE composers');
        $this->addSql('DROP TABLE directors');
        $this->addSql('DROP TABLE favourites');
        $this->addSql('DROP TABLE musicals');
        $this->addSql('DROP TABLE musical_director');
        $this->addSql('DROP TABLE musical_composer');
        $this->addSql('DROP TABLE musical_actor');
        $this->addSql('DROP TABLE songs');
        $this->addSql('DROP TABLE users');
    }
}
