<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function ($table) {
            $table->renameColumn('path', 'filename');
        });

        Schema::table('images', function ($table) {
            $table->string('realname')->nullable()->after('filename');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function ($table) {
            $table->renameColumn('filename', 'path');
        });

        Schema::table('images', function ($table) {
            $table->dropColumn('realname');
        });
    }
}
