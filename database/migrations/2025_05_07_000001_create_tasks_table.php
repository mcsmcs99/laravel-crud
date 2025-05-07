<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['pendente', 'em andamento', 'concluida'])->default('pendente');
            $table->timestamps(); // cria created_at e updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
}

