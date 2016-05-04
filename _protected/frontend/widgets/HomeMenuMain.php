<?phpnamespace frontend\widgets;use Yii;use yii\base\Widget;use common\models\Menu;
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
			$sub_children = $childs->children(1)->all();						$i = 0;			$menus[$childs->id]['name'] = $childs->name;			$menus[$childs->id]['link'] = $childs->link;			$menus[$childs->id]['icon'] = $childs->icon;			if($sub_children){				foreach($sub_children as $sub_child){					if($sub_child->active != 1)					{ continue; }													$sub_children1 = $sub_child->children(1)->all();						$i = 0;						$menus[$childs->id]['child'][] = $sub_child;						if($sub_children1){							foreach($sub_children1 as $sub_child1){								if($sub_child1->active != 1)								{ continue; }																	$i = 0;									$menus[$childs->id][$sub_child1->id]['subchild'][] = $sub_child1;							}						}										}			}
		}
		return $this->render('homeMenuMain', [
			'menus' =>  $menus,
        ]);
		
	}
}