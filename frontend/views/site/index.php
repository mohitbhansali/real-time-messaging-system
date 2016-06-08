<?php

use yii\jui\AutoComplete;
use yii\web\JsExpression;

/* @var $this yii\web\View */

$this->title = 'Bananabandy - Messaging Tool';
?>
<?php if(!Yii::$app->user->isGuest) { ?>
    <input type="hidden" value="<?= Yii::$app->user->identity->id?>" id="me">
    <div class="wrapper">
        <div class="container-chat">
            <div class="left">
                <div class="top">
                    <?= AutoComplete::widget([
                        'attribute' => "user",
                        'id' => "user",
                        'clientOptions' => [
                            'source' => $users,
                            'autoFill' => true,
                            'minLength' => '1',
                            'select' => new JsExpression("function(event, ui) {
                            console.log(ui.item.id);
                                $('#user_2').val(ui.item.id);
                            }")
                        ],
                        'options' => [
                            'placeholder' => 'Enter name..',
                            'class' => 'form-control input-search',
                        ],
                    ]);
                    ?>
                    <input type="hidden" id="user_2" value="">
                    <a href="#" class="search" id="create-chat"></a>
                </div>
                <ul class="people">
                    <?php if(!empty($chats)) {
                        foreach ($chats as $chat) {
                            ?>
                            <?php if($chat->user1->id != Yii::$app->user->identity->id) { ?>
                                <li class="person" data-chat="<?= $chat->channel;?>" data-user-id="<?= $chat->user1->id?>">
                                    <img src="<?= Yii::$app->urlManager->baseUrl?>/images/user.png" alt="" />
                                    <span class="name"><?= $chat->user1->name; ?></span>
                                    <!--<span class="time">2:09 PM</span>
                                    <span class="preview">I was wondering...</span>-->
                                </li>
                            <?php } else { ?>
                                <li class="person" data-chat="<?= $chat->channel;?>" data-user-id="<?= $chat->user2->id?>">
                                    <img src="<?= Yii::$app->urlManager->baseUrl?>/images/user.png" alt="" />
                                    <span class="name"><?= $chat->user2->name; ?></span>
                                    <!--<span class="time">2:09 PM</span>
                                    <span class="preview">I was wondering...</span>-->
                                </li>
                            <?php } ?>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="right">
                <div class="top"><span>To: <span class="name">Select User</span></span></div>

                    <div class="chat" data-chat="">
                        <!--<div class="conversation-start">
                            <span>Monday, 1:27 PM</span>
                        </div>-->
                    </div>

                <div class="write">
                    <input type="hidden" value="" id="receiver_id">
                    <input type="text" placeholder="Send message.." id="message" />
                    <a href="#" class="write-link send"></a>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>

<?php } ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script>
    //$('.chat[data-chat=person2]').addClass('active-chat');
    //$('.person[data-chat=person2]').addClass('active');
    var badWords = [<?= '"'.implode('","', $badWords).'"' ?>];

    // Load Messages
    function loadMessage(channel)
    {
        $.ajax({
            url: "<?= Yii::$app->urlManager->createUrl(['site/load-message']); ?>",
            type: 'post',
            data: {channel: channel},
            cache: false,
            success: function (response) {
                var data = JSON.parse(response);
                if(data.status == 'success') {
                    $('#message').val('');
                    var html = '';
                    $('.chat[data-chat = "'+channel+'"]').html('');
                    $.each(data.data, function(index, item) {
                        if(item.me) {
                            html = '<div class="bubble me">'+item.me+'</div>';
                            $('.chat[data-chat = "'+channel+'"]').append(html);
                        } else {
                            html = '<div class="bubble you">'+item.you+'</div>';
                            $('.chat[data-chat = "'+channel+'"]').append(html);
                        }
                    });
                }
            }
        });
    }

    function sendMessage()
    {
        var valid = true;

        if(badWords.length > 1) {
            var regex = new RegExp('\\b' + badWords.join("\\b|\\b") + '\\b', 'i');

            // Regex would equal /\bcat\b|\bdog\b|\btest\b/i
            valid = !regex.test($("#message").val());
        }

        if(valid) {
            var message = $('#message').val();
            var receiver_id = $('#receiver_id').val();
            var channel = $('.person.active').attr('data-chat');
            $.ajax({
                url: "<?= Yii::$app->urlManager->createUrl(['site/send-message']); ?>",
                type: 'post',
                data: {message: message,receiver_id: receiver_id,channel: channel},
                success: function (response) {
                    $('#message').val('');
                }
            });
        } else {
            alert("Your message contains inappropriate words. Please clean up your message.");
        }
    }

    // Send message
    $('.send').on('click', function(e) {
        sendMessage();
        e.preventDefault();
    });

    // Begin chat
    $('#create-chat').on('click', function(e) {
        var user_2_id = $('#user_2').val();
        $.ajax({
            url: "<?= Yii::$app->urlManager->createUrl(['site/create-chat']); ?>",
            type: 'post',
            data: {user_2: user_2_id},
            success: function (response) {
                var data = JSON.parse(response);
                console.log(data);
                if(data.status == 'success') {
                    $('#user').val('');
                    var userHtml = '<li class="person" data-chat="'+data.channel+'">' +
                        '<img src="images/user.png" alt="" />' +
                        '<span class="name">'+data.user_2+'</span>';
                    $('.people').append(userHtml);
                    $('.chat').attr('data-chat',data.channel);
                    $('.person[data-chat = "'+data.channel+'"]').click();
                }
            }
        });

        e.preventDefault();
    });

    $('.left').on('click', '.person', function() {
        if ($(this).hasClass('.active')) {
            return false;
        } else {
            var findChat = $(this).attr('data-chat');
            var personName = $(this).find('.name').text();
            $('.right .top .name').html(personName);
            $('.chat').removeClass('active-chat');
            $('.left .person').removeClass('active');
            $(this).addClass('active');
            $('.chat').attr('data-chat',findChat);
            $('.chat[data-chat = '+findChat+']').addClass('active-chat');
            $('#receiver_id').val($(this).attr('data-user-id'));
            loadMessage(findChat);
        }
    });

    $('#message').on('keypress', function (event) {
        if(event.which === 13) {
            sendMessage();
        }
    });
</script>