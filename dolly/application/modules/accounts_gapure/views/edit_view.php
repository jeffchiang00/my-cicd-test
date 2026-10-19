
<h2 class="content-subhead" id="stacked-form">帳號管理 - <span id="ContentPlaceHolder1_lbl_title">編輯</span></h2>
<form id="frm" class="pure-form pure-form-stacked">
    <div style="">
        <div style="display: inline-block;">
            <button type="submit" class="pure-button notice">儲存</button>
        </div>
        <div style="display: inline-block;">
            <a href="<?PHP echo MODULE_URL?>" class="pure-button">回上頁</a>
        </div>
    </div>
    <hr>
    <input type="hidden" name="id" value="<?PHP echo (isset($row["id"]))?$row["id"]:"0" ?>">
    <label>狀態</label>
    <input type="radio" name="publish" value="1" <?PHP echo (@$row["publish"]=="1")?"checked":"" ?>>啟用
    <input type="radio" name="publish" value="0"  <?PHP echo (@$row["publish"]=="0"||!isset($row["publish"]))?"checked":"" ?>>停用

    <label>帳號</label>
    <input type="text" id="userid" name="userid" value="<?PHP echo @$row["username"]?>" <?PHP echo (isset($row["username"]))?"readonly":"" ?>>
    
    <label>新密碼</label>
    <input type="password" id="userpwd" name="userpwd" placeholder="">
    <label>密碼確認</label>
    <input type="password" id="userpwd2" name="userpwd2" placeholder="">
</form>
<script>
$(function () {
    $('#frm').ajaxForm({
        beforeSubmit: function () {
            if($("input[name=userpwd]").val()!=""||$("input[name=userpwd2]").val()!=""){
                if($("input[name=userpwd]").val()!=$("input[name=userpwd2]").val()){
                    alert("密碼不相同!");
                    return false;
                }
            }
        },
        url: 'save',
        type: 'post',
        dataType: 'script'
    });
})
</script>