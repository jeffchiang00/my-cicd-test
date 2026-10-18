



<!--
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
    $.post('<?PHP echo ADMIN_URL?>/del', 'id=' + id, null, 'script');
}

</script>-->