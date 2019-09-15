<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table Entidades
        Schema::create('entities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rut')->unique();
            $table->string('name');
            $table->string('last_name');
            $table->unsignedBigInteger('countries_id');
            $table->foreign('countries_id')->references('id')->on('countries');
            $table->string('address');
            $table->unsignedBigInteger('regions_id');
            $table->foreign('regions_id')->references('id')->on('regions');
            $table->unsignedBigInteger('cities_id');
            $table->foreign('cities_id')->references('id')->on('cities');
            $table->string('code')->unique();
            $table->string('name_company')->unique();
            $table->string('activity');
            $table->string('business_agent');
            $table->string('phone_business_agent');
            $table->string('email_business_agent');
            $table->string('email_dte');
            $table->string('email_company');
            $table->string('dispatch_office');
            $table->string('credit_type'); //tipo de credito financiado
            $table->enum('entity_type', ['C', 'P', 'C-P'])->unique(); // Cliente, Proveedor, Ambos
            $table->enum('state', ['active', 'inactive', 'pending'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });

        // Table Productos
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('barcode')->unique();
            $table->string('type'); // tipo de familia producto
            $table->unsignedBigInteger('warehouses_id'); // relacion con tabla de Bodega/Almacen
            $table->foreign('warehouses_id')->references('id')->on('warehouses');  // Bodega - Almacen
            $table->unsignedBigInteger('categories_products_id'); //Relacion
            $table->foreign('categories_products_id')->references('id')->on('categories_products');  //Tipo de Producto
            $table->unsignedBigInteger('entities_id'); // relacion con tabla de Entidades (Clientes/Proveedores)
            $table->foreign('entities_id')->references('id')->on('entities');  // Selecciona Proveedor
            $table->float('purchase_price')->nullable()->default(123.4567);  //Precio Compra
            $table->integer('tax_value')->unsigned()->nullable()->default(12);  //Impuesto
            $table->float('unit_price')->nullable()->default(123.4567); // precio unitario
            $table->integer('stock')->unsigned()->nullable()->default(12);
            $table->integer('minimum_stock')->unsigned()->nullable()->default(12);
            $table->integer('discount')->unsigned()->nullable()->default(12);
            $table->longText('description')->nullable();
            $table->enum('state', ['active', 'inactive', 'pending'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entities');
        Schema::dropIfExists('products');
    }
}
