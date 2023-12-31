<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231103071410 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, titre VARCHAR(150) NOT NULL, contenue LONGTEXT NOT NULL, date DATETIME NOT NULL, image VARCHAR(200) NOT NULL, INDEX IDX_23A0E66A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_categories (article_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_62A97E97294869C (article_id), INDEX IDX_62A97E9A21214B7 (categories_id), PRIMARY KEY(article_id, categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE article_categories ADD CONSTRAINT FK_62A97E97294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_categories ADD CONSTRAINT FK_62A97E9A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66A76ED395');
        $this->addSql('ALTER TABLE article_categories DROP FOREIGN KEY FK_62A97E97294869C');
        $this->addSql('ALTER TABLE article_categories DROP FOREIGN KEY FK_62A97E9A21214B7');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_categories');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE user');
    }
}
