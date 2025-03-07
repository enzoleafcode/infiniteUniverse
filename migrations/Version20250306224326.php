<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250306224326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart_goodie (cart_id INT NOT NULL, goodie_id INT NOT NULL, INDEX IDX_14A9DD121AD5CDBF (cart_id), INDEX IDX_14A9DD12388135BB (goodie_id), PRIMARY KEY(cart_id, goodie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart_goodie ADD CONSTRAINT FK_14A9DD121AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_goodie ADD CONSTRAINT FK_14A9DD12388135BB FOREIGN KEY (goodie_id) REFERENCES goodie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article ADD user_id INT DEFAULT NULL, ADD article_category_id INT NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6688C5F785 FOREIGN KEY (article_category_id) REFERENCES article_category (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66A76ED395 ON article (user_id)');
        $this->addSql('CREATE INDEX IDX_23A0E6688C5F785 ON article (article_category_id)');
        $this->addSql('ALTER TABLE cart ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_BA388B7A76ED395 ON cart (user_id)');
        $this->addSql('ALTER TABLE goodie ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE goodie ADD CONSTRAINT FK_1A2DBF4D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_1A2DBF4D12469DE2 ON goodie (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_goodie DROP FOREIGN KEY FK_14A9DD121AD5CDBF');
        $this->addSql('ALTER TABLE cart_goodie DROP FOREIGN KEY FK_14A9DD12388135BB');
        $this->addSql('DROP TABLE cart_goodie');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66A76ED395');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6688C5F785');
        $this->addSql('DROP INDEX IDX_23A0E66A76ED395 ON article');
        $this->addSql('DROP INDEX IDX_23A0E6688C5F785 ON article');
        $this->addSql('ALTER TABLE article DROP user_id, DROP article_category_id');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7A76ED395');
        $this->addSql('DROP INDEX IDX_BA388B7A76ED395 ON cart');
        $this->addSql('ALTER TABLE cart DROP user_id');
        $this->addSql('ALTER TABLE goodie DROP FOREIGN KEY FK_1A2DBF4D12469DE2');
        $this->addSql('DROP INDEX IDX_1A2DBF4D12469DE2 ON goodie');
        $this->addSql('ALTER TABLE goodie DROP category_id');
    }
}
