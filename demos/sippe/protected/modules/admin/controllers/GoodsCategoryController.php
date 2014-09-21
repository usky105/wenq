<?php

class GoodsCategoryController extends AdminController
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['GoodsCategory']))
		{
			$model->attributes=$_POST['GoodsCategory'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->category_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('GoodsCategory');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new GoodsCategory;
		$type_id = Yii::app()->request->getParam("type_id");
		$model_type = array();
		$param = array();		
		
		if(!is_null($type_id)) {
			$model_type = GoodsType::model()->findByPk($type_id); 
			$param = array('type_id'=>$type_id);	
		}

		$redirect = array_merge(array('goodsCategory/admin'),$param);

		if(isset($_POST['GoodsCategory']))
		{
			$model->attributes=$_POST['GoodsCategory'];			
			if($model->save())
				$this->redirect($redirect);
		}

		$this->render('create',array(
			'model'=>$model,
			'model_type' => $model_type,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$type_id = Yii::app()->request->getParam("type_id");
		$model_type = array();		

		$model=new GoodsCategory('search');
		$model->unsetAttributes();  // clear any default values

		if(!is_null($type_id)) {
			$model->type_id = $type_id;
			$model_type = GoodsType::model()->findByPk($type_id); 	
		}

		if(isset($_GET['GoodsCategory']))
			$model->attributes=$_GET['GoodsCategory'];

		$this->render('admin',array(
			'model'=>$model,
			'model_type' => $model_type,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return GoodsCategory the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=GoodsCategory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param GoodsCategory $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='goods-category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
