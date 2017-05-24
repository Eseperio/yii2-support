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
        $this->createTable(
            self::$_tableName, [
                'id'         => $this->primaryKey(),
                'content'    => $this->text(),
                'ticket_id'  => $this->integer(),
                'created_at' => $this->timestamp()->defaultValue(null),
                'updated_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            ]
        );

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
