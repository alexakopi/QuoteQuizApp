<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/main.css">
	<title>QuoteQuizApp</title>
</head>
<body>
<main id="main" class="main">
</main>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/handlebars.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script id="template-main" type="text/x-handlebars-template">
    {{#if (isMainPage)}}
        <nav id="main-nav">
            <span class="active" data-page="main">
                <i class="fa fa-trophy" aria-hidden="true"></i>
                Quiz
            </span>
            <span data-page="settings">
                <i class="fa fa-wrench" aria-hidden="true"></i>
                Settings
            </span>
        </nav>
        <section id="page" class="page">
            <h1>Quiz: Guess the author of quote!</h1>
            {{#unless finished}}
                <ul class="questions">
                    <h2> {{questionCounter}} / {{count}} </h2>
                    <li class="question"><q>"{{this.current.question}}"</q>
                        <ul class="answers">
                            {{#if (isBinary)}}
                            <li class="answer answer-binary" data-id="{{this.current.answers.0.id}}">{{this.current.answers.0.answer}}</li>
                            <span class="answer {{#if (isCorrect 1)}}correct{{/if}} {{#if (isWrong 1)}}wrong{{/if}}" data-type="1" data-id="{{this.current.answers.0.id}}">Yes</span>
                            <span class="answer {{#if (isCorrect 0)}}correct{{/if}} {{#if (isWrong 0)}}wrong{{/if}}" data-type="0" data-id="{{this.current.answers.0.id}}">No</span>
                            {{else}}
                            {{#each this.current.answers}}
                            <li class="answer {{#if (isCorrect this.id)}}correct{{/if}} {{#if (isWrong this.id)}}wrong{{/if}}" data-id="{{this.id}}">{{this.answer}}</li>
                            {{/each}}
                            {{/if}}
                        </ul>
                        <div class="message">
                            {{#if ( isAnswered )}}
                                {{#if this.current.correct }}
                                    <span class="incorrect">Correct! The right answer is: <span class="c-answer">{{this.current.answer}}</span> </span>
                                {{else}}
                                    <span class="correct">Sorry, you are wrong! The right answer is: <span class="c-answer">{{this.current.answer}}</span> </span>
                                {{/if}}
                            {{/if}}
                        </div>
                        {{#if ( isAnswered )}}
                            {{#if ( isLast )}}
                                <span id="quiz-button-finish" class="quiz-button">Finish quiz</span>
                            {{else}}
                                <span id="quiz-button-next" class="quiz-button">Next question</span>
                            {{/if}}
                        {{/if}}
                    </li>
                </ul>
            {{else}}
                <div id="score" class="score">
                    <p class="count">Yor score is: {{score}} of {{count}}</p>
                    <p class="count">Ratio: {{ratio}}%</p>
                    <span id="quiz-button-start-over" class="quiz-button">Start over</span>
                </div>
            {{/unless}}
        </section>
    {{else}}
        <nav id="main-nav">
            <span data-page="main">
                <i class="fa fa-trophy" aria-hidden="true"></i>
                Quiz
            </span>
            <span class="active" data-page="settings">
                <i class="fa fa-wrench" aria-hidden="true"></i>
                Settings
            </span>
        </nav>
        <section id="page" class="page settings-page">
            <h1>Choose quiz mode:</h1>
            <div class="settings">
                <div class="setting">
                    <label for="is-binary">
                        <input class="setting-input" data-name="binary" id="is-binary" type="radio" name="is-binary" value="1" {{#if (isBinary)}}checked{{/if}} >
                        Binary (Yes/No)
                    </label>
                    <label for="not-binary">
                        <input class="setting-input" data-name="binary" id="not-binary" type="radio" name="is-binary" value="0" {{#unless (isBinary)}}checked{{/unless}} >
                        Multiple choice questions
                    </label>
                </div>
            </div>
        </section>
    {{/if}}

</script>
</body>
</html>
