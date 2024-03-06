<?php

namespace Modules\Components\LMS\Widgets;

use Modules\Components\LMS\Models\Course;
use Modules\Components\LMS\Models\Page;
use Modules\Components\LMS\Models\Category;
use Modules\Components\LMS\Models\News;

class LMSWidget
{

    function __construct()
    {
    }

    function run($args)
    {

        $pages = Page::count();
        $courses = Course::count();
        $news = News::count();
        $categories = Category::count();

        return '
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa file-invoice fa-fw"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">' . trans('LMS::labels.lms_widget.page') . '</span>
              <span class="info-box-number">' . $pages . '</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-thumbtack fa-fw"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">' . trans('LMS::labels.lms_widget.course') . '</span>
              <span class="info-box-number">' . $courses . '</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa fa-newspaper-o fa-fw"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">' . trans('LMS::labels.lms_widget.new') . '</span>
              <span class="info-box-number">' . $news . '</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-folder-open fa-fw"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">' . trans('LMS::labels.lms_widget.category') . '</span>
              <span class="info-box-number">' . $categories . '</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

';
    }

}