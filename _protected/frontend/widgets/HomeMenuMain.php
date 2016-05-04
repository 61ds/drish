<?php
class HomeMenuMain extends Widget
{
	public function run()
	{
		$footer_menu = Menu::findOne(['id' => 25,'active'=>1]);
		$children = $footer_menu->children(1)->all();
		$menus = array();
		$j = 0;
		foreach($children as $childs){
			if($childs->active != 1)
				continue;
			$sub_children = $childs->children(1)->all();
		}
		return $this->render('homeMenuMain', [
			'menus' =>  $menus,
        ]);
		
	}
}