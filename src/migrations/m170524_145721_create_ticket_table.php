<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ticket`.
 */
class m170524_145721_create_ticket_table extends Migration
{
    /**
     * @var string
     */
    private static $_tableName = '{{%ticket}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable(
            self::$_tableName, [
                'id'           => $this->primaryKey(),
                'subject'      => $this->string(255)->notNull(),
                'content'      => $this->text(),
                'file'         => $this->string(1000)->null(),
                'status_id'    => $this->integer(),
                'priority_id'  => $this->integer(),
                'category_id'  => $this->integer(),
                'created_by'   => $this->integer(),
                'completed_at' => $this->timestamp()->defaultValue(null),
                'created_at'   => $this->timestamp()->defaultValue(null),
                'updated_at'   => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            ]
        );

        $this->addForeignKey(
            'FK_T_status_id',
            self::$_tableName,
            'status_id',
            '{{%ticket_status}}',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_T_priority_id',
            self::$_tableName,
            'priority_id',
            '{{%ticket_priority}}',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_T_category_id',
            self::$_tableName,
            'category_id',
            '{{%ticket_category}}',
            'id',
            'SET NULL',
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
