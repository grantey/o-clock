     <td width="18%" valign="top" align="center">
        <?php
		  $count=0;
		  $price=0;
          if  (isset($_SESSION['korzina'])){
	      foreach ($_SESSION['korzina'] as $value) {
		    $rs= mysql_query ("select price as price from clocks where id='$value'"); // count(id) as count, 
 		    $row=mysql_fetch_array($rs);
			$count=$count + 1;//$row['count'];
			$price=$price + $row['price'];
	        }
          }
        ?>
      <form class="korzina">
      <font size="+2" color="#300000" style="text-align:center;"><strong>Корзина</strong></font>
      <p align="left"><strong>Товаров:</strong>&nbsp;<?php echo $count;?>&nbsp;<strong>Шт.</strong><br>
      <strong>Сумма:</strong>&nbsp;<?php echo $price;?>&nbsp;<strong>Руб.</strong></p>
      <a href="order.php" class="li2">Оформить заказ</a>&nbsp; &nbsp;<a href="korzina.php" class="li2">Просмотр</a>
      </form>

      <form action="search.php" method="post" class="find">
      <label> <font size="+1" color="#300000" style="text-align:center;"><strong>Поиск по названию</strong></font></label>
      <br>&nbsp;<br>
      <input name="filter2" type="text" size="20" maxlength="50" value="<?php echo "$filter2";?>"><br><br>
      <input name="search" type="submit" value="Поиск" class="button">
      </form>

      <form action="bigsearch.php" method="post" class="korzina">
      <font size="+1" color="#300000" style="text-align:center;"><strong>Расширеный поиск</strong></font>
      <p><label style="text-align:center;">Пол:</label><br>
      <label>Мужские</label><input name='sex' type='checkbox' value="ужские">
      <label>Женские</label><input name='sex' type='checkbox' value="енские"></p>
      
      <p><label>Марка:</label><br>
      <select name="label">
        <?php
           $rs = mysql_query( "select categories.id, categories.name as name, labels.id as lab from categories LEFT JOIN labels ON categories.id=labels.category group by categories.id");
              while ($row = mysql_fetch_array($rs,MYSQL_ASSOC)) {
              $c_name=$row["name"];
			  $id=$row["id"];
              echo "<optgroup label = $c_name>";
			  $rs2 = mysql_query( "select id, label from labels where category=$id order by label");  
              while ($row2 = mysql_fetch_array($rs2,MYSQL_ASSOC)) {
              $label=$row2["label"];
              $id2=$row2["id"];
			  $selected = "";
			  if ($id2==$label_add) $selected="selected";
              echo "<option value='$id2' $selected>$label</option>";
              } 
			  echo "</optgroup>";
              }
        ?>
      </select></p>
       
      <p><label>Тип браслета:</label><br>         
      <select name="handover">
      <option value=""><Не выбрано></option>
      <option value="браслет">Браслет</option>
      <option value="ремешок">Ремешок</option>
      </select></p>

      <p><label>Механизм:</label><br>
      <select name="mechanism">
      <option value=""><Не выбрано></option>
      <option value="варцевы">Кварцевый</option>
      <option value="еханически">Механические</option>
      </select></p>
          
      <p><label>Материал корпуса:</label><br>
      <select name="body">
      <option value=""><Не выбрано></option>
      <option value="сталь">Нерж. сталь</option>
      <option value="олото">Золото</option>
      <option value="ерами">Керамика</option>
      </select></p>
          
      <p><label>Материал стекла:</label><br>
      <select name="glass">
      <option value=""><Не выбрано></option>
      <option value="инеральное">Минеральное</option>
      <option value="езалитовое">Хезалитовое</option>
      <option value="апфировое">Сапфировое</option>
      <option value="ластиковое">Пластиковое</option>
      </select></p>
      
      <p><label>Цена:</label><br> 
      <p><label>От:&nbsp;</label><input name="minprice" size="10" type="text" value="<?php echo "$min"; ?>"><label>&nbsp;(Руб.)</label></p>
      <p><label>До:&nbsp;</label><input name="maxprice" size="10" type="text" value="<?php echo "$max"; ?>"><label>&nbsp;(Руб.)</label> </p>
      
      <input name="bigsearch" type="submit" value="Подобрать модель" class="button">        
      </form><br>
    
     
     
     
        </td>
        