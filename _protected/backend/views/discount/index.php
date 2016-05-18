<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\DiscountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Coupons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discount-index">

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <p class="pull-right">
                        <?= Html::a('Create Coupon', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>
                    <?php Pjax::begin(); ?>    <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn',"header"=>"Sr.No."],

                                //'id',
                                'name',
                                //'description',
                                //'coupon_type',
                                'coupon_code',
                                // 'uses_per_coupon',
                                // 'uses_per_customer',
                                 'start_date:Date',
                                 'end_date:Date',
                                // 'discount_type',
                                // 'discount_amount',
                                // 'quantity',
                                 'quantity_used',
                                 'quantity_left',
                                //'locked',
                                [
                                    'attribute' => 'status',
                                    'value' => function ($model) {
                                        if ($model->status) {
                                            return Html::a(Yii::t('app', 'Active'), null, [
                                                'class' => 'btn btn-success status',
                                                'data-id' => $model->id,
                                                'href' => 'javascript:void(0);',
                                            ]);
                                        } else {
                                            return Html::a(Yii::t('app', 'Inactive'), null, [
                                                'class' => 'btn btn-danger status',
                                                'data-id' => $model->id,
                                                'href' => 'javascript:void(0);',
                                            ]);
                                        }
                                    },
                                    'contentOptions' => ['style' => 'width:160px;text-align:center'],
                                    'format' => 'raw',
                                    'filter'=>array("1"=>"Active","0"=>"Inactive"),
                                ],

                                 'created_at:Date',
                                // 'updated_at',

                                ['class' => 'yii\grid\ActionColumn','header'=>'Actions',
                                    'buttons' => [
                                        'viewcoupons' =>function ($url, $model, $key) {
                                            $options = array_merge([
                                                'title' => Yii::t('yii', 'View Items'),
                                                'aria-label' => Yii::t('yii', 'View Items'),
                                                'data-pjax' => '0',
                                            ], []);
                                            return Html::a('<span class="glyphicon glyphicon-folder-open"></span>', ['coupon-code/index','id'=>$model->id], $options);
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

