<?php

namespace thienhungho\WarehouseManagement\modules\WarehouseVoucherManage\controllers;

use thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseVoucher;
use thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseVoucherItems;
use thienhungho\WarehouseManagement\modules\WarehouseVoucherManage\search\WarehouseVoucherSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * WarehouseVoucherController implements the CRUD actions for WarehouseVoucher model.
 */
class WarehouseVoucherController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all WarehouseVoucher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WarehouseVoucherSearch();
        $queryParams = request()->queryParams;
        $dataProvider = $searchModel->search($queryParams);
        $dataProvider->sort->defaultOrder = ['id' => SORT_DESC];

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerWarehouseVoucherItems = new \yii\data\ArrayDataProvider([
            'allModels' => $model->warehouseVoucherItems,
        ]);

        return $this->render('view', [
            'model'                         => $this->findModel($id),
            'providerWarehouseVoucherItems' => $providerWarehouseVoucherItems,
        ]);
    }

    /**
     * @param string $type
     *
     * @return string|\yii\web\Response
     * @throws \yii\db\Exception
     */
    public function actionCreate($type = WarehouseVoucher::TYPE_IN_PUT)
    {
        $model = new WarehouseVoucher([
            'name'        => 'VOUCHER-' . date('Ymdhis'),
            'date'        => date('Y-m-d h:i:s'),
            'status'      => WarehouseVoucher::STATUS_UNPAID,
            'employee_id' => get_current_employee_id(),
            'is_locked'   => 0,
            'type'        => $type,
        ]);
        if ($model->loadAll(request()->post())) {
            if ($model->saveAll()) {
                $model->total_price = WarehouseVoucherItems::find()
                    ->where(['warehouse_voucher' => $model->id])
                    ->sum('total_price');
                $model->save();
                set_flash_has_been_saved();

                return $this->redirect([
                    'update',
                    'id' => $model->id,
                ]);
            } else {
                set_flash_has_not_been_saved();
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     *
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionUpdate($id)
    {
        if (request()->post('_asnew') == '1') {
            $model = new WarehouseVoucher();
        } else {
            $model = $this->findModel($id);
        }
        if ($model->loadAll(request()->post())) {
            if ($model->saveAll()) {
                $model->total_price = WarehouseVoucherItems::find()
                    ->where(['warehouse_voucher' => $model->id])
                    ->sum('total_price');
                $model->save();
                set_flash_has_been_saved();

                return $this->redirect([
                    'update',
                    'id' => $model->id,
                ]);
            } else {
                set_flash_has_not_been_saved();
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     *
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    /**
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionBulk()
    {
        $action = request()->post('action');
        $ids = request()->post('selection');
        if (!empty($ids)) {
            if ($action == ACTION_DELETE) {
                foreach ($ids as $id) {
                    $model = $this->findModel($id);
                    if ($model->deleteWithRelated()) {
                        set_flash_success_delete_content();
                    } else {
                        set_flash_error_delete_content();
                    }
                }
            } elseif ($action == WarehouseVoucher::STATUS_PAID) {
                foreach ($ids as $id) {
                    $model = $this->findModel($id);
                    $model->status = WarehouseVoucher::STATUS_PAID;
                    if ($model->save()) {
                        set_flash_has_been_saved();
                    } else {
                        set_flash_has_not_been_saved();
                    }
                }
            } elseif ($action == WarehouseVoucher::STATUS_UNPAID) {
                foreach ($ids as $id) {
                    $model = $this->findModel($id);
                    $model->status = WarehouseVoucher::STATUS_UNPAID;
                    if ($model->save()) {
                        set_flash_has_been_saved();
                    } else {
                        set_flash_has_not_been_saved();
                    }
                }
            } elseif ($action == 'locked') {
                foreach ($ids as $id) {
                    $model = $this->findModel($id);
                    $model->is_locked = 1;
                    if ($model->save()) {
                        set_flash_has_been_saved();
                    } else {
                        set_flash_has_not_been_saved();
                    }
                }
            } elseif ($action == 'un locked') {
                foreach ($ids as $id) {
                    $model = $this->findModel($id);
                    $model->is_locked = 0;
                    if ($model->save()) {
                        set_flash_has_been_saved();
                    } else {
                        set_flash_has_not_been_saved();
                    }
                }
            }
        }

        return $this->goBack(request()->referrer);
    }

    /**
     * @param $id
     *
     * @return mixed
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionPdf($id)
    {
        $model = $this->findModel($id);
        $providerWarehouseVoucherItems = new \yii\data\ArrayDataProvider([
            'allModels' => $model->warehouseVoucherItems,
        ]);
        $content = $this->renderAjax('_pdf', [
            'model'                         => $model,
            'providerWarehouseVoucherItems' => $providerWarehouseVoucherItems,
        ]);
        $pdf = new \kartik\mpdf\Pdf([
            'mode'        => \kartik\mpdf\Pdf::MODE_UTF8,
            'format'      => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'content'     => $content,
            'cssFile'     => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline'   => '.kv-heading-1{font-size:18px}',
            'options'     => ['title' => \Yii::$app->name],
            'methods'     => [
                'SetHeader' => [\Yii::$app->name],
                'SetFooter' => ['{PAGENO}'],
            ],
        ]);

        return $pdf->render();
    }

    /**
     * @param $id
     *
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionSaveAsNew($id)
    {
        $model = new WarehouseVoucher();
        if (request()->post('_asnew') != '1') {
            $model = $this->findModel($id);
        }
        if ($model->loadAll(request()->post()) && $model->saveAll()) {
            $model->total_price = WarehouseVoucherItems::find()
                ->where(['warehouse_voucher' => $model->id])
                ->sum('total_price');
            $model->save();

            return $this->redirect([
                'view',
                'id' => $model->id,
            ]);
        } else {
            return $this->render('saveAsNew', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the WarehouseVoucher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return WarehouseVoucher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WarehouseVoucher::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionAddWarehouseVoucherItems()
    {
        if (request()->isAjax) {
            $row = request()->post('WarehouseVoucherItems');
            if ((request()->post('isNewRecord')
                    && request()->post('_action') == 'load'
                    && empty($row)) || request()->post('_action') == 'add')
                $row[] = [];

            return $this->renderAjax('_formWarehouseVoucherItems', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
