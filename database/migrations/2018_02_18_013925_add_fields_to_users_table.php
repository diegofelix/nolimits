<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('cpf')->nullable();
            $table->string('street')->nullable();
            $table->integer('number')->unsigned()->nullable();
            $table->string('complement')->nullable();
            $table->string('district')->nullable();
            $table->integer('postal_code')->unsigned()->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->default('Brazil');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumns([
                'phone',
                'cpf',
                'street',
                'number',
                'complement',
                'district',
                'postal_code',
                'city',
                'state',
                'country',
            ]);
        });
    }
}
