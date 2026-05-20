<?php
foreach (glob('database/migrations/*_create_carts_table.php') as $f) rename($f, str_replace('150144', '150150', $f));
foreach (glob('database/migrations/*_create_orders_table.php') as $f) rename($f, str_replace('150145', '150151', $f));
foreach (glob('database/migrations/*_create_order_items_table.php') as $f) rename($f, str_replace('150146', '150152', $f));
