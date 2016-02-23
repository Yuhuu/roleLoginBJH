<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'BJH',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
     //   ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'Norsk', 'options' => ['class' => 'btn btn-primary'],'url' => '#'],    
        ['label' => 'English', 'options' => ['class' => 'btn btn-primary'],'url' => '#']
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 
             'options' => ['class' => 'btn btn-primary'],
             'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => 'See student list', 
             'options' => ['class' => 'btn btn-primary'],
             'url' => ['/student/index']];
        $menuItems[] = [
            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
            'options' => ['class' => 'btn btn-primary'],
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']];
       
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
        <?php
    if (!Yii::$app->user->isGuest){
        echo '<!--sidebar start-->
   <div class="container">
   <div class="container-fluid">
      <aside>
          <div class="row-fluid">
               <div class="nav-collapse col-sm-2">
               <div class="well">
              <!-- sidebar menu start-->
              <ul class="nav-list nav">                
                  <li>
                    <label class="tree-toggle nav-header">Bootstrap</label>
                    <ul class="nav nav-list tree">
                        <li><a href="#">JavaScript</a></li>
                        <li><a href="#">CSS</a></li>
                    </ul>
                  </li>
                  <li>
                      <label class="tree-toggle nav-header">Buttons</label>
                            <ul class="nav nav-list tree">
                                <li><a href="#">Colors</a></li>
                                <li><a href="#">Sizes</a></li>
            
                            </ul>
                  </li>
                  <li class="sub-menu">
                      <label class="tree-toggle nav-header">Andre</label>
                        <ul class="nav nav-list tree">
                        <li><a href="#">JavaScript</a></li>
                        <li><a href="#">CSS</a></li>
                       
                    </ul>
                  </li> 
                   <li>
                      <label class="tree-toggle nav-header">Button3</label>
                            <ul class="nav nav-list tree">
                                <li><a href="#">Colors</a></li>
                                <li><a href="#">Sizes</a></li>
            
                            </ul>
                  </li>
                   <li><label class="tree-toggle nav-header">Buttons</label>
                            <ul class="nav nav-list tree">
                                <li><a href="#">Colors</a></li>
                                <li><a href="#">Sizes</a></li> 
                            </ul>
                        </li>
                        <li><label class="tree-toggle nav-header">Forms</label>
                                    <ul class="nav nav-list tree">
                                        <li><a href="#">Horizontal</a></li>
                                        <li><a href="#">Vertical</a></li>
                                    </ul>
                        </li>
                        
                    <li><label class="tree-toggle nav-header">Buttons</label>
                            <ul class="nav nav-list tree">
                                <li><a href="#">Colors</a></li>
                                <li><a href="#">Sizes</a></li> 
                            </ul>
                    </li>
              </ul>
            </div>
              <!-- sidebar menu end-->
          </div>
        </div>
      </aside>';
        }    
        ?>
    <div class="container">
        <?= Alert::widget() ?>
        <br>
        <br>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company </p>
        <p class="pull-right">footer</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
