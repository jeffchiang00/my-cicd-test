$(function () {
    var _block = $('.prodImgAllBigImg');
    var _ul = _block.find('ul');
    var _index = 0;
    var _resizebool = false;
    var _reW;
    var to = false;
    var _resize = function () {
        $('.prodImgAllBigImg').height($('.prodImgAllBigImg').width());
        $('.prodImgAllBigImg li').width($('.prodImgAllBigImg').width());
        _reW = $('.prodImgAllBigImg').width();
        _ul.css('left', -_reW * _index);
    }


    $('.prodImgAllBigImg').height($('.prodImgAllBigImg').width());
    $('.prodImgAllBigImg li').width($('.prodImgAllBigImg').width());
    _reW = $('.prodImgAllBigImg').width();
    $(window).resize(function () {
        //if (_resizebool)
        //    clearTimeout(_resizebool);
        //_resizebool = setTimeout(function () {
            _resize();
        //}, 500);
    });
    $('.prodImgAll > ul').find('li a').each(function (i) {
        $(this).click(function () {
            _index = i;
            _ul.find('li').eq(i).addClass('active').siblings().removeClass('active');
            TweenLite.to(_ul, 1, { css: { left: -i * _reW }, ease: Quint.easeOut });
            return false;
        });
    });
    _block.mousedown(function () {
        return false;
    });

    _block.swiperight(function () {
        if(_reW == 450) {
            return false;
        }
        else {
            $('.prodImgAll > ul').find('li a').eq(_index - 1).click();
        }
    });

    _block.swipeleft(function () {
        if(_reW == 450) {
            return false;
        }
        if (to)
            $('.prodImgAll > ul').find('li a').eq(0).click();
        else
        $('.prodImgAll > ul').find('li a').eq(_index + 1).click();
        (_index == ($('.prodImgAll > ul').find('li a').length - 1)) ? to = true : to = false;
    });
});