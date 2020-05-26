<?PHP

require_once('api/Fivecms.php');

class ProductAdmin extends Fivecms
{
	public function fetch()
	{
	
		$options = array();
		$product_categories = array();
		$variants = array();
		$images = array();
		$product_features = array();
		$related_products = array();
		$option_delimiter='#';
	
		if($this->request->method('post') && !empty($_POST))
		{
			$product = new stdClass;
			$product->id = $this->request->post('id', 'integer');
			$product->name = $this->request->post('name');
			$product->visible = $this->request->post('visible', 'boolean');
			$product->featured = $this->request->post('featured', 'boolean');
			$product->is_new = $this->request->post('is_new', 'boolean');
			$product->to_yandex = $this->request->post('to_yandex', 'boolean');
			$product->brand_id = $this->request->post('brand_id', 'integer');

			$product->url = $this->request->post('url', 'string');
			$product->meta_title = $this->request->post('meta_title');
			$product->meta_keywords = $this->request->post('meta_keywords');
			$product->meta_description = $this->request->post('meta_description');
			
			$product->views = $this->request->post('views');
			$product->rating = $this->request->post('rating');
			$product->votes = $this->request->post('votes');
			
			$product->annotation = $this->request->post('annotation');
			$product->body = $this->request->post('body');

			// Варианты товара
			if($this->request->post('variants'))
			foreach($this->request->post('variants') as $n=>$va)
			{
				foreach($va as $i=>$v)
				{
					if(empty($variants[$i]))
						$variants[$i] = new stdClass;
					$variants[$i]->$n = $v;
				}
			}		
			
			// Категории товара
			$product_categories = $this->request->post('categories');
			if(is_array($product_categories))
			{
				foreach($product_categories as $c)

				{
					$x = new stdClass;
					$x->id = $c;
					$pc[] = $x;
				}
				$product_categories = $pc;
			}

			// Свойства товара
   	    	$options = $this->request->post('options');
			if(is_array($options))
			{
				foreach($options as $f_id=>$val)
				{
					$po[$f_id] = new stdClass;
					$po[$f_id]->feature_id = $f_id;
					$po[$f_id]->value = $val;
				}
				$options = $po;
			}

			// Связанные товары
			if(is_array($this->request->post('related_products')))
			{
				foreach($this->request->post('related_products') as $p)
				{
					$rp[$p] = new stdClass;
					$rp[$p]->product_id = $product->id;
					$rp[$p]->related_id = $p;
				}
				$related_products = $rp;
			}
				
			// Не допустить пустое название товара.
			if(empty($product->name))
			{			
				$this->design->assign('message_error', 'empty_name');
				if(!empty($product->id)){
					$images = $this->products->get_images(array('product_id'=>$product->id));
					$variants = $this->variants->get_variants(array('product_id'=>$product->id), 1);	
				}
			}
			// Не допустить одинаковые URL товаров.
			elseif(($p = $this->products->get_product($product->url)) && $p->id!=$product->id)
			{			
				$this->design->assign('message_error', 'url_exists');
				if(!empty($product->id)){
					$images = $this->products->get_images(array('product_id'=>$product->id));
					$variants = $this->variants->get_variants(array('product_id'=>$product->id), 1);
				}
			}
			else
			{
				if(empty($product->id))
				{
	  				$product->id = $this->products->add_product($product);
	  				$product = $this->products->get_product($product->id);
					$this->design->assign('message_success', 'added');
					
					//lastModify
					$last_categories = $this->request->post('categories');
					if(is_array($last_categories))
					{
						foreach($last_categories as $lc)
						{
							if (!empty($lc)) 
								$this->db->query("UPDATE __categories SET last_modify=NOW() WHERE id=? LIMIT 1", intval($lc));
						}
					}
					//lastModify end					
	  			}
  	    		else
  	    		{
  	    			$this->products->update_product($product->id, $product);
  	    			$product = $this->products->get_product($product->id);
					$this->design->assign('message_success', 'updated');
  	    		}	
   	    		
   	    		if($product->id)
   	    		{
   	    		
   	    			//lastModify
                    $this->db->query('select category_id from __products_categories where product_id=?', $product->id);
                    $c_ids = $this->db->results('category_id');
                    if (!empty($c_ids)) {
                        $this->db->query('update __categories set last_modify=now() where id in(?@)', $c_ids);
                    }
   	    		
	   	    		// Категории товара
	   	    		$query = $this->db->placehold('DELETE FROM __products_categories WHERE product_id=?', $product->id);
	   	    		$this->db->query($query);
	 	  		    if(is_array($product_categories))
		  		    {
		  		    	foreach($product_categories as $i=>$category)
	   	    				$this->categories->add_product_category($product->id, $category->id, $i);
	  	    		}
	
	   	    		// Варианты
		  		    if(is_array($variants))
		  		    { 
	 					$variants_ids = array();
						foreach($variants as $index=>&$variant)
						{

							if(!empty($variant->name1) && !empty($variant->name2)){
								$variant->name = $variant->name1 .' '. $variant->name2;
							}

							if(empty($variant->name1) && !empty($variant->name2)){
								$variant->name = $variant->name2;
							}

							if(!empty($variant->name1) && empty($variant->name2)){
								$variant->name = $variant->name1;
							}

							if($variant->stock == '∞' || $variant->stock == '')
								$variant->stock = null;
							
							// Пишем дату либо обнуляем
							if(!empty($variant->discount_date)) 
								$variant->discount_date = date('Y-m-d H:i', strtotime($variant->discount_date));
							else
								$variant->discount_date = null;
								
							// Удалить файл
							if(!empty($_POST['delete_attachment'][$index]))
							{
								$this->variants->delete_attachment($variant->id);
							}
	
		 					// Загрузить файлы
		 					if(!empty($_FILES['attachment']['tmp_name'][$index]) && !empty($_FILES['attachment']['name'][$index]))
		 					{
			 					$attachment_tmp_name = $_FILES['attachment']['tmp_name'][$index];					
			 					$attachment_name = $_FILES['attachment']['name'][$index];
		 						move_uploaded_file($attachment_tmp_name, $this->config->root_dir.'/'.$this->config->downloads_dir.$attachment_name);
		 						$variant->attachment = $attachment_name;
		 					}
	
							if(!empty($variant->id))
								$this->variants->update_variant($variant->id, $variant);
							else
							{
								$variant->product_id = $product->id;
								$variant->id = $this->variants->add_variant($variant);
							}
							$variant = $this->variants->get_variant($variant->id, 1);
							
							if(!empty($variant->id))
					 			$variants_ids[] = $variant->id;

						}
						
						// Удалить непереданные варианты
						$current_variants = $this->variants->get_variants(array('product_id'=>$product->id), 1);
						foreach($current_variants as $current_variant)
							if(!in_array($current_variant->id, $variants_ids))
	 							$this->variants->delete_variant($current_variant->id);
						
						// Отсортировать  варианты
						asort($variants_ids);
						$i = 0;
						foreach($variants_ids as $variant_id)
						{ 
							$this->variants->update_variant($variants_ids[$i], array('position'=>$variant_id));
							$i++;
						}
					}
	
					// Удаление изображений
					//$images = (array)$this->request->post('images');
					$images = (array)$this->request->post('images');
					$colors = $this->request->post('imagecolors');
					$current_images = $this->products->get_images(array('product_id'=>$product->id));
					foreach($current_images as $image)
					{
						if(!in_array($image->id, $images))
	 						$this->products->delete_image($image->id);
						}
	
					// Порядок изображений
					if($images = $this->request->post('images'))
					{
	 					$i=0;
						foreach($images as $id)
						{
							//$this->products->update_image($id, array('position'=>$i));
							$this->products->update_image($id, array('position'=>$i, 'color'=> $colors[$i]));
							$i++;
						}
					}
	   	    		// Загрузка изображений
		  		    if($images = $this->request->files('images'))
		  		    {
						for($i=0; $i<count($images['name']); $i++)
						{
				 			if ($image_name = $this->image->upload_image($images['tmp_name'][$i], $images['name'][$i]))
				 			{
			  	   				$this->products->add_image($product->id, $image_name);
			  	   			}
							else
							{
								$this->design->assign('error', 'error uploading image');
							}
						}
					}
	   	    		// Загрузка изображений из интернета
		  		    if($images = $this->request->post('images_urls'))
		  		    {
						foreach($images as $url)
						{
							if(!empty($url) && $url != 'https://' && $url != 'http://' && strstr($url,'/')!==false)
					 			$this->products->add_image($product->id, $url);
					 		elseif($dropped_images = $this->request->files('dropped_images'))
					  		{
					 			$key = array_search($url, $dropped_images['name']);
							 	if ($key!==false && $image_name = $this->image->upload_image($dropped_images['tmp_name'][$key], $dropped_images['name'][$key]))
						  	   				$this->products->add_image($product->id, $image_name);
							}
						}
					}
					$images = $this->products->get_images(array('product_id'=>$product->id));
					
					// Проверка загрузки всех изображений из интернета
					if(!empty($this->settings->check_download)){
						foreach($images as $url){
							if(!empty($url->filename) && (substr($url->filename,0,7) == 'http://' || substr($url->filename,0,8) == 'https://')){
								$new_name=$this->image->download_image($url->filename);
							}
						}
						$images = $this->products->get_images(array('product_id'=>$product->id));
					}	
					// Проверка загрузки всех изображений из интернета @
					
					$files 		= array();
					$files 		= (array)$this->request->post('files');

					// Удаление файлов
					$current_files = $this->files->get_files(array('object_id'=>$product->id,'type'=>'product'));
					foreach($current_files as $file)
						if(!in_array($file->id, $files['id']))
								$this->files->delete_file($file->id);

					// Порядок файлов
					if($files = $this->request->post('files')){
						$i=0;
						foreach($files['id'] as $k=>$id)
						{
							$this->files->update_file($id, array('name'=>$files['name'][$k],'position'=>$i));
							$i++;
						}
					}

					// Загрузка файлов
					if($files = $this->request->files('files')){
						for($i=0; $i<count($files['name']); $i++)
						{
						if ($file_name = $this->files->upload_file($files['tmp_name'][$i], $files['name'][$i])){
							$this->files->add_file($product->id, 'product', $file_name);
						}
						else {
							$this->design->assign('error', 'error uploading file');
						}
						}
					}

					$files = $this->files->get_files(array('object_id'=>$product->id,'type'=>'product')); 
	
	   	    		// Характеристики товара
	   	    		
	   	    		// Удалим все из товара
					foreach($this->features->get_product_options($product->id) as $po)
						$this->features->delete_option($product->id, $po->feature_id);
						
					// Свойства текущей категории
					$category_features = array();
					foreach($this->features->get_features(array('category_id'=>$product_categories[0])) as $f)
						$category_features[] = $f->id;
	
	  	    		//if(is_array($options))
					//foreach($options as $option)
					//{
					//	if(in_array($option->feature_id, $category_features))
					//		$this->features->update_option($product->id, $option->feature_id, $option->value);
					//}

					if(is_array($options))
					foreach($options as $option)
					{
						if(in_array($option->feature_id, $category_features)){
							$opts=explode($option_delimiter, $option->value);
							if(is_array($opts))foreach ($opts as $opt) {
								$opt=trim($opt);
								if($opt)
									$this->features->update_option($product->id, $option->feature_id, $opt);
							}
						}
					}
					
					// Новые характеристики
					$new_features_names = $this->request->post('new_features_names');
					$new_features_values = $this->request->post('new_features_values');
					if(is_array($new_features_names) && is_array($new_features_values))
					{
						foreach($new_features_names as $i=>$name)
						{
							$value = trim($new_features_values[$i]);
							if(!empty($name) && !empty($value))
							{
								$query = $this->db->placehold("SELECT * FROM __features WHERE name=? LIMIT 1", trim($name));
								$this->db->query($query);
								$feature_id = $this->db->result('id');
								if(empty($feature_id))
								{
									$feature_id = $this->features->add_feature(array('name'=>trim($name)));
								}
								$this->features->add_feature_category($feature_id, reset($product_categories)->id);
								$this->features->update_option($product->id, $feature_id, $value);
							}
						}
						// Свойства товара
						$options = $this->features->get_product_options($product->id);
					}
					
					// Связанные товары
	   	    		$query = $this->db->placehold('DELETE FROM __related_products WHERE product_id=?', $product->id);
	   	    		$this->db->query($query);
	 	  		    if(is_array($related_products))
		  		    {
		  		    	$pos = 0;
		  		    	foreach($related_products  as $i=>$related_product)
	   	    				$this->products->add_related_product($product->id, $related_product->related_id, $pos++);
	  	    		}
  	    		}
			}
			
			//header('Location: '.$this->request->url(array('message_success'=>'updated')));
		}
		else
		{
			$id = $this->request->get('id', 'integer');
			$product = $this->products->get_product(intval($id));

			if($product)
			{
				
				// Категории товара
				$product_categories = $this->categories->get_categories(array('product_id'=>$product->id));
				
				// Варианты товара
				$variants = $this->variants->get_variants(array('product_id'=>$product->id), 1);
				
				// Изображения товара
				$images = $this->products->get_images(array('product_id'=>$product->id));
				
				// Проверка загрузки всех изображений из интернета
				if(!empty($this->settings->check_download)){
					foreach($images as $url){
						if(!empty($url->filename) && (substr($url->filename,0,7) == 'http://' || substr($url->filename,0,8) == 'https://')){
							$new_name=$this->image->download_image($url->filename);
						}
					}
					$images = $this->products->get_images(array('product_id'=>$product->id));
				}	
				// Проверка загрузки всех изображений из интернета @
				
				// Файлы товара
				$files = $this->files->get_files(array('object_id'=>$product->id,'type'=>'product'));
				
				// Свойства товара
				$options = $this->features->get_options(array('product_id'=>$product->id));
				
				// Связанные товары
				$related_products = $this->products->get_related_products(array('product_id'=>$product->id));
			}
			else
			{
				// Сразу активен
				$product = new stdClass;
				$product->visible = 1;
				$product->to_yandex = 1;			
			}
		}
		
		if(empty($variants))
			$variants = array(1);
			
		if(empty($product_categories))
		{
			if($category_id = $this->request->get('category_id'))
				$product_categories[0]->id = $category_id;		
			else
				$product_categories = array(1);
		}
		if(empty($product->brand_id) && $brand_id=$this->request->get('brand_id'))
		{
			$product->brand_id = $brand_id;
		}
			
		if(!empty($related_products))
		{
			foreach($related_products as &$r_p)
				$r_products[$r_p->related_id] = &$r_p;

			//$temp_products = $this->products->get_products(array('id'=>array_keys($r_products)));
			$temp_products = $this->products->get_products(array('id'=>array_keys($r_products), 'limit' => count(array_keys($r_products))));
			foreach($temp_products as $temp_product)
				$r_products[$temp_product->id] = $temp_product;

			$related_products_images = $this->products->get_images(array('product_id'=>array_keys($r_products)));
			foreach($related_products_images as $image)
			{
				$r_products[$image->product_id]->images[] = $image;
			}

			$related_products_variants = $this->variants->get_variants(array('product_id'=>array_keys($r_products)), 1);
			foreach($related_products_variants as $r_variant)
			{
				$r_products[$r_variant->product_id]->variants[] = $r_variant;
			}
		}

		if(is_array($options))
		{
			$temp_options = array();
			foreach($options as $option){
				if(isset($temp_options[$option->feature_id]))
					$temp_options[$option->feature_id]->value .= $option_delimiter.$option->value; 
				else
					$temp_options[$option->feature_id] = $option;
			}
			$options = $temp_options;
		}
			
		$this->design->assign('product', $product);
		$this->design->assign('product_categories', $product_categories);
		$this->design->assign('product_variants', $variants);
		$this->design->assign('product_images', $images);
		$this->design->assign('options', $options);
		$this->design->assign('related_products', $related_products);
		if(!empty($files))
			$this->design->assign('cms_files', $files);
		
		// Все бренды
		$brands = $this->brands->get_brands();
		$this->design->assign('brands', $brands);
		
		// Все категории
		$categories = $this->categories->get_categories_tree();
		$this->design->assign('categories', $categories);
		

		// Все свойства
		$category = reset($product_categories);
		if(!is_object($category))
			$category = reset($categories);		
		if(is_object($category))
		{
			$features = $this->features->get_features(array('category_id'=>$category->id));
			$this->design->assign('features', $features);
		}

		//Multicurrency
		// Все валюты
		$this->design->assign('currencies', $this->money->get_currencies(array('enabled'=>1)));
		//Multicurrency end
	
 	  	return $this->design->fetch('product.tpl');
	}
}