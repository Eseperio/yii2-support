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
                'client_id'    => $this->integer(),
                'site_id'      => $this->integer(),
                'subject'      => $this->string(255)->notNull(),
                'content'      => $this->text(),
                'status_id'    => $this->integer(),
                'priority_id'  => $this->integer(),
                'category_id'  => $this->integer(),
                'completed_at' => $this->timestamp()->defaultValue(null),
                'created_at'   => $this->timestamp()->defaultValue(null),
                'updated_at'   => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            ]
        );

        $this->addForeignKey(
            'FK_T_client_id',
            self::$_tableName,
            'client_id',
            '{{%client}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_T_site_id',
            self::$_tableName,
            'site_id',
            '{{%site}}',
            'id',
            'CASCADE',
            'CASCADE'
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