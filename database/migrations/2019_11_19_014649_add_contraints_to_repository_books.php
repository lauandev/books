<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContraintsToRepositoryBooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('repository_books', function (Blueprint $table) {
            $table->foreign('book_rating_id')
                ->references('id')->on('book_ratings')
                ->onDelete('cascade');

            $table->foreign('status_id')
                ->references('id')->on('repository_book_statuses')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reository_books', function (Blueprint $table) {
            //
        });
    }
}
