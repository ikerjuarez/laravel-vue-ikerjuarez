<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valoracions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("id_joc")->unsigned();
            $table->foreign("id_joc")->references("id")->on("jocs");
            $table->bigInteger("id_user")->unsigned();
            $table->foreign("id_user")->references("id")->on("users");
            $table->integer("valoracio");
            $table->text("comentari");
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
        Schema::dropIfExists('valoracions');
    }
};
