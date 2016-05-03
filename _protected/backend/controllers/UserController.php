<?php
namespace backend\controllers;

use common\models\User;
use common\models\UserSearch;
use common\models\AmbsOnboarding;
use common\models\AmbassadorProfile;
use common\rbac\models\Role;
use Yii;
use yii\base\Model;
use yii\web\NotFoundHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends BackendController
{
    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     *
     * @param  integer $id The user id.
     * @return string
     *
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $user = new User(['scenario' => 'create']);
        $user->chapter_id = 0;
        $role = new Role();

        if ($user->load(Yii::$app->request->post()) && 
            $role->load(Yii::$app->request->post()) &&
            Model::validateMultiple([$user, $role]))
        {
            $user->setPassword($user->password);
            $user->generateAuthKey();
            
            if ($user->save()) 
            {
                $role->user_id = $user->getId();
                $role->save(); 
            }  

            return $this->redirect('index');      
        } 
        else 
        {
            return $this->render('create', [
                'user' => $user,
                'role' => $role,
            ]);
        }
    }

    public function actionCreateAmbassador($id = 0)
    {   $user = new User(['scenario' => 'create']);
        $role = new Role();

        if ($user->load(Yii::$app->request->post()) &&
            $role->load(Yii::$app->request->post()) &&
            Model::validateMultiple([$user, $role]))
        {
            $user->setPassword($user->password);
            $user->generateAuthKey();

            if ($user->save())
            {
                $role->user_id = $user->getId();
                $role->save();
                if($id != 0){
                    $data = AmbsOnboarding::findOne($id);
                    $data->updateAttributes(['approved' => 1]);

                    $ambas_model = new AmbassadorProfile;

                    foreach($data as $key => $value){
                        if($key != 'id' && $key != "approved" && $key != "created_at" && $key != "updated_at")
                            $ambas_model->$key =  $value;
                    }
                    $ambas_model->user_id =  $user->id;
                    $ambas_model->onboarding_id =  $data->id;

                    $ambas_model->save();



                }

            }
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Ambassdor has been Created successfully!'));
            return $this->redirect(['update', 'id' => $user->id]);
        }
        else
        {
            if($id != 0){
                $data = AmbsOnboarding::findOne($id);

                if($data){
                    $user->email =  $data->email;
                    $user->chapter_id =  $data->chapter;
                    return $this->render('create-ambassador', [
                        'user' => $user,
                        'role' => $role,
                        'board' => $data,
                    ]);
                }else{
                    return $this->render('create-ambassador', [
                        'user' => $user,
                        'role' => $role,
                    ]);
                }

            }else{
                $data = AmbsOnboarding::findOne($id);
                return $this->render('create-ambassador', [
                    'user' => $user,
                    'role' => $role,
                    'board' => $data,
                ]);
            }

        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param  integer $id The user id.
     * @return string|\yii\web\Response
     *
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        // get role
        $role = Role::findOne(['user_id' => $id]);

        // get user details
        $user = $this->findModel($id);

        // only The Creator can update everyone`s roles
        // admin will not be able to update role of theCreator
        if (!Yii::$app->user->can('theCreator')) 
        {
            if ($role->item_name === 'theCreator') 
            {
                return $this->goHome();
            }
        }

        // load user data with role and validate them
        if ($user->load(Yii::$app->request->post()) && 
            $role->load(Yii::$app->request->post()) && Model::validateMultiple([$user, $role])) 
        {
            // only if user entered new password we want to hash and save it
            if ($user->password) 
            {
                $user->setPassword($user->password);
            }

            // if admin is activating user manually we want to remove account activation token
            if ($user->status == User::STATUS_ACTIVE && $user->account_activation_token != null) 
            {
                $user->removeAccountActivationToken();
            }            

            $user->save(false);
            $role->save(false);
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Profile updated successfully!'));

            return $this->redirect(['update', 'id' => $user->id]);
        }
        else 
        {
            if($role->item_name == "ambassador") {
                if($id != 0){
                    $data = AmbassadorProfile::find()->where(['user_id' =>  $user->id])->one();

                    if($data){
                        $user->email =  $data->email;
                        $user->chapter_id =  $data->chapter;
                        return $this->render('updateambassador', [
                            'user' => $user,
                            'role' => $role,
                            'board' => $data,
                        ]);
                    }else{
                        return $this->render('create-ambassador', [
                            'user' => $user,
                            'role' => $role,
                        ]);
                    }

                }

            }else {

                return $this->render('update', [
                    'user' => $user,
                    'role' => $role,
                ]);
            }
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param  integer $id The user id.
     * @return \yii\web\Response
     *
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {

        $data = AmbassadorProfile::find()->where(['user_id'=>$id])->one();

        $data1 = AmbsOnboarding::findOne($data->onboarding_id);
		if($data1){
			$data1->updateAttributes(['approved' => 0]);
			$data->delete();
		}
        $this->findModel($id)->delete();

        // delete this user's role from auth_assignment table
        if ($role = Role::find()->where(['user_id'=>$id])->one()) 
        {
            $role->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param  integer $id The user id.
     * @return User The loaded model.
     *
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) 
        {
            return $model;
        } 
        else 
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
