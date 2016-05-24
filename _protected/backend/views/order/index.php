<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <p class="pull-right">
                        <?= Html::a('Create Orders', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>
                    <?php Pjax::begin(); ?>    <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn',"header"=>"Sr.No."],
                                [
                                    'attribute' => 'user_id',
                                    'value' => function ($model) {
                                        if ($model->user_id) {
                                            return $model->user->fname.' '.$model->user->lname;
                                        } else {
                                            return 'Not user';
                                        }
                                    },
                                    'contentOptions' => ['style' => 'width:160px;text-align:center'],
                                    'format' => 'raw',
                                ],
                                [
                                    'attribute' => 'guest_id',
                                    'value' => function ($model) {
                                        if ($model->guest_id) {
                                            return $model->guest->fname.' '.$model->guest->lname;
                                        } else {
                                            return 'Not Guest';
                                        }
                                    },
                                    'contentOptions' => ['style' => 'width:160px;text-align:center'],
                                    'format' => 'raw',
                                ],
                                'items_count',
                                //'price_total',
                                 'delivery_charges',
                                 'discount',
                                // 'discount_id',
                                 'grand_total',
                                // 'locked',
                                 'payment_method',
                                 'payment_status',
                                 'status',
                                 'created_at:Date',
                                // 'updated_at',

                                ['class' => 'yii\grid\ActionColumn','header'=>'Actions',
                                    'buttons' => [
                                        'viewcoupons' =>function ($url, $model, $key) {
                                            $options = array_merge([
                                                'title' => Yii::t('yii', 'View Coupons'),
                                                'aria-label' => Yii::t('yii', 'View Coupons'),
                                                'data-pjax' => '0',
                                            ], []);
                                            return Html::a('<span class="glyphicon glyphicon-folder-open"></span>', ['discount-code/index','id'=>$model->id], $options);
                                        },

                                    ],
                                    'template' => '{viewcoupons}{update}', 'contentOptions' => ['style' => 'width:160px;letter-spacing:10px;text-align:center'],
                                ],
                            ],
                        ]); ?>
                    <?php Pjax::end(); ?>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>


