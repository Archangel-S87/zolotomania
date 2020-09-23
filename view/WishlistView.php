<?PHP

require_once('View.php');

class WishlistView extends View
{
    var $limit = 150;

    public function __construct()
    {
        parent::__construct();
    }

    //////////////////////////////////////////
    // Основная функция
    //////////////////////////////////////////
    function fetch()
    {
        $limit = 150;
        
        $id = $this->request->get('id', 'integer');
        
        if(!empty($_COOKIE['wished_products'])) {
            $products_ids = explode(',', $_COOKIE['wished_products']);
            $products_ids = array_reverse($products_ids);
        }
        else
            $products_ids = array();
            
        if($this->request->get('action', 'string') == 'delete') {
            $key = array_search($id, $products_ids);
            unset($products_ids[$key]);    
			header('Location: /wishlist');
        }   
        elseif($id > 0) {
            array_push($products_ids, $id);
            $products_ids = array_unique($products_ids);        
        }

        $products_ids = array_slice($products_ids, 0, $limit);
        $products_ids = array_reverse($products_ids);
        
        if(!count($products_ids)) {
            unset($_COOKIE['wished_products']);
            setcookie('wished_products', '', time()-365*24*3600, '/');
        }
        else
            setcookie('wished_products', implode(',', $products_ids), time()+365*24*3600, '/');       
        
        $variants = $this->request->get('v'); 
        if(!empty($variants)) $filter['variants'] = $variants; 
        
        $variants1 = $this->request->get('v1'); 
        if(!empty($variants1)) $filter['variants1'] = $variants1; 

        $variants2 = $this->request->get('v2'); 
        if(!empty($variants2)) $filter['variants2'] = $variants2; 

        $products = array();
        
        if(count($products_ids)) {

            
            foreach($this->products->get_products(array('id'=>$products_ids)) as $p)
                $products[$p->id] = $p;

            $variants = $this->variants->get_variants(array('product_id'=>$products_ids, 'in_stock'=>true));
            
            foreach($variants as &$variant)
            {
                $products[$variant->product_id]->variants[] = $variant;
            }
            
            foreach($this->products->get_images(array('product_id'=>$products_ids)) as $image)
            if(isset($products[$image->product_id]))
                $products[$image->product_id]->images[] = $image;
          
            foreach($products_ids as $id)
            {  
                if(isset($products[$id]))
                {
                    if(isset($products[$id]->images[0]))
                        $products[$id]->image = $products[$id]->images[0];

                }
            }
            foreach($products as &$product)
            {
                $get_categories = $this->categories->get_categories(array('product_id'=>$product->id));
                $product->category = reset($get_categories);
                if(isset($product->variants[0]))
                    $product->variant = $product->variants[0];
                if(isset($product->images[0]))
                    $product->image = $product->images[0];

                $ids=array();   
                if(isset($product->variants) && is_array($product->variants)){
                    foreach ($product->variants as $k => $v) {
                        if(!empty($v->name1) or !empty($v->name2)){
                            $ids[0][$v->name1][] = $v->id;
                            $ids[1][$v->name2][] = $v->id;
                        }
                        // Привязка к магазину
                        if ($v->shop_id) $v->shop = $this->variants->get_shop($v->shop_id);
                    }
                }
                $classes=array();
                for($i=0;$i<2;$i++) 
                if(isset($ids[$i]) && is_array($ids[$i]))foreach ($ids[$i] as $name => $ids1) {
                    $classes[$i][$name]='c'.join(' c', $ids1);
                }
                $product->vproperties = $classes;
            }
            
        }

        // Содержимое сравнения товаров
        $this->design->assign('wished_products', $products);

        // Выводим шаблона
        return $this->design->fetch('wishlist.tpl');
    }

}
