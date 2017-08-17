<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ticket_comment`.
 */
class m170524_145736_create_ticket_comment_table extends Migration
{
    /**
     * @var string
     */
    private static $_tableName = '{{%ticket_comment}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::$_tableName, [
            'id'         => $this->primaryKey()->unsigned(),
            'content'    => $this->text(),
            'file'       => $this->string(1000)->null(),
            'ticket_id'  => $this->integer()->unsigned(),
            'created_by' => $this->integer(),
            'created_at' => $this->timestamp()->defaultValue(null),
            'updated_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ], $tableOptions);

        $this->addForeignKey(
            'FK_TC_ticket_id',
            self::$_tableName,
            'ticket_id',
            '{{%ticket}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable(self::$_tableName);
    }
}
