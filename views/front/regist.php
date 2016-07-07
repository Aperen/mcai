<?php
/**
 * Created by PhpStorm.
 * User: xiaoaix
 * Date: 2016/6/27
 * Time: 14:02
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<br><br>
<br>
<br>
<?php $form = ActiveForm::begin() ?>
<?= $form->field($user, 'username')->textInput() ?>
<?= $form->field($user, 'password')->passwordInput() ?>

<div class="form-group">
    <?= Html::submitButton('注册', ['class' => 'btn btn-primary']) ?>
</div>
<?php $form = ActiveForm::end() ?>
<div class="alert-info">
    <span style="font-size: 20px;"><?php echo $error; ?></span>
</div>
<br><br>
<br>
<br>

