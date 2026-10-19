
<h2 class="content-subhead" id="stacked-form">會員管理</h2>
<div style="padding:10px 0;">
    <form id="search_frm" method="get">
    <!-- <a class="pure-button notice" href="<?PHP echo MODULE_URL?>/edit" title="新增">新增</a> -->
    EMAIL：<input name="search_key" value="<?PHP echo $search_key?>"> <a href="javascript:void(0)" class="search_btn">搜尋</a>
    </form>
</div>
<table class="pure-table pure-table-bordered" width="100%">
    <thead>
        <tr>
            <th>EMAIL</th>
            <th>姓</th>
            <th>名</th>
            <th>訂單數量</th>
            <th width="130"></th>
        </tr>
    </thead>
    <tbody class="ui-sortable">
        <?PHP foreach($rs as $row):?>
        <tr id="row_<?PHP echo $row['id']?>">
            <td><?PHP echo $row['email']?></td>
            <td><?PHP echo $row['last_name']?></td>
            <td><?PHP echo $row['first_name']?></td>
            <td><?PHP echo $row['orders']?></td>
            <td>
                <!-- <a class="pure-button" title="內容" href="<?PHP echo MODULE_URL?>/detail?id=<?PHP echo $row['id']?>"><i class="fa fa-file-text-o"></i></a> -->
                <a class="pure-button" title="訂單" href="<?PHP echo ADMIN_URL . 'module'?>/purchase?search_sdate=2014-12-01&search_edate=<?PHP echo date('Y-m-d')?>&search_key=<?PHP echo $row['email']?>&search_status="><i class="fa fa-shopping-cart"></i></a>
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