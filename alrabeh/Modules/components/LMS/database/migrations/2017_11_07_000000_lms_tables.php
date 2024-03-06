<?php

namespace Modules\Components\LMS\database\migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LmsTables extends Migration
{
    protected $module_prefix = "lms_";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create($this->module_prefix . 'categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug')->nullable()->unique()->index();
            $table->boolean('is_featured')->default(false); 
            $table->boolean('in_home')->default(false);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('type')->nullable()->default('general');
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on($this->module_prefix . 'categories')->onUpdate('cascade')->onDelete('set null');



        });

        Schema::create($this->module_prefix . 'tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug')->nullable()->unique()->index();
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();


        });


        //certificates

         Schema::create($this->module_prefix . 'certificate_templates', function (Blueprint $table) {
            $table->increments('id');
             $table->string('title')->nullable();
            $table->string('manager_name')->nullable();
            $table->string('manager_title')->nullable();
            $table->string('category')->nullable('general');
            $table->text('content')->nullable();
             $table->text('note')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->timestamps();
        });  



        Schema::create($this->module_prefix . 'courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->nullable()->unique()->index();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
             $table->enum('level', ['deficult', 'easy', 'medium', 'very_easy', 'very_deficult'])->default('medium');
            $table->longText('content')->nullable();
            $table->text('summary')->nullable();
            $table->integer("duration")->default(5);
            $table->enum("duration_unit", ['minute', 'hour', 'day', 'week'])->default('week')->nullable();
            $table->integer("max_students")->default(0);
            $table->integer("enrolled_students")->default(0);
            // 0 = disable retake course
            $table->integer("retake_count")->default(1);
            $table->decimal('price', 10)->default(0.00);
            $table->decimal('sale_price', 10)->nullable()->default(0.00);
            $table->boolean("featured")->default(false);
            $table->boolean("block_lessons")->default(false);
            $table->boolean("submission_form")->default(false);
            $table->boolean("allow_comments")->default(true);
            $table->enum("evaluation_type", ['completed_lessons_quizzes','final_quiz', 'passed_quizzes', 'completed_lessons', 'quizzes_results'])->default('completed_lessons_quizzes');
            // $table->string("passing_condition")->default('completed_lessons_quizzes');
            $table->integer("passing_grade")->default(60);
            $table->enum("passing_grade_type", ['percentage', 'points'])->default('percentage');
            
            $table->text('featured_image_link')->nullable();
            $table->text('preview_video')->nullable();
            $table->boolean('is_featured')->default(false); 
            $table->boolean('in_home')->default(false);

            $table->tinyInteger('status')->default(0); // 0 => not published
            $table->dateTime('published_at')->nullable();
            $table->dateTime('published_at_hij')->nullable(); //date hijri
            $table->dateTime('started_at')->nullable();
            $table->dateTime('started_at_hij')->nullable(); //date hijri
            $table->boolean('pagination_lessons')->default(false);  

            $table->text('options')->nullable(); //json for more settings

            $table->unsignedInteger('certificate_id')->nullable(); //certificate template id
            $table->foreign('certificate_id')->references('id')->on($this->module_prefix . 'certificate_templates')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('author_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');


        });




        Schema::create($this->module_prefix . 'sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('content')->nullable();
            $table->integer('order')->default(0);
            $table->unsignedInteger('course_id')->nullable()->index();

            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on($this->module_prefix . 'courses')->onDelete('cascade')->onUpdate('cascade');


        });


        Schema::create($this->module_prefix . 'lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('preview_video')->nullable();
            $table->string('slug')->nullable()->unique()->index();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->longText('preview_text')->nullable();

            $table->longText('lesson_text')->nullable();
            $table->text('lesson_video')->nullable();
            $table->text('live_class_url')->nullable();

            $table->string('duration')->nullable();
            $table->enum('duration_unit', ['minute', 'hour', 'day', 'week'])->default('minute')->nullable();
            $table->enum('level', ['deficult', 'easy', 'medium', 'very_easy', 'very_deficult'])->default('medium');
            $table->text('preview_video')->nullable();
            $table->boolean('preview')->default(false);
            $table->boolean('allow_comments')->default(false);
            $table->tinyInteger('status')->default(0);
            $table->dateTime('published_at')->nullable();
            $table->boolean('private')->default(false);
            $table->enum('type', ['standard', 'video', 'quiz', 'audio', 'docs'])->default('standard');

            $table->longText('options')->nullable(); //json for more settings

            $table->unsignedInteger('author_id')->nullable();
            $table->unsignedInteger('exercise_id')->nullable();
            $table->unsignedInteger('quiz_id')->nullable();

            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('exercise_id')->references('id')->on($this->module_prefix . 'quizzes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('quiz_id')->references('id')->on($this->module_prefix . 'quizzes')->onDelete('cascade')->onUpdate('cascade');


            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();


            $table->softDeletes();
            $table->timestamps();
        });



        Schema::create($this->module_prefix . 'quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->nullable()->unique()->index();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->longText('content')->nullable();
            $table->string('duration')->nullable();
            $table->enum('duration_unit', ['minute', 'hour', 'day', 'week'])->default('minute')->nullable();
            $table->boolean('preview')->default(false);
            $table->decimal('price', 10)->default(0.00);
            $table->decimal('sale_price', 10)->nullable()->default(0.00);
            $table->text('preview_video')->nullable();
            $table->integer('question_per_page')->nullable()->default(1);
            $table->boolean('show_q_group_title')->default(true);  //Show title of groupe of questions title (category).
            $table->boolean('pagination_questions')->default(false);  //Show list of questions while doing quiz as ordered numbers (1, 2, 3, etc).
            $table->boolean('review_questions')->default(false);  // Allow re-viewing questions after completing quiz.
            $table->boolean('is_standlone')->default(false);  // Allow quiz to use without course
            $table->boolean('show_questions_title')->default(false); 
            $table->boolean('is_featured')->default(false); 
            $table->boolean('in_home')->default(false);
            $table->string('total_degree')->nullable();  // %.
            $table->string('passing_grade')->default(50);  // %.
            $table->integer('retake_count')->default(1);  // re-take times number
            $table->boolean('show_check_answer')->default(false);  // Allow check answers.
            $table->boolean('skip_question')->default(true);  // 0 => Disabled
            $table->boolean('show_hint')->default(false);  // re-take times number
            // skip question can pass to answer question
            // Show Check Answer   Show button to check answer while doing quiz ( 0 = Disabled, -1 = Unlimited, N = Number of check ).
            // Show Hint  Show button to hint answer while doing quiz ( 0 = Disabled, -1 = Unlimited, N = Number of check ).
            $table->boolean('has_sub_quiz')->nullable()->default(false);
            $table->tinyInteger('sub_quiz_check_answers')->nullable();
            $table->integer('sub_quiz_questions_num')->nullable();
            $table->enum('sub_quiz_level', ['deficult', 'easy', 'medium', 'very_easy', 'very_deficult'])->nullable()->default('medium');

            $table->string('sub_quiz_duration')->nullable();
            $table->enum('sub_quiz_duration_unit', ['minute', 'hour', 'day', 'week'])->default('minute')->nullable();

            $table->boolean('allow_comments')->default(false);
            $table->tinyInteger('status')->default(0);
            $table->dateTime('published_at')->nullable();
            $table->boolean('private')->default(false);
            $table->enum('type', ['standard', 'video', 'audio', 'docs'])->default('standard');
            $table->enum('level', ['deficult', 'easy', 'medium', 'very_easy', 'very_deficult'])->nullable()->default('medium');
            $table->text('options')->nullable(); //json for more settings
            $table->unsignedInteger('certificate_id')->nullable(); //certificate template id
            $table->foreign('certificate_id')->references('id')->on($this->module_prefix . 'certificate_templates')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();



        });

        Schema::create($this->module_prefix . 'questions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable(); //parent question 
            $table->string('title');
            $table->text('preview_video')->nullable();
            $table->longText('content')->nullable();
            $table->string('duration')->nullable();
            $table->enum('duration_unit', ['minute', 'hour', 'day', 'week'])->default('minute')->nullable();
            $table->string('points')->default(1);  // 1 => one point
            $table->string('question_type')->default('true_false'); //true_false, multi_choice, single_choice
            $table->text('question_explanation')->nullable(); //when student press check answer
            $table->text('question_hint')->nullable();
            $table->tinyInteger('difficulty')->default(1);  // 0 => easy , 1=> normal, 2=> deficult.
            $table->boolean('for_sub_quiz')->default(false); 
            $table->boolean('show_question_title')->default(false);  // Allow check answers.
            $table->tinyInteger('show_check_answer')->default(0);  // Allow check answers.
            $table->tinyInteger('skip_question')->default(0);  // 0 => Disabled
            $table->boolean('show_hint')->default(false);  // re-take times number

            // skip question can pass to answer question
            // Show Check Answer   Show button to check answer while doing quiz ( 0 = Disabled, -1 = Unlimited, N = Number of check ).
            // Show Hint  Show button to hint answer while doing quiz ( 0 = Disabled, -1 = Unlimited, N = Number of check ).

            $table->boolean('allow_comments')->default(false);
            $table->tinyInteger('status')->default(0);
            $table->enum('type', ['standard', 'video', 'audio', 'docs'])->default('standard');
            $table->text('options')->nullable(); //json for more settings
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on($this->module_prefix . 'questions')->onUpdate('cascade')->onDelete('set null');




        });

        Schema::create($this->module_prefix . 'answers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->text('hint')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('order')->default(0);
            $table->boolean('is_correct')->default(false);  // true => is_correct answer
            $table->text('options')->nullable(); //json for more settings
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on($this->module_prefix . 'questions')->onDelete('cascade')->onUpdate('cascade');


        });


        Schema::create($this->module_prefix . 'quiz_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quiz_id');
            $table->unsignedInteger('question_id');
            $table->integer('order')->default(0);
            $table->foreign('quiz_id')->references('id')->on($this->module_prefix . 'quizzes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('question_id')->references('id')->on($this->module_prefix . 'questions')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });


        Schema::create($this->module_prefix . 'categoriables', function (Blueprint $table) {
            $table->string($this->module_prefix . 'categoriable_type');
            $table->unsignedInteger($this->module_prefix . 'categoriable_id');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on($this->module_prefix . 'categories')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create($this->module_prefix . 'taggables', function (Blueprint $table) {
            $table->string($this->module_prefix . 'taggable_type');
            $table->unsignedInteger($this->module_prefix . 'taggable_id');
            $table->unsignedInteger('tag_id');
            $table->foreign('tag_id')->references('id')->on($this->module_prefix . 'tags')->onDelete('cascade')->onUpdate('cascade');
        });


        Schema::create($this->module_prefix . 'courseables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order')->default(0);
            $table->string($this->module_prefix . 'courseable_type');
            $table->unsignedInteger($this->module_prefix . 'courseable_id');
            $table->unsignedInteger('course_id');
            $table->foreign('course_id')->references('id')->on($this->module_prefix . 'courses')->onDelete('cascade')->onUpdate('cascade');
            // $table->nullableMorphs('sourcable');
            $table->timestamps();
        });

        Schema::create($this->module_prefix . 'sectionables', function (Blueprint $table) {
            $table->increments('id');
            $table->string($this->module_prefix . 'sectionable_type');
            $table->unsignedInteger($this->module_prefix . 'sectionable_id');
            $table->tinyInteger('is_private')->default(1);
            $table->string('type');
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('course_id');
            $table->integer('order')->default(0);
            $table->foreign('section_id')->references('id')->on($this->module_prefix . 'sections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('course_id')->references('id')->on($this->module_prefix . 'courses')->onDelete('cascade')->onUpdate('cascade');
        });

         Schema::create($this->module_prefix . 'lessons_parts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type'); //explanation
            $table->string('sub_type'); //vedio - text
             $table->integer('order')->nullable()->default(0);
            $table->string('slug')->nullable()->unique()->index();

            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->longText('content')->nullable();
            $table->text('embeded_type')->nullable();
            $table->text('embeded_url')->nullable();
            $table->text('embeded_code')->nullable();
            $table->longText('notes')->nullable();
            $table->string('duration')->nullable();
            $table->enum('duration_unit', ['minute', 'hour', 'day', 'week'])->default('minute')->nullable();
            $table->enum('level', ['deficult', 'easy', 'medium', 'very_easy', 'very_deficult'])->default('medium');
            $table->text('preview_video')->nullable();
            $table->tinyInteger('is_public')->default(0); //0 => private, 1 => auth, 2 => public
            $table->boolean('allow_comments')->default(false);
            $table->tinyInteger('status')->default(0);
            $table->dateTime('published_at')->nullable();
            $table->enum('content_type', ['text', 'video', 'quiz', 'audio', 'docs', 'slides','image'])->default('text');
            $table->enum('quiz_type', ['sub_quiz', 'main_quiz'])->default('main_quiz')->nullable();


            $table->longText('options')->nullable(); //json for more settings

            $table->unsignedInteger('author_id')->nullable();
            $table->unsignedInteger('lesson_id')->nullable();
            $table->unsignedInteger('quiz_id')->nullable();

            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('lesson_id')->references('id')->on($this->module_prefix . 'lessons')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('quiz_id')->references('id')->on($this->module_prefix . 'quizzes')->onDelete('cascade')->onUpdate('cascade');


            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();


            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create($this->module_prefix . 'plans', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->longText('content')->nullable();
            $table->decimal('price', 10)->default(0.00);
            $table->decimal('sale_price', 10)->nullable()->default(0.00);
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->enum('type', ['duration', 'items', 'duration_items'])->default('items'); //items number => quizzes, courses
            $table->enum('duration_type', ['minutes', 'hours', 'days', 'weeks', 'months', 'years'])->default('months'); //if plan type duration
            $table->integer('duration')->default(1); //ex: 10 months
            $table->boolean('is_featured')->default(false); //ex: 10 months
             $table->boolean('is_recommended')->default(false); //ex: 10 months
            $table->boolean('only_planables')->default(false); //true => just use planable items
            $table->tinyInteger('status')->default(0);
            $table->text('notes')->nullable(); //json column
            $table->text('price_options')->nullable(); //json column
            $table->text('options')->nullable(); //json column

            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
             $table->timestamps();

        });

        //plans items

        Schema::create($this->module_prefix . 'plannables', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger($this->module_prefix . 'plannable_id');
            $table->string($this->module_prefix . 'plannable_type');
            $table->integer('order')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->text('notes')->nullable(); //json column
            $table->text('price_options')->nullable(); //json column
            $table->text('options')->nullable(); //json column
            $table->unsignedInteger('plan_id');
             $table->timestamps();
            $table->foreign('plan_id')->references('id')->on($this->module_prefix . 'plans')->onDelete('cascade')->onUpdate('cascade');
        });

                //authors
        Schema::create($this->module_prefix . 'authors', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('authorable_type');
            $table->unsignedInteger('authorable_id');
            $table->string('role')->default('primary'); //secondary
            $table->timestamps();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
        });

            //authors
        Schema::create($this->module_prefix . 'books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->nullable()->unique()->index();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('preview_video')->nullable();
            $table->longText('content')->nullable();
            $table->text('summary')->nullable();
            $table->integer('subscribers')->nullable()->default(0);;
            $table->text('book_link')->nullable();
            $table->string('book_format')->nullable(); //pdf
            $table->string('can_download')->nullable(); //pdf
            $table->string('pages_count')->nullable();
            $table->decimal('price', 10)->default(0.00);
            $table->decimal('sale_price', 10)->nullable()->default(0.00);
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->unsignedInteger('author_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });

        //pricess

        Schema::create($this->module_prefix . 'prices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger($this->module_prefix . 'pricable_id');
            $table->string($this->module_prefix . 'pricable_type');
            $table->decimal('price')->default(0.00);
            $table->decimal('new_price')->default(0.00);
            $table->tinyInteger('status')->default(1);
            $table->text('notes')->nullable(); //json column
            $table->text('options')->nullable(); //json column
            $table->timestamps();
        });


         //Coupons

        Schema::create($this->module_prefix . 'coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->text('name')->nullable();
            $table->text('template')->nullable();
            $table->enum('type', ['fixed', 'percentage'])->default('fixed');
            $table->integer('uses')->nullable();
            $table->integer('coupons_num')->nullable(); //coupons_num
            $table->decimal('min_cart_total')->nullable();
            $table->decimal('max_discount_value')->nullable();
            $table->string('value');
            $table->dateTime('start')->nullable();
            $table->dateTime('expiry')->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->boolean('is_group')->default(false);
            $table->timestamps();
            $table->tinyInteger('is_active')->default(1); // 1 => active
            $table->foreign('parent_id')->references('id')->on($this->module_prefix . 'coupons')->onUpdate('cascade')->onDelete('set null');
        });

         //Coupon items
        Schema::create($this->module_prefix . 'couponables', function (Blueprint $table) {
            $table->integer('coupon_id')->unsigned()->index();
            $table->string($this->module_prefix . 'couponable_type');
            $table->unsignedInteger($this->module_prefix . 'couponable_id');
            $table->timestamps();
            $table->foreign('coupon_id')->references('id')->on($this->module_prefix . 'coupons')->onUpdate('cascade')->onDelete('cascade');
        });

        //Coupon users

        Schema::create($this->module_prefix . 'coupon_user', function (Blueprint $table) {
            $table->integer('coupon_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('coupon_id')->references('id')->on($this->module_prefix . 'coupons')->onUpdate('cascade')->onDelete('cascade');
        });

         //invoices

        Schema::create($this->module_prefix . 'invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('currency');
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->text('options')->nullable();
            $table->enum('status', ['paid', 'pending', 'cancelled', 'failed'])->default('pending');
            $table->decimal('total_price');
            $table->unsignedInteger('coupon_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('coupon_id')->references('id')
                ->on($this->module_prefix . 'coupons')->onDelete('cascade')->onUpdate('cascade');    

        });

        //invoice_items

        Schema::create($this->module_prefix . 'invoicables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->decimal('paid');
            $table->decimal('price');
            $table->integer('amount')->default(1);
            $table->string($this->module_prefix . 'invoicable_type');
            $table->unsignedInteger($this->module_prefix . 'invoicable_id');
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->text('options')->nullable();
            $table->unsignedInteger('invoice_id');
             $table->unsignedInteger('coupon_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();


            $table->softDeletes();
            $table->timestamps();


            $table->foreign('invoice_id')->references('id')
                ->on($this->module_prefix . 'invoices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('coupon_id')->references('id')
                ->on($this->module_prefix . 'coupons')->onDelete('cascade')->onUpdate('cascade');     


        });


        //Courses || Quizzes


        Schema::create($this->module_prefix . 'subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subscriptionnable_type');
            $table->unsignedInteger('subscriptionnable_id');
            $table->boolean('is_timable')->default(false);
            $table->date('finish_time')->nullable();
            $table->json('options')->nullable(); //json options
            $table->unsignedInteger('user_id');
            $table->integer('invoice_id')->unsigned()->nullable();
            $table->integer('plan_id')->unsigned()->nullable();
             $table->tinyInteger('status')->default(1); // 1 => active

            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();


            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('plan_id')->references('id')->on($this->module_prefix . 'plans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('invoice_id')->references('id')->on($this->module_prefix . 'invoices')->onDelete('cascade')->onUpdate('cascade');
        });


        //user logs


        Schema::create($this->module_prefix . 'logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string($this->module_prefix . 'loggable_type');
            $table->unsignedInteger($this->module_prefix . 'loggable_id');
            $table->string('degree')->nullable();
            $table->integer('enrolls_number')->default(1);
            $table->boolean('passed')->default(false);
            $table->boolean('delayed')->default(false);
            $table->boolean('skipped')->default(false);
            $table->tinyInteger('easy_status')->default(0); //0=>not determined, 1=>easy, 2 => mid, 3=>dificult
            $table->tinyInteger('status')->default(0); //1 => completed
            $table->boolean('preview')->default(false); //1 => completed
            $table->integer('preview_num')->nullable()->default(0);
            $table->text('notes')->nullable();
            $table->longText('white_board')->nullable();
            $table->string('points')->nullable();
            $table->string('passing_grade')->nullable();
            $table->unsignedInteger('user_id');
            $table->string('current_page')->nullable(); //last page openned in quiz to complete from he finished
            $table->unsignedInteger('plan_id')->nullable();
            $table->unsignedInteger('invoice_id')->nullable();

            $table->json('options')->nullable(); //json options
            $table->integer('parent_id')->unsigned()->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->enum("passing_grade_type", ['percentage', 'points'])->default('percentage');
            $table->tinyInteger('is_exercise')->nullable()->default(0);
            $table->timestamps();

            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->foreign('parent_id')->references('id')->on($this->module_prefix . 'logs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('plan_id')->references('id')->on($this->module_prefix . 'plans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('invoice_id')->references('id')->on($this->module_prefix . 'invoices')->onDelete('cascade')->onUpdate('cascade');
        });


        //users certificate
        Schema::create($this->module_prefix . 'certificates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('certificatable_type');
            $table->unsignedInteger('certificatable_id');
            $table->unsignedInteger('user_id')->nullable()->index();
            $table->unsignedInteger('log_id')->nullable()->index();
            $table->unsignedInteger('temp_id')->nullable()->index(); //template
            $table->text('content')->nullable();
            $table->boolean('status')->default(true);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('log_id')->references('id')->on($this->module_prefix . 'logs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('temp_id')->references('id')->on($this->module_prefix . 'certificate_templates')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->timestamps();
        });


                //extrnal embeded_media urls


        Schema::create($this->module_prefix . 'embeded_media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mediable_type');
            $table->unsignedInteger('mediable_id');
            $table->enum('type', ['video', 'audio', 'doc', 'image', 'file', 'pdf', 'slides'])->default('file');
            $table->enum('file_type', ['video', 'audio', 'doc', 'image', 'file', 'pdf', 'slides'])->default('file');
            $table->text('file_url');
            $table->string('source'); //youtube ??
            $table->boolean('preview')->default(false);
            $table->boolean('status')->default(true);
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->timestamps();
        });



         Schema::create($this->module_prefix . 'asks', function (Blueprint $table) {
            $table->increments('id');

            $table->string('askable_type');
            $table->unsignedInteger('askable_id');
            $table->unsignedInteger('log_id')->nullable();
            $table->unsignedInteger('user_id')->nullable()->index();
            $table->string('user_type')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_email')->nullable();
            $table->string('user_phone')->nullable();
            $table->text('title')->nullable();
            $table->text('content')->nullable();
            $table->unsignedInteger('send_to')->nullable()->index();
            $table->string('receiver_machain')->nullable();
            $table->boolean('status')->default(true);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
             $table->foreign('send_to')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('log_id')->references('id')->on($this->module_prefix . 'logs')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->timestamps();
        });


         Schema::create($this->module_prefix . 'favourites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('favourittable_type');
            $table->unsignedInteger('favourittable_id');
            $table->unsignedInteger('user_id')->nullable()->index();
            $table->boolean('status')->default(true);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->timestamps();
        });

        Schema::create($this->module_prefix . 'testimonials', function (Blueprint $table) {
           $table->increments('id');
           $table->unsignedInteger('user_id')->nullable()->index();
           $table->string('user_name')->nullable();
           $table->text('title')->nullable();
           $table->text('content')->nullable();
           $table->text('meta_keywords')->nullable();
           $table->text('meta_description')->nullable();
           $table->boolean('in_home')->default(true);
           $table->boolean('status')->default(true);
           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->timestamps();
        });

        Schema::create($this->module_prefix . 'students_results', function (Blueprint $table) {
           $table->increments('id');
           $table->unsignedInteger('student_id')->nullable()->index();
           $table->string('student_name')->nullable();
           $table->text('title')->nullable();
           $table->text('content')->nullable();
           $table->string('student_degree')->nullable();
           $table->string('max_degree')->nullable();

           $table->text('meta_keywords')->nullable();
           $table->text('meta_description')->nullable();
           $table->boolean('in_home')->default(true);
           $table->boolean('status')->default(true);
           $table->text('options')->nullable();
            $table->unsignedInteger('course_id')->nullable()->index();

           $table->unsignedInteger('quiz_id')->nullable()->index();

           $table->unsignedInteger('category_id')->nullable()->index();

           $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
           $table->foreign('course_id')->references('id')->on($this->module_prefix . 'courses')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('quiz_id')->references('id')->on($this->module_prefix . 'quizzes')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('category_id')->references('id')->on($this->module_prefix . 'categories')->onDelete('cascade')->onUpdate('cascade');
           $table->unsignedInteger('created_by')->nullable()->index();
           $table->unsignedInteger('updated_by')->nullable()->index();
           $table->timestamps();
        });

        Schema::create($this->module_prefix . 'how_to', function (Blueprint $table) {
           $table->increments('id');
           $table->unsignedInteger('category_id')->nullable()->index();
           $table->unsignedInteger('parent_id')->nullable()->index();
           $table->text('title')->nullable();
           $table->text('content')->nullable();
           $table->text('meta_keywords')->nullable();
           $table->text('meta_description')->nullable();
           $table->boolean('in_home')->default(true);
           $table->boolean('status')->default(true);
           $table->foreign('parent_id')->references('id')->on($this->module_prefix . 'how_to')->onDelete('set null')->onUpdate('cascade');
           $table->foreign('category_id')->references('id')->on($this->module_prefix . 'categories')->onDelete('cascade')->onUpdate('cascade');
           $table->unsignedInteger('created_by')->nullable()->index();
           $table->unsignedInteger('updated_by')->nullable()->index();
           $table->timestamps();
        });

        Schema::create($this->module_prefix . 'how_to', function (Blueprint $table) {
           $table->increments('id');
           $table->unsignedInteger('category_id')->nullable()->index();
           $table->unsignedInteger('parent_id')->nullable()->index();
           $table->text('title')->nullable();
           $table->text('content')->nullable();
           $table->text('meta_keywords')->nullable();
           $table->text('meta_description')->nullable();
           $table->boolean('in_home')->default(true);
           $table->boolean('status')->default(true);
           $table->foreign('parent_id')->references('id')->on($this->module_prefix . 'how_to')->onDelete('set null')->onUpdate('cascade');
           $table->foreign('category_id')->references('id')->on($this->module_prefix . 'categories')->onDelete('cascade')->onUpdate('cascade');
           $table->unsignedInteger('created_by')->nullable()->index();
           $table->unsignedInteger('updated_by')->nullable()->index();
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
        Schema::dropIfExists($this->module_prefix . 'how_to');
        Schema::dropIfExists($this->module_prefix . 'students_results');
        Schema::dropIfExists($this->module_prefix . 'taggables');
        Schema::dropIfExists($this->module_prefix . 'categoriables');
        Schema::dropIfExists($this->module_prefix . 'testimonials');
        Schema::dropIfExists($this->module_prefix . 'favourites');
        Schema::dropIfExists($this->module_prefix . 'asks');
        Schema::dropIfExists($this->module_prefix . 'embeded_media');
        Schema::dropIfExists($this->module_prefix . 'certificates');
        Schema::dropIfExists($this->module_prefix . 'logs');
        Schema::dropIfExists($this->module_prefix . 'subscriptions');
        Schema::dropIfExists($this->module_prefix . 'invoicables');
        Schema::dropIfExists($this->module_prefix . 'invoices');
        Schema::dropIfExists($this->module_prefix . 'coupon_user');
        Schema::dropIfExists($this->module_prefix . 'couponables');
        Schema::dropIfExists($this->module_prefix . 'coupons');
        Schema::dropIfExists($this->module_prefix . 'prices');
        Schema::dropIfExists($this->module_prefix . 'books');
        Schema::dropIfExists($this->module_prefix . 'authors');
        Schema::dropIfExists($this->module_prefix . 'plannables');
        Schema::dropIfExists($this->module_prefix . 'plans');
        Schema::dropIfExists($this->module_prefix . 'lessons_parts');
        Schema::dropIfExists($this->module_prefix . 'sectionables');
        Schema::dropIfExists($this->module_prefix . 'courseables');
        Schema::dropIfExists($this->module_prefix . 'quiz_questions');
        Schema::dropIfExists($this->module_prefix . 'answers');
        Schema::dropIfExists($this->module_prefix . 'questions');
        Schema::dropIfExists($this->module_prefix . 'quizzes');
        Schema::dropIfExists($this->module_prefix . 'lessons');
        Schema::dropIfExists($this->module_prefix . 'course_tag');
        Schema::dropIfExists($this->module_prefix . 'category_course');
        Schema::dropIfExists($this->module_prefix . 'sections');
        Schema::dropIfExists($this->module_prefix . 'courses');
        Schema::dropIfExists($this->module_prefix . 'certificate_templates');
        Schema::dropIfExists($this->module_prefix . 'tags');
        Schema::dropIfExists($this->module_prefix . 'categories');

    }
}
