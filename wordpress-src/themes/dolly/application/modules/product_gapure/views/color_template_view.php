            <input type="hidden" name="color" value="<?PHP echo $color_id?>">
            <label>商品照 (450 x 450)</label>
            <div class="gallery">
                <?PHP foreach($gallery as $img):?>
                    <div class="myGalleryUpload_item" style="float:left">
                        <input type="hidden" name="gallery[]" value="<?PHP echo $img['filename']?>"><br>
                        <img src="<?PHP echo IMG_URL.$img['filename']?>" style="border:1px solid #cccccc; max-width:140px"><br>
                        <a href="javascript:void(0)"><i class="icon-trash"></i>DELETE</a><br><br>
                    </div>
                <?PHP endforeach;?>
            </div>
            <div style="clear:both"></div>
            <label>尺寸數量</label>
            <div class="product_size">
                <table class="pure-table pure-table-bordered">
                    <thead>
                        <tr>
                            <th>發佈</th>
                            <th>尺寸</th>
                            <th>數量</th>
                            <th>貨號</th>
                            <th class="coffee">口味</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?PHP foreach($product_item as $item):?>
                        <?PHP echo $item['html'];?>
                        <?PHP endforeach;?>
                    </tbody>
                </table>
                <a href="javascript:void(0)" class="add_product_item"><i class="icon-plus"></i>新增尺寸</a>
            </div>