<?php
/**
 * Created by PhpStorm.
 * User: xiaoaix
 * Date: 2016/6/27
 * Time: 14:01
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


?>
<br><br>
<br>
<br>

<?php $form = ActiveForm::begin() ?>
<div class="row">
    <div class="col-lg-4">
        <div class="row" >
            <img src="img/login.png" alt="login" style="border-radius: 10px;">
        </div>
    </div>
    <div class="col-lg-2"></div>
    <div class="col-lg-5">
        <div class="row">
            <div class="col-lg-12">
                <?= $form->field($user, 'username')->textInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?= $form->field($user, 'password')->passwordInput() ?>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php $form = ActiveForm::end() ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert-info" style="height:42px;padding:10px;">
                    <span style="font-size:22px;"><?php echo $error; ?></span>
                </div>
            </div>
        </div>


        <br><br>
        <br>
        <br>
    </div>
</div>



