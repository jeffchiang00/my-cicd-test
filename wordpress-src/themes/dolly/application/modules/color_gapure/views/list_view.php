
<h2 class="content-subhead" id="stacked-form">商品分類 <?PHP echo @$type_title;?></h2>
<div class="right">
    <a class="pure-button notice" href="<?PHP echo MODULE_URL?>/edit" title="新增">新增</a>
</div>
<table class="pure-table pure-table-bordered" width="100%">
    <thead>
        <tr>
            <th width="7%">發佈</th>
            <th>英文標題</th>
            <th>繁中標題</th>
            <th>簡中標題</th>
            <th width="130"></th>
        </tr>
    </thead>
    <tbody class="ui-sortable">
        <?PHP foreach($rs as $row):?>
        <tr id="row_<?PHP echo $row['id']?>">
            <td>
                <div>
                    <input type="checkbox" class="publish" value="<?PHP echo $row['id']?>" onclick="publish($(this))" <?PHP echo ($row["publish"]=="1")?"checked":"" ?>>
                </div>
            </td>
            <td><?PHP echo $row['title_en']?></td>
            <td><?PHP echo $row['title_tw']?></td>
            <td><?PHP echo $row['title_cn']?></td>
            <td>
                <a class="pure-button" title="編輯" href="<?PHP echo MODULE_URL?>/edit?id=<?PHP echo $row['id']?>"><i class="icon-pencil"></i></a>
                <a class="pure-button" title="刪除" onclick="del('<?PHP echo $row['id']?>')"><i class="icon-trash"></i></a>
            </td>
        </tr>
        <?PHP endforeach;?>

    </tbody>
</table>
<script>
$(function () {
    $('.icon-move').css('visibility', 'hidden');
    $('td div').hover(
        function () {
            $(this).find('.icon-move').css('visibility', 'visible');
        },
        function () {
            $(this).find('.icon-move').css('visibility', 'hidden');
        }
        );
    $('tbody').sortable({
        handle: ".icon-move",
        placeholder: "sortable-placeholder",
        start: function (event, ui) {
            $('.sortable-placeholder').append('<td colspan="20">&nbsp;</td>')
        },
        stop: function (event, ui) {
            var q = 'act=sort';
            $('.icon-move').each(function (index, element) {
                q += '&id[]=' + $(this).attr('value');
            });
            $.post('<?PHP echo MODULE_URL?>/sort', q)
        }
    });
})
function publish(obj) {
    var q = "id=" + obj.attr('value');
    if (obj.prop("checked")) {
        q += "&publish=1"
    }
    else {
        q += "&publish=0"
    }
    $.post('<?PHP echo MODULE_URL?>/publish', q, null, 'script');
}

function del(id) {
    if (!confirm('Delete?')) return;
    $.post('<?PHP echo MODULE_URL?>/del', 'id=' + id, null, 'script');
}

</script>