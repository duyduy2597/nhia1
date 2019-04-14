<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $date = date_create();
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        //create table user
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string(50)->notNull()->unique(),
            'cmnd' => $this->string(12)->notNull()->unique(),
            'attributes' => $this->getDb()->getSchema()->createColumnSchemaBuilder('LONGTEXT'),
            'role_id' => $this->integer()->notNull(),
            'isActive' => $this->boolean()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'isDeleted' => $this->boolean()->defaultValue(0),
            'deletedUserId' => $this->integer(),
            'deletedTime'=> $this->integer(),
        ], $tableOptions);

        $this->createTable('category', [
            'cat_id' => $this->primaryKey(),
            'cat_name' => $this->string(),
            'prent_id' => $this->integer(),
            'cat_icon' => $this->string(),
            'meta_keyword' => $this->string(),
            'meta_description' => $this->string(),
            'fullParent' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'isDeleted' => $this->boolean()->defaultValue(0),
            'deletedUserId' => $this->integer(),
            'deletedTime'=> $this->integer(),
        ], $tableOptions);

        $this->createTable('product', [
            'pro_id' => $this->primaryKey(),
            'pro_name' => $this->string()->notNull(),
            'pro_image' => $this->string()->notNull(),
            'pro_price' => $this->integer()->notNull(),
            'pro_sale_off' => $this->string(),
            'cat_id' => $this->integer(),
            'supplier' => $this->integer(),
            'pro_size_id' => $this->integer(),
            'pro_color_id' => $this->integer(),
            'pro_made_id' => $this->integer(),
            'description' => $this->string(),
            'date_sale_off' => $this->datetime(),
            'end_cate_sale' => $this->datetime(),
            'meta_keyword' => $this->string(),
            'meta_description' => $this->string(),
            'comment' => $this->getDb()->getSchema()->createColumnSchemaBuilder('LONGTEXT'),
            'complaint' => $this->getDb()->getSchema()->createColumnSchemaBuilder('LONGTEXT'),  
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'isDeleted' => $this->boolean()->defaultValue(0),
            'deletedUserId' => $this->integer(),
            'deletedTime'=> $this->integer(),
        ], $tableOptions);

        $this->createTable('made', [
            'made_id' => $this->primaryKey(),
            'made_name' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'isDeleted' => $this->boolean()->defaultValue(0),
            'deletedUserId' => $this->integer(),
            'deletedTime'=> $this->integer(),
        ], $tableOptions);

        $this->createTable('color', [
            'color_id' => $this->primaryKey(),
            'color_name' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'isDeleted' => $this->boolean()->defaultValue(0),
            'deletedUserId' => $this->integer(),
            'deletedTime'=> $this->integer(),
        ], $tableOptions);

        $this->createTable('size', [
            'size_id' => $this->primaryKey(),
            'size_name' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'isDeleted' => $this->boolean()->defaultValue(0),
            'deletedUserId' => $this->integer(),
            'deletedTime'=> $this->integer(),
        ], $tableOptions);

        $this->createTable('wishlist', [
            'wish_id' => $this->primaryKey(),
            'wish_name' => $this->string()->notNull(),
            'pro_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'isDeleted' => $this->boolean()->defaultValue(0),
            'deletedUserId' => $this->integer(),
            'deletedTime'=> $this->integer(),
        ], $tableOptions);

        $this->createTable('supplier', [
            'sup_id' => $this->primaryKey(),
            'sup_name' => $this->string()->notNull(),
            'mobile' => $this->char(11)->notNull(),
            'address' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'isDeleted' => $this->boolean()->defaultValue(0),
            'deletedUserId' => $this->integer(),
            'deletedTime'=> $this->integer(),
        ], $tableOptions);

        $this->createTable('order', [
            'order_id' => $this->primaryKey(),
            'use_id' => $this->string()->notNull(),
            'use_name' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'mobile' => $this->char(11)->notNull(),
            'address' => $this->string()->notNull(),
            'user_ship' => $this->string()->notNull(),
            'mobile_ship' => $this->string(11)->notNull(),
            'address_ship' => $this->string()->notNull(),
            'request' => $this->string(11)->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'details' => $this->getDb()->getSchema()->createColumnSchemaBuilder('LONGTEXT'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'isDeleted' => $this->boolean()->defaultValue(0),
            'deletedUserId' => $this->integer(),
            'deletedTime'=> $this->integer(),
        ], $tableOptions);

        $this->createTable('order_detail', [
            'detail_id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'pro_id' => $this->integer(),
            'pro_price' => $this->integer(),
            'pro_amount' => $this->integer(),//soluong
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'isDeleted' => $this->boolean()->defaultValue(0),
            'deletedUserId' => $this->integer(),
            'deletedTime'=> $this->integer(),
        ], $tableOptions);

        $this->createTable('payment', [
            'id' => $this->primaryKey(),
            'payment_id' => $this->string()->notNull(),
            'order_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'isDeleted' => $this->boolean()->defaultValue(0),
            'deletedUserId' => $this->integer(),
            'deletedTime'=> $this->integer(),

        ], $tableOptions);   
        $this->createTable('deliver',[
            'del_id' => $this->primaryKey(),
            'del_name' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'isDeleted' => $this->boolean()->defaultValue(0),
            'deletedUserId' => $this->integer(),
            'deletedTime'=> $this->integer(),
        ], $tableOptions); 

        $this->insert('user', [          
            'username' => 'admin',
            'password_hash' => Yii::$app->security->generatePasswordHash("123123"),
            'auth_key' => 'test100key',
            'email' => 'admin@gmail.com',
            'cmnd' =>'123456789',
            'created_at' => date_timestamp_get($date),
            'updated_at' => date_timestamp_get($date),
            'role_id' => 1,
        ]);
        $this->insert('user', [          
            'username' => 'datdat',
            'password_hash' => Yii::$app->security->generatePasswordHash("123123"),
            'auth_key' => 'test100key',
            'email' => 'datdat@gmail.com',
            'cmnd' =>'23455432',
            'created_at' => date_timestamp_get($date),
            'updated_at' => date_timestamp_get($date),
            'role_id' => 2,
        ]);

        $this->insert('category', [          
            'cat_name' => 'Nam',
            'prent_id' => 0,
            'cat_icon' => '',
            'meta_keyword' => '',
            'meta_description' =>'',
            'fullParent' => '',
            'created_at' => date_timestamp_get($date),
            'updated_at' => date_timestamp_get($date),
        ]);

        $this->insert('category', [          
            'cat_name' => 'Quần',
            'prent_id' => 1,
            'cat_icon' => '',
            'meta_keyword' => '',
            'meta_description' =>'',
            'fullParent' => '1',
            'created_at' => date_timestamp_get($date),
            'updated_at' => date_timestamp_get($date),
        ]);

        $this->insert('category', [          
            'cat_name' => 'Jean',
            'prent_id' => 2,
            'cat_icon' => '',
            'meta_keyword' => '',
            'meta_description' =>'',
            'fullParent' => '1,2',
            'created_at' => date_timestamp_get($date),
            'updated_at' => date_timestamp_get($date),
        ]);

        $this->insert('category', [          
            'cat_name' => 'Jogger',
            'prent_id' => 2,
            'cat_icon' => '',
            'meta_keyword' => '',
            'meta_description' =>'',
            'fullParent' => '1,2',
            'created_at' => date_timestamp_get($date),
            'updated_at' => date_timestamp_get($date),
        ]);

        $this->insert('category', [          
            'cat_name' => 'Quần tây',
            'prent_id' => 2,
            'cat_icon' => '',
            'meta_keyword' => '',
            'meta_description' =>'',
            'fullParent' => '1,2',
            'created_at' => date_timestamp_get($date),
            'updated_at' => date_timestamp_get($date),
        ]);

        $this->insert('category', [          
            'cat_name' => 'Áo',
            'prent_id' => 1,
            'cat_icon' => '',
            'meta_keyword' => '',
            'meta_description' =>'',
            'fullParent' => '1',
            'created_at' => date_timestamp_get($date),
            'updated_at' => date_timestamp_get($date),
        ]);

        $this->insert('category', [          
            'cat_name' => 'Giày',
            'prent_id' => 1,
            'cat_icon' => '',
            'meta_keyword' => '',
            'meta_description' =>'',
            'fullParent' => '1',
            'created_at' => date_timestamp_get($date),
            'updated_at' => date_timestamp_get($date),
        ]);

        $this->insert('category', [          
            'cat_name' => 'Nữ',
            'prent_id' => 0,
            'cat_icon' => '',
            'meta_keyword' => '',
            'meta_description' =>'',
            'fullParent' => '',
            'created_at' => date_timestamp_get($date),
            'updated_at' => date_timestamp_get($date),
        ]);

        $this->insert('category', [          
            'cat_name' => 'Quần',
            'prent_id' => 8,
            'cat_icon' => '',
            'meta_keyword' => '',
            'meta_description' =>'',
            'fullParent' => '8',
            'created_at' => date_timestamp_get($date),
            'updated_at' => date_timestamp_get($date),
        ]);

        $this->insert('category', [          
            'cat_name' => 'Áo',
            'prent_id' => 8,
            'cat_icon' => '',
            'meta_keyword' => '',
            'meta_description' =>'',
            'fullParent' => '8',
            'created_at' => date_timestamp_get($date),
            'updated_at' => date_timestamp_get($date),
        ]);

        $this->insert('category', [          
            'cat_name' => 'Giày',
            'prent_id' => 8,
            'cat_icon' => '',
            'meta_keyword' => '',
            'meta_description' =>'',
            'fullParent' => '8',
            'created_at' => date_timestamp_get($date),
            'updated_at' => date_timestamp_get($date),
        ]); 

    }

    public function down()
    {   
        $this->dropTable('deliver');
        $this->dropTable('payment');
        $this->dropTable('order_detail');
        $this->dropTable('order');
        $this->dropTable('supplier');
        $this->dropTable('wishlist');
        $this->dropTable('size');
        $this->dropTable('color');
        $this->dropTable('made');
        $this->dropTable('product');
        $this->dropTable('category');
        $this->dropTable('{{%user}}');         
    }
}
