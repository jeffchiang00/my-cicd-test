
<h2 class="content-subhead" id="stacked-form">訂單管理</h2>
<div style="padding:10px 0;">
    <form id="search_frm" method="get">
    <!-- <a class="pure-button notice" href="<?PHP echo MODULE_URL?>/edit" title="新增">新增</a> -->
    日期範圍：<input name="search_sdate" class="date" value="<?PHP echo $search_sdate?>"> ~ <input class="date" name="search_edate" value="<?PHP echo $search_edate?>"><br><br>
    關鍵字：<input name="search_key" value="<?PHP echo $search_key?>">(訂單編號、EMAIL)<br><br>
    付款狀態：<select name="search_status">
        <option value="">全部狀態</option>
        <?PHP foreach($pay_status as $status):?>
        <option value="<?PHP echo $status['id']?>" <?PHP echo $status['id']==$search_status?'selected':''?>><?PHP echo $status['name2']?></option>
        <?PHP endforeach;?>
    </select> <a href="javascript:void(0)" class="search_btn">搜尋</a>
    </form>
</div>
<table class="pure-table pure-table-bordered" width="100%">
    <thead>
        <tr>
            <th>訂單編號</th>
            <th>訂單狀態</th>
            <th>使用者</th>
            <th>金額</th>
            <th>數量</th>
            <th width="130"></th>
        </tr>
    </thead>
    <tbody class="ui-sortable">
        <?PHP foreach($rs as $row):?>
        <tr id="row_<?PHP echo $row['id']?>">
            <td><?PHP echo $row['member_order_id']?></td>
            <td><?PHP echo $row['name2']?></td>
            <td><?PHP echo $row['email']?></td>
            <td><?PHP echo $row['total_amount']?></td>
            <td><?PHP echo $row['items']?></td>
            <td>
                <a class="pure-button" title="編輯" href="<?PHP echo MODULE_URL?>/detail?id=<?PHP echo $row['purchase_id']?>"><i class="fa fa-file-text-o"></i></a>
            </td>
        </tr>
        <?PHP endforeach;?>

    </tbody>
</table>
<script>
$(function () {
    $('a.search_btn').on('click',function(){
        $('#search_frm')[0].submit();
    })

    $('.date').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat:"yy-mm-dd"
    });
})

</script>