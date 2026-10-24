
<h2 class="content-subhead" id="stacked-form">訂單管理 - <span id="ContentPlaceHolder1_lbl_title"><?PHP echo $row['member_order_id']?></span></h2>
<form id="frm" class="pure-form pure-form-stacked">
    <div style="">
        <div style="display: inline-block;">
            <button type="submit" class="pure-button notice">儲存</button>
        </div>
        <div style="display: inline-block;">
            <a href="javascript:history.back()" class="pure-button">回上頁</a>
        </div>
    </div>
    <hr>
    <input type="hidden" name="id" value="<?PHP echo (isset($row["purchase_id"]))?$row["purchase_id"]:"0" ?>">
    <table class="pure-table pure-table-bordered" width="100%">
        <tr>
            <td>訂單編號</td>
            <td><?PHP echo $row['member_order_id']?></td>
            <td>訂單狀態</td>
            <td>
                <select name="paystatus">
                    <?PHP foreach($pay_status as $status):?>
                    <option value="<?PHP echo $status['id']?>" <?PHP echo $status['id']==$row['paystatus']?'selected':''?>><?PHP echo $status['name2']?></option>
                    <?PHP endforeach;?>
                </select>
            </td>
        </tr>
        <tr>
            <td>訂購人</td>
            <td><?PHP echo $row['first_name'] . ' ' . $row['last_name']?></td>
            <td>EMAIL</td>
            <td><?PHP echo $row['email']?></td>
        </tr>
        <tr>
            <td>訂購日期</td>
            <td><?PHP echo $row['createtime']?></td>
            <td>總金額</td>
            <td><?PHP echo $row['total_amount']?></td>
        </tr>
        <tr>
            <td>收件人手機</td>
            <td><?PHP echo $purchase_form->shipping_mobile?></td>
            <td>收件人市話</td>
            <td><?PHP echo $purchase_form->shipping_tel?></td>
        </tr>
        <tr>
            <td>收件人地址</td>
            <td colspan="3">
                <?PHP 
                    echo 
                    $purchase_form->shipping_zipcode . 
                    $purchase_form->shipping_country . 
                    $purchase_form->shipping_province . 
                    $purchase_form->shipping_city . 
                    $purchase_form->shipping_area . 
                    $purchase_form->shipping_address;
                ?>
            </td>
        </tr>
        <tr>
            <td>訂購人手機</td>
            <td><?PHP echo $purchase_form->billing_mobile?></td>
            <td>訂購人市話</td>
            <td><?PHP echo $purchase_form->billing_tel?></td>
        </tr>
        <tr>
            <td>訂購人地址</td>
            <td colspan="3">
                <?PHP 
                    echo 
                    $purchase_form->billing_zipcode . 
                    $purchase_form->billing_country . 
                    $purchase_form->billing_province . 
                    $purchase_form->billing_city . 
                    $purchase_form->billing_area . 
                    $purchase_form->billing_address;
                ?>
            </td>
        </tr>
        <tr>
            <td>發票號碼</td>
            <td><input type="text" name="invoice" value="<?PHP echo $row['invoice']?>"></td>
            <td>貨運號碼</td>
            <td><input type="text" name="track" value="<?PHP echo $row['track']?>"></td>
        </tr>
        <tr>
            <td>備註</td>
            <td colspan="3"><textarea name="note" rows="3" style="width:100%;"><?PHP echo $row['note']?></textarea></td>
        </tr>
    </table>
    <br>
    <table class="pure-table pure-table-bordered">
        <tr>
            <th>照片</th>
            <th>品名</th>
            <th>數量</th>
            <th>單價</th>
        </tr>
        <?PHP foreach($order_detail['detail'] as $item):?>
        <tr>
            <td><img src="<?PHP echo IMG_URL . $item['filename']?>" width="100" height="100"></td>
            <td>
                <?PHP echo $item['title']?><br>
                COLOR:<?PHP echo $item['color_title']?><br>
                SIZE:<?PHP echo $item['size']?>
            </td>
            <td class="t_align_right"><?PHP echo $item['qty'];?></td>
            <td class="t_align_right"><?PHP echo number_format($item['product_price'])?></td>
        </tr>
        <?PHP endforeach;?>
        <tr>
            <td colspan="3" class="t_align_right">小計</td>
            <td class="t_align_right"><?PHP echo number_format($order_detail['master']['total_amount'] - $order_detail['master']['shipping'])?></td>
        </tr>
        <tr>
            <td colspan="3" class="t_align_right">運費</td>
            <td class="t_align_right"><?PHP echo number_format($order_detail['master']['shipping'])?></td>
        </tr>
        <tr>
            <td colspan="3" class="t_align_right">總金額</td>
            <td class="t_align_right"><?PHP echo number_format($order_detail['master']['total_amount'])?></td>
        </tr>
    </table>
    <br>
</form>
<style>
    .t_align_right{text-align: right;}
</style>
<script>
$(function () {
    $('#frm').ajaxForm({
        beforeSubmit: function () {
        },
        url: 'save',
        type: 'post',
        dataType: 'script'
    });
})
</script>