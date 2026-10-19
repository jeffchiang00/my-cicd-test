<?PHP $rand = rand(100,999)?>
<tr>
    <td><input type="checkbox" name="item_publish[]" <?PHP echo @$item['publish']==1?"checked":""?>><input type="hidden" name="itemid[]" value="<?PHP echo @$item['id']?>"><i class="icon-move"></i></td>
    <td><input type="text" name="size[]" size="20" value="<?PHP echo @$item['size']?>"></td>
    <td><input type="text" class="num" name="qty[]" size="3" value="<?PHP echo @$item['qty']?>"></td>
    <td><input type="text" name="sku[]" value="<?PHP echo @$item['sku']?>"></td>
    <td class="coffee">
    	<?PHP $idx=0;?>
    	<?PHP foreach(@$item['coffee_taste'] as $key=>$value):?>
    	<?PHP echo $key;?>
    	<?PHP for($i=0;$i<5;$i++):?>
    	<input type="radio" class="opt0<?PHP echo $idx?>" name="opt0<?PHP echo $idx?>_<?PHP echo $rand?>[]" value="<?PHP echo $i?>" <?PHP echo ($i==$value)?'checked':''?>>
    	<?PHP endfor;?>
    	<br>
    	<?PHP $idx++;?>
    	<?PHP endforeach;?>
    </td>
    <td><a href="javascript:void(0)"><i class="icon-trash"></i>DELETE</a></td>
</tr>