<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('computer_id') // Khóa ngoại tham chiếu tới bảng 'computers'
                  ->constrained('computers')
                  ->onDelete('cascade');
            $table->string('reported_by', 50); // Người báo cáo
            $table->dateTime('reported_date'); // Ngày báo cáo
            $table->text('description'); // Mô tả chi tiết vấn đề
            $table->enum('urgency', ['Low', 'Medium', 'High']); // Mức độ sự cố
            $table->enum('status', ['Open', 'In Progress', 'Resolved']); // Trạng thái xử lý
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issuses');
    }
};
