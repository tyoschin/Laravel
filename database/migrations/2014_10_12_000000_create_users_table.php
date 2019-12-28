<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            # Column methods   : https://laravel.com/docs/6.x/migrations#columns    
            # Column modifiers : https://laravel.com/docs/6.x/migrations#column-modifiers        
            $table->bigIncrements('id');
            $table->string('source')->default('');   //добавил
            $table->date('date');                    //добавил
            $table->string('type')->default('');     //добавил
            $table->string('name')->default('');
            $table->string('phone')->default('');    //добавил
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable(); //это поле не нужно
            $table->string('address')->default('');  //добавил
            $table->string('comments')->default(''); //добавил
            $table->string('is_enemy')->default(''); //добавил
            $table->timestamps();
            //$table->string('password'); это поле будет переведено в таблицу User Accounts
            //$table->rememberToken();    это поле будет переведено в таблицу User Accounts            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
