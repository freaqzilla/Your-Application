<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailAndModifyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->_upAddColumnsToUsersTable();
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_and_modify_users');
    }

    private function _upAddColumnsToUsersTable() {

        // Add column for email token
        if (!Schema::hasColumn('users', 'email_token')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('email_token')->nullable();
            });
        }

        // Add column for verified
        if (!Schema::hasColumn('users', 'verified')) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('verified')->default(false);
            });
        }

        // Add column for profile image
        if (!Schema::hasColumn('users', 'profile_image')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('profile_image')->nullable();
            });
        }

        // Add column for address
        if (!Schema::hasColumn('users', 'address')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('address')->nullable();
            });
        }
    }
}
