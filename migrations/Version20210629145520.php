<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210629145520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tv_show_category (tv_show_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_82897B525E3A35BB (tv_show_id), INDEX IDX_82897B5212469DE2 (category_id), PRIMARY KEY(tv_show_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tv_show_character (tv_show_id INT NOT NULL, character_id INT NOT NULL, INDEX IDX_FAF8B7A85E3A35BB (tv_show_id), INDEX IDX_FAF8B7A81136BE75 (character_id), PRIMARY KEY(tv_show_id, character_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tv_show_category ADD CONSTRAINT FK_82897B525E3A35BB FOREIGN KEY (tv_show_id) REFERENCES tv_show (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tv_show_category ADD CONSTRAINT FK_82897B5212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tv_show_character ADD CONSTRAINT FK_FAF8B7A85E3A35BB FOREIGN KEY (tv_show_id) REFERENCES tv_show (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tv_show_character ADD CONSTRAINT FK_FAF8B7A81136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tv_show_category');
        $this->addSql('DROP TABLE tv_show_character');
    }
}
