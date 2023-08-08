<?PHP

require_once('View.php');

class MainView extends View
{
	function fetch()
	{
		if($this->page)
		{
			$this->design->assign('meta_title', $this->page->meta_title);
			$this->design->assign('meta_keywords', $this->page->meta_keywords);
			$this->design->assign('meta_description', $this->page->meta_description);
			$this->setHeaderLastModify($this->page->last_modify, 432000);  // main page expires 604800 - 5 days
		}

		$main_categories = [];
		$all_categories = $this->categories->get_categories();
		foreach ($all_categories as $category) {
		    if ($category->parent_id == 0 && $category->visible) {
                $main_categories[] = $category;
            }
        }
        $this->design->assign('main_categories', $main_categories);

		return $this->design->fetch('main.tpl');
	}
}
