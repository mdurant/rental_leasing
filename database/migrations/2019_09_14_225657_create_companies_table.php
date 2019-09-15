<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_company', 300);
            $table->string('rut')->unique();
            $table->string('address');
            $table->string('legal_representative'); //datos del representante
            $table->string('legal_rut');
            $table->string('legal_email');
            $table->string('company_email');
            $table->string('image')->nullable();
            $table->string('code_sii');
            $table->string('code_dte_sii');
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
        Schema::dropIfExists('companies');
    }
}
