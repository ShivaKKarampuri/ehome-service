<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Category extends Authenticatable
{
    use Notifiable;
	use Sortable;

	protected $fillable = [
        'id', 'title', 'created_at', 'updated_at'
    ];
	
	public $sortable = ['id', 'title', 'created_at', 'updated_at'];
	
	public function categoryData()
    {
        return $this->belongsTo('App\Category','parent');
    }
	
	public function buildTree(Array $data, $parent = 0) {
    $tree = array();
    foreach ($data as $d) {
        if ($d['parent'] == $parent) {
            $children = Self::buildTree($data, $d['id']);
            // set a trivial key
            if (!empty($children)) {
                $d['_children'] = $children;
            }
            $tree[] = $d;
        }
    }
    return $tree;
} 

	public static function printTree($tree, $r = 0, $p = null, $select = null) {
		foreach ($tree as $i => $t) {
			$dash = ($t['parent'] == 0) ? '' : str_repeat('-', $r) .' ';
			$selected = ($t['id'] == $select) ? 'selected' : ' ';
			printf("\t<option value='%d' %s>%s%s</option>\n", $t['id'],$selected, $dash, $t['name']);
			if ($t['parent'] == $p) {
				// reset $r
				$r = 0;
			}
			if (isset($t['_children'])) {
				Self::printTree($t['_children'], ++$r, $t['parent'], $select);
			}
		}
	}
}