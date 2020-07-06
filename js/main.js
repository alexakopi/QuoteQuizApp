$(function () {

    // main data object
    var data = {
        "page" : "main",
        "settings" : [],
        "questions" : [],
        "passed" : [],
        "questionCounter" : 0,
        "current" : {},
        "score" : 0,
        "ratio" : 0,
        "finished" : false
    };


    // define handlebar helpers
    Handlebars.registerHelper('isMainPage', function () {
        return data.page === "main";
    });

    Handlebars.registerHelper('isAnswered', function () {
        return  typeof data.current.choice !== "undefined";
    });

    Handlebars.registerHelper('isCorrect', function (id) {
        return data.current.correct && data.current.choice==id;
    });

    Handlebars.registerHelper('isWrong', function (id) {
        return !data.current.correct && data.current.choice==id;
    });

    Handlebars.registerHelper('isBinary', function () {
        return Boolean(Number(data.settings.binary));
    });

    Handlebars.registerHelper('isLast', function () {
        return data.questionCounter == data.count;
    });

    fetchData(true);

    function fetchData(paint) {
        $.when(
            $.get( window.location.pathname +"api/question/read.php",function(get) {
                data.questions = get.questions;
                data.count = data.questions.length;
                data.questionCounter = 1;
                data.current = data.questions[0];
            }),
            $.get( window.location.pathname +"api/setting/read.php",function(get) {
                data.settings = get.settings;
            })
        ).then(function() {
            if(paint)render();
        });
    }

    function render() {
        var template = $('#template-main').html();
        var templateScript = Handlebars.compile(template);
        var html = templateScript(data);
        $("#main").html(html);
    }

    $('body').on('click', '#main-nav span', function() {
        var page = $(this).data('page');
        data.page = page;
        render();
    });

    $('body').on('click', '#quiz-button-next', function() {
        if( data.questionCounter < data.count ){
            data.questionCounter++;
            data.current = data.questions[ data.questionCounter -1];
        }
        render();
    });

    $('body').on('click', '#quiz-button-finish', function() {
        data.questionCounter = 0;
        data.current = {};
        data.finished = true;
        render();
    });

    $('body').on('click', '#quiz-button-start-over', function() {
        data.questionCounter = 1;
        data.current = {};
        data.current = data.questions[0];
        data.finished = false;
        data.passed = [];
        data.score = 0;
        data.ratio = 0;
        fetchData(true);
    });


    $('body').on('change', '.setting-input', function() {
        var name = $(this).data('name');
        var value = Number($(this).val());
        $.post( window.location.pathname +"api/setting/update.php",JSON.stringify({"name":name,"value":value}), function() {
            data = {
                "page" : data.page,
                "settings" : [],
                "questions" : [],
                "passed" : [],
                "count" : 0,
                "current" : 0,
                "questionCounter" : 0,
                "score" : 0,
                "ratio" : 0,
                "finished" : false
            };
            fetchData(true);
        });
    });

    $('body').on('click', '.answer', function() {
        var $answer = $(this);
        var answerId = $answer.data('id');
        if(!data.passed.includes(data.current.id)){
            if(Boolean(Number(data.settings.binary))){
                data.current.choice = $answer.data('type');
            }
            else{
                data.current.choice = answerId;
            }
            $.get( window.location.pathname +"api/question/check.php",{"id":data.current.id,"answer":answerId},function(get) {
                if(Boolean(Number(get.is_right))){
                    if(Boolean(Number(data.settings.binary))){
                        if(Boolean(Number($answer.data('type')))){
                            data.score++;
                            data.current.correct = true;
                        }
                        else{
                            data.current.correct = false;
                        }
                    }
                    else{
                        console.log(data.current);
                        console.log(data.questions);
                        data.score++;
                        data.current.correct = true;
                    }
                }
                else{
                    if(Boolean(Number(data.settings.binary))){
                        if(Boolean(Number($answer.data('type')))){
                            data.current.correct = false;
                        }
                        else{
                            data.score++;
                            data.current.correct = true;
                        }
                    }
                    else{
                        data.current.correct = false;
                    }
                }
                data.current.answer = get.answer;
                data.passed.push(data.current.id);
                data.ratio = Math.round(data.score * 100 / data.count);
                render();
            });
        }
    });
});