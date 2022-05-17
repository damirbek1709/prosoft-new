<?php
use app\models\Order;
$industries = Order::industryList();
?>
<div>
    <div class="custom-modal-desc count-modal-desc">
        <div>
            <div class="question_num">
                Вопрос <span>4</span> из 4
            </div>

            <div class="question_title">
                Нужна разработка дизайна?
            </div>
            <div class="question_amount">
                Выберите один или несколько вариантов
            </div>

            <!-- <div class="question_options">
                <div class="quest_option option_1">Да, нужно разработать дизайн</div>
                <div class="quest_option option_2">Пока не решил</div>
                <div class="quest_option option_3">Нет, у меня есть дизайн проекта</div>
                <div class="quest_option option_4">Другое</div>
            </div> -->

            <?= $form->field($model, 'industry')->radioList($industries)->label(false); ?>
        </div>

        <div>
            <div class="modal-right-block">
                <div class="modal-info"></div>
                <div class="inner-modal-right">Считается, что самая платежеспособная аудитория - это пользователи iOS. Чаще всего разработку начинают именно с iOS, так как количество устройств на ней гораздо меньше, чем у Android - и приложение гораздо проще переделывать, учитывая пожелания пользователей.</div>
            </div>
        </div>
    </div>
</div>