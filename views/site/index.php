<?php

use yii\helpers\Url;
use yii\helpers\Html;

/** @var yii\web\View $this */
$this->title = Yii::$app->name;
?>
<link rel="stylesheet" type="text/css" href="<?= Url::base(); ?>/js/slick/slick.css" />
<link rel="stylesheet" type="text/css" href="<?= Url::base(); ?>/js/slick/slick-theme.css" />
<script type="text/javascript" src="<?= Url::base(); ?>/js/slick/slick.min.js"></script>

<div class="site-index">
    <div class="intro-cover">
        <div class="container">
            <div class="intro-text">
                <div class="slogan_one">
                    Создавайте, масштабируйте, контролируйте свой бизнес вместе с нами
                </div>
                <div class="slogan_two">
                    Разработка мобильных приложений и сайтов
                </div>
                <div class="inquiry_create">
                    Оставить заявку
                </div>
            </div>
        </div>
    </div>

    <div class="body-content">
        <?= $this->render('portfolio') ?>
        <?= $this->render('digits') ?>
        <?= $this->render('count'); ?>
        <?= $this->render('service'); ?>
        <?= $this->render('stages'); ?>
        <?= $this->render('offer'); ?>
        <?= $this->render('clients'); ?>
        <?= $this->render('feedback'); ?>
        <?= $this->render('inquiry'); ?>
    </div>
