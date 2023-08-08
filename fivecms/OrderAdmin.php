<?PHP

require_once('api/Fivecms.php');

class OrderAdmin extends Fivecms
{
	public function fetch()
	{
		$order = new stdClass;
		if($this->request->method('post'))
		{
			$order->id = $this->request->post('id', 'integer');
			$order->name = $this->request->post('name');
			$order->email = $this->request->post('email');
			$order->phone = $this->request->post('phone');
			$order->address = $this->request->post('address');
			if(!empty($this->request->post('shipping_date'))) 
				$order->shipping_date = date('Y-m-d H:i', strtotime($this->request->post('shipping_date')));
			if($this->request->post('calc')) $order->calc = $this->request->post('calc');
			$order->comment = $this->request->post('comment');
			$order->note = $this->request->post('note');
			$order->track = $this->request->post('track');
			$order->discount2 = $this->request->post('discount2', 'float');
			$order->discount_group = $this->request->post('discount_group', 'float');
			$order->discount = $this->request->post('discount', 'float');
			$order->bonus_discount = $this->request->post('bonus_discount', 'float');
			$order->coupon_discount = $this->request->post('coupon_discount', 'float');
			$order->delivery_id = $this->request->post('delivery_id', 'integer');
			$order->delivery_price = $this->request->post('delivery_price', 'float');
			$order->payment_method_id = $this->request->post('payment_method_id', 'integer');
			$order->paid = $this->request->post('paid', 'integer');
			$order->user_id = $this->request->post('user_id', 'integer');
			$order->separate_delivery = $this->request->post('separate_delivery', 'integer');
			$order->source = $this->request->post('source', 'integer');
				 
	 		if(!$order_labels = $this->request->post('order_labels'))
	 			$order_labels = array();			

			if(empty($order->id))
			{
  				$order->id = $this->orders->add_order($order);
				$this->design->assign('message_success', 'added');
  			}
    		else
    		{
    			if($order->paid == 1) {
					$this->orders->set_pay($order->id);
				} elseif($order->paid == 0){
					$this->orders->unset_pay($order->id);
				}
    			$this->orders->update_order($order->id, $order);
				$this->design->assign('message_success', 'updated');
    		}	

	    	$this->orders->update_order_labels($order->id, $order_labels);
			
			if($order->id)
			{
				// Покупки
				$purchases = array();
				if($this->request->post('purchases'))
				{
					foreach($this->request->post('purchases') as $n=>$va) foreach($va as $i=>$v)
						{
						if(empty($purchases[$i]))
							$purchases[$i] = new stdClass;
						$purchases[$i]->$n = $v;
						}
				}		
				$posted_purchases_ids = array();
				foreach($purchases as $purchase)
				{
					$variant = $this->variants->get_variant($purchase->variant_id);

					if(!empty($purchase->id))
						if(!empty($variant))
							$this->orders->update_purchase($purchase->id, array('variant_id'=>$purchase->variant_id, 'variant_name'=>$variant->name, 'sku'=>$variant->sku, 'price'=>$purchase->price, 'amount'=>$purchase->amount));
						else
							$this->orders->update_purchase($purchase->id, array('price'=>$purchase->price, 'amount'=>$purchase->amount));
					else
						$purchase->id = $this->orders->add_purchase(array('order_id'=>$order->id, 'variant_id'=>$purchase->variant_id, 'variant_name'=>$variant->name, 'price'=>$purchase->price, 'amount'=>$purchase->amount));
						
					$posted_purchases_ids[] = $purchase->id;			
				}
				
				// Удалить непереданные товары
				foreach($this->orders->get_purchases(array('order_id'=>$order->id)) as $p)
					if(!in_array($p->id, $posted_purchases_ids))
						$this->orders->delete_purchase($p->id);
					
				// Принять
				if($this->request->post('status_new'))
					$new_status = 0;
				elseif($this->request->post('status_new_two'))
					$new_status = 4;
				elseif($this->request->post('status_accept'))
					$new_status = 1;
				elseif($this->request->post('status_done'))
					$new_status = 2;
				elseif($this->request->post('status_deleted'))
					$new_status = 3;
				else
					$new_status = $this->request->post('status', 'string');

				if($this->request->post('return_bonus')) {
					if($order->user_id) {
						$user = $this->users->get_user(intval($order->user_id));
						if(!empty($user)) {
							$this->users->update_user($user->id, array('balance' => ($user->balance + $order->bonus_discount)));
							$this->orders->update_order($order->id, array('bonus_discount'=>0));
						}
					}  
				}
	
				if($new_status == 0)					
				{
					if(!$this->orders->open(intval($order->id)))
						$this->design->assign('message_error', 'error_open');
					else
						$this->orders->update_order($order->id, array('status'=>0));
				}
				elseif($new_status == 4)					
				{
					if(!$this->orders->open(intval($order->id)))
						$this->design->assign('message_error', 'error_open');
					else
						$this->orders->update_order($order->id, array('status'=>4));
				}
				elseif($new_status == 1)					
				{
					if(!$this->orders->close(intval($order->id)))
						$this->design->assign('message_error', 'error_closing');
					else
						$this->orders->update_order($order->id, array('status'=>1));
				}
				elseif($new_status == 2)					
				{
					if(!$this->orders->close(intval($order->id)))
						$this->design->assign('message_error', 'error_closing');
					else
						$this->orders->update_order($order->id, array('status'=>2));
				}
				elseif($new_status == 3)					
				{
					if(!$this->orders->open(intval($order->id)))
						$this->design->assign('message_error', 'error_open');
					else
						$this->orders->update_order($order->id, array('status'=>3));
					//header('Location: '.$this->request->get('return'));
				}
				$order = $this->orders->get_order($order->id);
				
				// функционал загрузки файлов
					$files 		= array();
					$files 		= (array)$this->request->post('files');

					// Удаление файлов
					$current_files = $this->files->get_files(array('object_id'=>$order->id,'type'=>'order'));
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
					$upload_max_filesize = $this->settings->maxattachment * 1024 * 1024;
					if($files = $this->request->files('files')){
						for($i=0; $i<count($files['name']); $i++)
						{
							if(isset($files['name']['size']) && $files['name']['size'] < $upload_max_filesize) {
								if ($file_name = $this->files->upload_file($files['tmp_name'][$i], $files['name'][$i])){
									$this->files->add_file($order->id, 'order', $file_name);
								}
								else {
									$this->design->assign('error', 'error uploading file');
								}
							}
						}
					}
				// функционал загрузки файлов end
				
				// Отправляем письмо пользователю
				if($this->request->post('notify_user'))
					$this->notify->email_order_user($order->id);
			}

		}
		else
		{
			$order->id = $this->request->get('id', 'integer');
			$order = $this->orders->get_order(intval($order->id));
			// Метки заказа
			$order_labels = array();
			if(isset($order->id))
			foreach($this->orders->get_order_labels($order->id) as $ol)
				$order_labels[] = $ol->id;			
		}

		$subtotal = 0;
		$purchases_count = 0;
		if($order && $purchases = $this->orders->get_purchases(array('order_id'=>$order->id)))
		{
			// Покупки
            $product_external_ids = [];
            $variant_external_id = [];

            foreach ($purchases as $purchase) {
                $product_external_ids[] = $purchase->product_external_id;
                $variant_external_id[] = $purchase->variant_external_id;
            }

            $products_temp = $this->products->get_products(['external_id' => $product_external_ids, 'limit' => count($product_external_ids)]);
            $products = [];
            foreach ($products_temp as $p) {
                $products[$p->external_id] = $p;
            }

            $images = $this->products->get_images(['product_external_id' => $product_external_ids]);
            foreach ($images as $image) {
                $products[$image->product_external_id]->images[] = $image;
            }

            $variants = [];
            foreach ($this->variants->get_variants(['external_id' => $variant_external_id]) as $v) {
                $variants[$v->external_id] = $v;
            }

            foreach ($variants as $variant) {
                if(empty($products[$variant->external_id])) continue;
                $products[$variant->external_id]->variants[] = $variant;
            }
			
			$total_weight = 0;
			$total_volume = 0;
			foreach($purchases as &$purchase)
			{
                if (!empty($products[$purchase->product_external_id]))
                    $purchase->product = $products[$purchase->product_external_id];
                if (!empty($variants[$purchase->variant_external_id]))
                    $purchase->variant = $variants[$purchase->variant_external_id];
				$subtotal += $purchase->price*$purchase->amount;
				$total_weight += $purchase->amount*$this->features->get_product_option_weight($purchase->product_id);
				$total_volume += $purchase->amount*$this->features->get_product_option_volume($purchase->product_id);
				$purchases_count += $purchase->amount;				
			}			

			if($this->request->get('view') == 'print'){
				function cmp($a1, $b1) 
				{
					$a=$a1->product_name;
					$b=$b1->product_name;
				    if ($a == $b) {
				        return 0;
				    }
				    return ($a < $b) ? -1 : 1;
				}
				usort($purchases, "cmp");
			}
			
		}
		else
		{
			$purchases = array();
		}

		// Если новый заказ и передали get параметры
		if(empty($order->id))
		{
			$order = new stdClass;
			if(empty($order->phone))
				$order->phone = $this->request->get('phone', 'string');
			if(empty($order->name))
				$order->name = $this->request->get('name', 'string');
			if(empty($order->address))
				$order->address = $this->request->get('address', 'string');
			if(empty($order->email))
				$order->email = $this->request->get('email', 'string');
		}

		$this->design->assign('purchases', $purchases);
		$this->design->assign('purchases_count', $purchases_count);
		$this->design->assign('total_weight', $total_weight);
		$this->design->assign('total_volume', $total_volume);
		$this->design->assign('subtotal', $subtotal);
		$this->design->assign('order', $order);

		if(!empty($order->id))
		{
			// Способ доставки
			$delivery = $this->delivery->get_delivery($order->delivery_id);
			$this->design->assign('delivery', $delivery);
	
			// Способ оплаты
			$payment_method = $this->payment->get_payment_method($order->payment_method_id);
			
			if(!empty($payment_method))
			{
				$this->design->assign('payment_method', $payment_method);
		
				// Валюта оплаты
				$payment_currency = $this->money->get_currency(intval($payment_method->currency_id));
				$this->design->assign('payment_currency', $payment_currency);
			}
			// Пользователь
			if($order->user_id)
				$this->design->assign('user', $this->users->get_user(intval($order->user_id)));
	
			// Соседние заказы
			$this->design->assign('next_order', $this->orders->get_next_order($order->id, $this->request->get('status', 'string')));
			$this->design->assign('prev_order', $this->orders->get_prev_order($order->id, $this->request->get('status', 'string')));
			
			// функционал загрузки файлов
			$files = $this->files->get_files(array('object_id'=>$order->id,'type'=>'order')); 	
			$this->design->assign('cms_files', $files);
			// функционал загрузки файлов end
			
		}

		// Все способы доставки
		$deliveries = $this->delivery->get_deliveries();
		$this->design->assign('deliveries', $deliveries);

		// Все способы оплаты
		$payment_methods = $this->payment->get_payment_methods();
		$this->design->assign('payment_methods', $payment_methods);

		// Метки заказов
	  	$labels = $this->orders->get_labels();
	 	$this->design->assign('labels', $labels);
	  	
	 	$this->design->assign('order_labels', $order_labels);	  	

		$this->design->assign('tabs_count', $this->orders->all_count_orders());		
		
		if($this->request->get('view') == 'print')
		{
 		  	return $this->design->fetch('order_print.tpl');
		}
		elseif($this->request->get('view') == 'excel') {
			/** Include PHPExcel */
			require_once 'classes/PHPExcel.php';
			$objReader = PHPExcel_IOFactory::createReader('Excel5');
			$objPHPExcel = $objReader->load("fivecms/design/xls/blank3.xls");
			//$objPHPExcel = $objReader->load("files/uploads/xls/blank3.xls");
			
			// Получаем дату из текстового значения
			//$order_date = strtotime($order->date); 
			$order_date = strtotime(date('d.m.Y')); 
			// Получаем полную дату для вставки в Ecxel 
			$excel_full_date = PHPExcel_Shared_Date::PHPToExcel( gmmktime(0,0,0,date('m',$order_date),date('d',$order_date),date('Y',$order_date)) );
			$total_price = ($order->separate_delivery ? $order->total_price+$order->delivery_price : $order->total_price);
			//$total_price = $this->money->convert($total_price, $payment_currency->id, false);
			
			/* ЛИСТ 1 - товарник */
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setCellValue('D7', $order->name)
										  ->setCellValue('L7', $order->phone)	
										  ->setCellValue('E8', str_replace("\r\n", '', $order->address))
										  ->setCellValue('D9', $order->comment)
										  ->setCellValue('G12', $order->id)
										  ->setCellValue('A2', $this->settings->company_name)
										  ->setCellValue('A4', $this->settings->rekvizites)
										  ->setCellValue('J12', $excel_full_date);
			$objPHPExcel->getActiveSheet()->getStyle('J12')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_FULLTEXT);
			$baseRow = 16; $all_count=0;
			// Покупки
			foreach ($purchases as $r => $p){
				$row = $baseRow + $r;
				
				if ($p->unit) {
					$exunits = $p->unit;
				} else {
					$exunits = $this->settings->units;
				}
				 
				$tovar = $p->product_name.' '.$p->variant_name.' '.($p->sku ? 'артикул '.$p->sku : '');
				$row_height = ceil(mb_strlen($tovar,'utf8')/55)*12.75;
				$objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1); 
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':B'.$row)
											  ->mergeCells('C'.$row.':G'.$row)
											  ->mergeCells('H'.$row.':I'.$row)
											  ->mergeCells('K'.$row.':N'.$row)
											  ->mergeCells('O'.$row.':T'.$row);
			//$objPHPExcel->getActiveSheet()->getStyle('C'.$row.':G'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $r+1)
											  ->setCellValue('C'.$row, $tovar)
											  //->setCellValue('H'.$row, $this->settings->units)
											  ->setCellValue('H'.$row, $exunits)
											  ->setCellValue('J'.$row, $p->amount)
											  /*->setCellValue('K'.$row, $p->price)*/
											  ->setCellValue('K'.$row, $this->money->convert($p->price, $payment_currency->id, false))
											  ->setCellValue('O'.$row, '=J'.$row.'*K'.$row);
				$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight($row_height);
				$all_count++;
			}
			$row++;
				// Рисуем строку с доставкой 
				$objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1); 
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':B'.$row)
											  ->mergeCells('C'.$row.':G'.$row)
											  ->mergeCells('H'.$row.':I'.$row)
											  ->mergeCells('K'.$row.':N'.$row)
											  ->mergeCells('O'.$row.':T'.$row);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $r+2)
											  ->setCellValue('C'.$row, $delivery->name)
											  ->setCellValue('J'.$row, 1)
											  ->setCellValue('K'.$row, $order->delivery_price)
											  ->setCellValue('O'.$row, '=J'.$row.'*K'.$row);
				$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(12.75);
				
			$objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);
				
			$order_sale = $subtotal - $total_price + $order->delivery_price;
			$order_sale = $this->money->convert($order_sale, $payment_currency->id, false);

			if ($subtotal > $total_price) {
				$objPHPExcel->getActiveSheet()->setCellValue('O'.$row, $order_sale);
			} elseif ($subtotal < $total_price) {
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$row, 'Комиссия:')
											  ->setCellValue('O'.$row, ($order_sale*(-1)));			
			} else {
				$objPHPExcel->getActiveSheet()->removeRow($row,1);
				$row--;
			}
			$objPHPExcel->getActiveSheet()->setCellValue('O'.($row+1), $total_price)
										  ->setCellValue('A'.($row+4), $this->orders->num2str($total_price))
										  ->setCellValue('B'.($row+3), 'Всего наименований '.($all_count+1).' на сумму:');											  

			/* ЛИСТ 2 - приходник */
			$objPHPExcel->setActiveSheetIndex(1);
			//list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($order->total_price))); // Получаем копейки и рубли отдельно
			list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($total_price))); 
			$objPHPExcel->getActiveSheet()->setCellValue('F14', $order->id)
										  ->setCellValue('G14', date('d.m.Y'))
										  ->setCellValue('G19', $total_price)
										  ->setCellValue('C24', $this->orders->num2str($total_price,true))
										  ->setCellValue('H26', ' '.$kop)
										  ->setCellValue('B8', $this->settings->company_name)
										  ->setCellValue('C21', $order->name);
										  
			// Вернемся на первый лист!
			$objPHPExcel->setActiveSheetIndex(0);
			
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Order_N'.$order->id.'.xls"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');	
			
		} 		
 	  	else
		{
	 	  	return $this->design->fetch('order.tpl');
		}

	}
}
