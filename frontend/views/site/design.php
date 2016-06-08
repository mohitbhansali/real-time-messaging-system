<html>
<head>
    <title>Design</title>
    <link rel="stylesheet" type="text/css" href="<?= Yii::$app->urlManager->baseUrl?>/css/design.css">
</head>
<body>

<div class="container">
    <h1>Convert design into HTML & CSS</h1>

    <!--Your HTML goes here-->
    <div class="pledge-box">
        <div class="progress">
            <div class="progress-bar">
                <h3><strong>$167</strong> still needed for this project</h3>
            </div>
        </div>
        <div class="inside-box">
            <p class="paragraph"><strong>Only 3 days left</strong> to fund this project.</p>
            <p class="paragraph join">
                Join the <em>42</em> other donors who have already supported this project. Every dollar helps.
            </p>
            <div class="btn-container">
                <input class="dollars">
                <button class="givenow">Give Now</button>
            </div>
            <a class="whygive" href="#">Why give $50?</a>
        </div>
    </div>
    <button class="savelater">Save for later</button>
    <button class="tellfriends">
        Tell your friends
    </button>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script>
    $('.givenow').on('click', function() {
        var reference = 5000;
        var reached = 3750;
        var dollars = $('.dollars').val();
        var total = parseInt(reached) + parseInt(dollars);
        console.log(total);
        var percent = 0;
        if(total >= reference) {
            percent = 100;
        } else {
            percent = (total/reference)*100;
        }
        $('.progress-bar').css('width',percent+"%");
        $('head').append('<style>.progress-bar h3:after{left:'+percent+'% !important;}</style>');
    });
</script>
</body>
</html>