</div>
<script>
    var count_id = '';
    $('.portfolio-slider').slick({
        infinite: true,
        slidesToShow: 1, // Shows a three slides at a time
        slidesToScroll: 1, // When you click an arrow, it scrolls 1 slide at a time
        arrows: true, // Adds arrows to sides of slider
        dots: false, // Adds the dots on the bottom
        //fade: true,
        easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
        mode: 'slide',
        prevArrow: '<i class="slick-prev custom-prev"></i>',
        nextArrow: '<i class="slick-next custom-next"></i>',
        responsive: [{
            breakpoint: 1024,
            settings: {
                arrows: false,
                dots: true
            }
        }, ]
    });

    $('.feedback-slider').slick({
        infinite: true,
        slidesToShow: 1, // Shows a three slides at a time
        slidesToScroll: 1, // When you click an arrow, it scrolls 1 slide at a time
        arrows: true, // Adds arrows to sides of slider
        asNavFor: '.test-small-slick',
        fade: true,
        dots: false,
        easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
        prevArrow: '<i class="slick-prev custom-prev"></i>',
        nextArrow: '<i class="slick-next custom-next"></i>',
        responsive: [{
            breakpoint: 1024,
            settings: {
                arrows: false,
                dots: true
            }
        }, ]
    });

    $('.test-small-slick').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.feedback-slider',
        dots: false,
        centerMode: true,
        focusOnSelect: true,
        arrows: false,
        infinite: true,
    });

    let question = document.querySelectorAll(".question");
    question.forEach(question => {
        question.addEventListener("click", event => {
            const active = document.querySelector(".question.active");
            const answer = question.nextElementSibling;
            $('.accordeon-container').removeClass('amorting');

            if (active && active !== question) {
                active.classList.toggle("active");
                active.nextElementSibling.style.maxHeight = 0;
            }
            question.classList.toggle("active");

            if (question.classList.contains("active")) {
                answer.style.maxHeight = answer.scrollHeight + "px";
                question.parentElement.classList.add('amorting');
            } else {
                answer.style.maxHeight = 0;
                question.parentElement.classList.remove('amorting');
            }

        })
    });

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    $(".call_click").click(function(e) {
        e.stopImmediatePropagation();
        e.preventDefault();
        var thisOne = $(this);
        var form = $(".callback-form-gq");
        console.log(form.serialize());
        if (form.find('.has-error').length) {
            return false;
        }
        $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: form.serialize(),
            beforeSend: function() {
                thisOne.addClass('inquiry-loading');
            },
            success: function(response) {
                thisOne.removeClass('inquiry-loading');
                if (response != 'false') {
                    $('.custom-modal-header').text('Заявка на звонок');
                    $(".custom-modal-text").text(response);
                    jQuery("#getCodeModal").modal('show');
                }
            }
        });
        return false;
    });

    var form = $('.inquiry-phone-form');
    $('.inquiry_create').on('click', function(e) {
        $('#getCodeModal').addClass('phone-inquiry');
        e.stopImmediatePropagation();
        e.preventDefault();
        $('#getCodeModal .custom-modal-header').text('Оставьте ваши контакты и мы обязательно вам перезвоним');
        $('#getCodeModal .custom-modal-desc').text('Закажите бесплатный звонок и мы перезвоним вам в течении 24 часов.');

        form.appendTo('#getCodeModal .custom-modal-text');
        form.css('display', 'block');
        $('#getCodeModal .custom-modal-text .btn-callback').text('Оставить заявку');
        jQuery("#getCodeModal").modal('show');
    });


    $(".btn-callback").click(function(e) {
        e.stopImmediatePropagation();
        e.preventDefault();
        var thisOne = $(this);
        var form = $("#phone-inquiry");
        if (form.find('.has-error').length) {
            return false;
        }
        $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: form.serialize(),
            beforeSend: function() {
                thisOne.addClass('inquiry-loading');
            },
            success: function(response) {
                thisOne.removeClass('inquiry-loading');
                if (response != 'false') {
                    $('.custom-modal-header').text('Заявка на звонок');
                    $(".custom-modal-text").text(response);
                    //jQuery("#getCodeModal").modal('show');
                } else {
                    var inquiry_div = form.find('.field-inquiry-phone');
                    inquiry_div.addClass('has-error');
                    inquiry_div.append('<div class="help-block">Необходимо заполнить «Phone».</div>');
                }
            }
        });
        return false;
    });

    $("#getCodeModal").on('hidden.bs.modal', function() {
        $('#getCodeModal .custom-modal-header').text('');
        $("#getCodeModal .custom-modal-text").html('');
        $("#getCodeModal .custom-modal-desc").text('');
    });

    $("#getCountModal").on('shown.bs.modal', function(e) {
        $('.count_slider').slick('setPosition');
        $('.wrap-modal-slider').addClass('open');
    });



    $(document).ready(function() {
        $('.count-btn').on('click', function(e) {
            $('#getCountModal').addClass('phone-inquiry');
            e.stopImmediatePropagation();
            e.preventDefault();
            // $('.custom-modal-header').text('');
            // $('.custom-modal-desc').text('');       
            jQuery("#getCountModal").modal('show');
        });

        $('.count_slider').slick({
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            draggable: false,
            responsive: [{
                breakpoint: 1080,
                settings: {
                    adaptiveHeight: true,
                }
            }, ]
        });

        $('#order-price_range').on('slide', function(ev) {
            var myString = $('#order-price_range').val();
            var parts = myString.split(',');
            $('.price_digit_min').text(parts[0]);
            $('.price_digit_max').text(parts[1]);
        });
    });

    var counter = 1;
    $('.question_back').click(function() {
        $('.count_slider').slick('slickPrev');
        counter = counter - 1;
        $('.question_next').find('span').text('Далее');
        if (counter > 1) {

        }
    });


    $('.question_next').click(function() {
        $('.count_slider').slick('slickNext');
        counter = counter + 1;
        if (counter < 4) {

        } else if (counter == 4) {
            $(this).find('span').text('Готово');
        } else if (counter > 4) {
            var thisOne = $(this);
            var form = $(".order_form");
            if (form.find('.has-error').length) {
                return false;
            }
            $.ajax({
                url: '/web/order/create',
                type: 'post',
                data: form.serialize(),
                beforeSend: function() {
                    thisOne.addClass('inquiry-loading');
                },
                success: function(response) {
                    if (response != 'false') {
                        count_id = parseInt(response);
                        $('.modal-body').html("<div class='modal-success-header'>Отлично!</div><div class='modal-shortener'>" +
                            "<div class='custom-modal-desc text-align-center'>Результаты уже поступили в систему. Приблизительная оценка вашего  проекта...</div>" +
                            "<div class='custom-modal-grid-two'>" +
                            "<div class='modal-grid-col'><div class='modal-grid-col-text'>Стоимость создания вашего проекта</div><div class='modal-counted-data'>$ 2300</div></div>" +
                            "<div class='modal-grid-col'><div class='modal-grid-col-text'>Сроки для разработки вашего проекта</div><div class='modal-counted-data'>ч. 543</div></div>" +
                            "</div>" +
                            "<div class='custom-modal-desc text-align-center'>Хотите увидеть расчеты прямо сейчас? Заполните ваши данные.</div></div>"
                        );
                        $('.modal-body').append($('.order_personal_data'));
                        $('.order_personal_data').css('display', 'block');
                    }
                }
            });
            return false;
        }
    });
</script>