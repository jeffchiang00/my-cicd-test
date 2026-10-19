<section class="bg_gray text-center pt150">
    <h2>常見問答</h2>
    <div class="container faq text-center">
        <a class="btn btn-pink">購買須知</a>
        <a class="btn btn-green">退換貨</a>
        <a class="btn btn-purple">運費計算</a>

        <div class="col-md-12 faq_frame">
                <?PHP 
                    
                    foreach($rs as $row):
                        
                        $template_content = json_decode(urldecode($row['template_content']));
                        $arr_faq = array();
                        $title = $row['title_tw'];
                        $id = $row['id'];
                        $arr_faq = $template_content[1];
                        $idx = 1;
                ?>
            <div class="col-md-12 faq_content<?php echo $id;?> text-left">
                
                <?PHP foreach($arr_faq as $item):
                $sn = substr('00' . $idx,-2);?>
                <p class="faq_question">Q<?PHP echo $sn?>. <?PHP echo $item->input[0];?></p>
                <p class="faq_ans margin0"><?PHP echo $item->text[0]?></p>
                <?PHP $idx++; endforeach;?>
            </div>
            <?PHP 
            endforeach;
            ?>
            <div class="col-md-12 text-left">
                <p class="mt70">*找不到您的問題嗎？請直接<a href="http://gapure.com/dolly/tw?x=contact" style="cursor:pointer;text-decoration:underline;">連絡我們</a></p>
            </div>
        </div>
    </div>






</section>