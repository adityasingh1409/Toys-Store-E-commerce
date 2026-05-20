<?php
$migrationsDir = __DIR__ . '/database/migrations';
$files = scandir($migrationsDir);

foreach ($files as $file) {
    $path = $migrationsDir . '/' . $file;
    if (strpos($file, 'add_role_to_users_table') !== false) {
        $content = file_get_contents($path);
        $content = str_replace(
            "public function up(): void\n    {\n        Schema::table('users', function (Blueprint \$table) {\n            //\n        });\n    }",
            "public function up(): void\n    {\n        Schema::table('users', function (Blueprint \$table) {\n            \$table->string('role')->default('customer');\n        });\n    }",
            $content
        );
        $content = str_replace(
            "public function down(): void\n    {\n        Schema::table('users', function (Blueprint \$table) {\n            //\n        });\n    }",
            "public function down(): void\n    {\n        Schema::table('users', function (Blueprint \$table) {\n            \$table->dropColumn('role');\n        });\n    }",
            $content
        );
        file_put_contents($path, $content);
    } elseif (strpos($file, 'create_categories_table') !== false) {
        $content = file_get_contents($path);
        $content = preg_replace(
            "/Schema::create\('categories', function \(Blueprint \\\$table\) \{.*?\}\);/s",
            "Schema::create('categories', function (Blueprint \$table) {\n            \$table->id();\n            \$table->string('name');\n            \$table->text('description')->nullable();\n            \$table->timestamps();\n        });",
            $content
        );
        file_put_contents($path, $content);
    } elseif (strpos($file, 'create_products_table') !== false) {
        $content = file_get_contents($path);
        $content = preg_replace(
            "/Schema::create\('products', function \(Blueprint \\\$table\) \{.*?\}\);/s",
            "Schema::create('products', function (Blueprint \$table) {\n            \$table->id();\n            \$table->string('name');\n            \$table->text('description')->nullable();\n            \$table->decimal('price', 10, 2);\n            \$table->integer('stock')->default(0);\n            \$table->string('image')->nullable();\n            \$table->foreignId('category_id')->constrained()->onDelete('cascade');\n            \$table->timestamps();\n        });",
            $content
        );
        file_put_contents($path, $content);
    } elseif (strpos($file, 'create_carts_table') !== false) {
        $content = file_get_contents($path);
        $content = preg_replace(
            "/Schema::create\('carts', function \(Blueprint \\\$table\) \{.*?\}\);/s",
            "Schema::create('carts', function (Blueprint \$table) {\n            \$table->id();\n            \$table->foreignId('user_id')->constrained()->onDelete('cascade');\n            \$table->foreignId('product_id')->constrained()->onDelete('cascade');\n            \$table->integer('quantity')->default(1);\n            \$table->timestamps();\n        });",
            $content
        );
        file_put_contents($path, $content);
    } elseif (strpos($file, 'create_orders_table') !== false) {
        $content = file_get_contents($path);
        $content = preg_replace(
            "/Schema::create\('orders', function \(Blueprint \\\$table\) \{.*?\}\);/s",
            "Schema::create('orders', function (Blueprint \$table) {\n            \$table->id();\n            \$table->foreignId('user_id')->constrained()->onDelete('cascade');\n            \$table->decimal('total_price', 10, 2);\n            \$table->string('status')->default('pending');\n            \$table->text('address');\n            \$table->timestamps();\n        });",
            $content
        );
        file_put_contents($path, $content);
    } elseif (strpos($file, 'create_order_items_table') !== false) {
        $content = file_get_contents($path);
        $content = preg_replace(
            "/Schema::create\('order_items', function \(Blueprint \\\$table\) \{.*?\}\);/s",
            "Schema::create('order_items', function (Blueprint \$table) {\n            \$table->id();\n            \$table->foreignId('order_id')->constrained()->onDelete('cascade');\n            \$table->foreignId('product_id')->constrained()->onDelete('cascade');\n            \$table->integer('quantity');\n            \$table->decimal('price', 10, 2);\n            \$table->timestamps();\n        });",
            $content
        );
        file_put_contents($path, $content);
    }
}
echo "Migrations updated successfully.\n";
