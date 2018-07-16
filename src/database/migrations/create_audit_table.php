<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('audit.drivers.database.connection'))
                ->create(config('audit.drivers.database.table'), function (Blueprint $table) {
                    $table->increments('id');
                    # Columns
                    foreach(config('audit.guards') as $guard => $values)
                    {
                        $table->unsignedInteger(config('audit.guards.' . $guard . '.foreign_key'))->nullable();
                    }
                    $table->morphs('auditable');
                    $table->string('event');
                    $table->string('action');
                    $table->string('action_model')->nullable();
                    $table->integer('action_id')->nullable();
                    $table->text('old_values')->nullable();
                    $table->text('new_values')->nullable();
                    $table->string('url')->nullable();
                    $table->ipAddress('ip_address')->nullable();
                    $table->string('user_agent')->nullable();
                    $table->timestamps();
                });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(config('audit.drivers.database.connection'))
                ->drodropIfExistsp(config('audit.drivers.database.table'));
    }
}
