@php

    $parentQuestion = $question->parent;
    $hasParentQuestion = false;

    $parentQuestionTitle = null;
    $parentQuestionContent = null;
    $parentQuestionShowTitle = false;

    if($parentQuestion){
        $hasParentQuestion = true;
        $parentQuestionTitle = $parentQuestion->title;
        $parentQuestionContent = $parentQuestion->content;
        $parentQuestionShowTitle = $parentQuestion->show_question_title;
    }

@endphp

@if($hasParentQuestion)

    {{-- parent question title --}}

    @if($parentQuestionShowTitle)
        <h3 style="color: #dc3545;">{{$parentQuestionTitle}}</h3>
    @endif


    <div>
        <button class="btn btn-default collapse-btn" type="button"
                data-div_target="{{'#show_paragraph_'.$parentQuestion->hashed_id}}">
            <i class="fa fa-paragraph"></i>
            <span>عرض القطعة النصية</span>
        </button>
        {{-- <div class="qs-info alert alert-danger" role="alert">
            ugd hggi ljtgpa fu] ;gi ]i hyfdi ;g;l
        </div> --}}
    </div>
    <div id="{{'show_paragraph_'.$parentQuestion->hashed_id}}" class="paragraph-collapse"
         style="background-color: #f1f1f1; margin-top: 10px; padding: 10px; display: none;" >
        @if($parentQuestion->content){!! $parentQuestion->content !!} @else <p> لا يوجد نص لعرضه.</p> @endif
    </div>
<br>
@endif
{{-- 
<script>
    (function ($) {
        var storage = localStorage.getItem("question_collapses");
        if (storage) {
            var storageData = JSON.parse(storage);

            console.log(storageData.status);
            console.log(typeof storageData.status);
            if (storageData.target && (storageData.status === true || storageData.status === 'true')) {
                $(".question-name").find("[data-target=" + storageData.target + "]").attr("aria-expanded", true);
                $(storageData.target).addClass("show").show();
            } else {
                $(".question-name").find("[data-target=" + storageData.target + "]").attr("aria-expanded", false);
                $(storageData.target).removeClass("show").hide();
            }
        }
        var collapses = $(".question-name [data-toggle='collapse']");
        collapses.on("click touchstart", function () {
            var target = $(this).data('target');
            var status = !$(this).hasClass('collapsed');
            localStorage.setItem("question_collapses", JSON.stringify({target: target, status: status}));
        });
    })(jQuery);
</script> --}}

