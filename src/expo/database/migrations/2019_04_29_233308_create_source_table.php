<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Table with structure sources (Key of user or link of service via cron
         */
        Schema::create('sources', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id')->unsigned();
            $table->string('link')->comment('Link from cron source');
            $table->string('key')->comment('User auth key source');
            $table->enum('type', ['cron', 'user']);
            $table->timestamps();
        });

        /**
         * View templates. Contains the source from
         */
        Schema::create('templates', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('source_id')->unsigned();
            $table->string('name', 50);
            $table->mediumText('data');
            $table->timestamps();

            $table->foreign('source_id')->references('id')->on('sources')->onUpdate('cascade')->onDelete('restrict');
            $table->index('name','index_name');
        });

        /**
         * Template blocks. Contains the template position
         */
        Schema::create('blocks', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('tmpl_id')->unsigned();
            $table->smallInteger('position')->unsigned();
            $table->enum('block_type', ['graph', 'number'])->default('number');
            $table->timestamps();

            $table->foreign('tmpl_id')->references('id')->on('templates')->onUpdate('cascade')->onDelete('restrict');

        });

        Schema::create('number_recs', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('block_id')->unsigned();
            $table->bigInteger('source_id')->unsigned();
            $table->double('content', 50, 15);
            $table->timestamps();

            $table->foreign('block_id')->references('id')->on('blocks')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('source_id')->references('id')->on('sources')->onUpdate('cascade')->onDelete('restrict');
        });

        Schema::create('graph_recs', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('block_id')->unsigned();
            $table->bigInteger('source_id')->unsigned();
            $table->json('content');
            $table->enum('graph_type', ['line', 'pie'])->default('line');
            $table->timestamp('graph_start')->nullable();
            $table->timestamp('graph_finish')->nullable();
            $table->timestamps();

            $table->foreign('block_id')->references('id')->on('blocks')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('source_id')->references('id')->on('sources')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sources');
        Schema::dropIfExists('templates');
        Schema::dropIfExists('blocks');
        Schema::dropIfExists('number_recs');
        Schema::dropIfExists('graph_recs');
    }
}
