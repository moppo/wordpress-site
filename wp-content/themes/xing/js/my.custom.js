var $s = jQuery.noConflict();

$s(function() {

    var insSpanEl = $s('span.price>ins');
    var delSpanEl = $s('span.price>del');
    var insPEl = $s('p.price>ins');
    var delPEl = $s('p.price>del');

    if (params.isAdmin) {
        insSpanEl.empty(); //remove
        insPEl.empty(); //remove
        if (delSpanEl.parent().html()) delSpanEl.parent().html().replace('<del>', '<ins>'); //replace
        if (delPEl.parent().html()) delPEl.parent().html().replace('<del>', '<ins>'); //replace
    } else {
        delSpanEl.empty(); //remove
        delPEl.empty(); //remove
        if (insSpanEl.parent().html()) insSpanEl.parent().html().replace('<ins>', '<del>'); //replace
        if (insPEl.parent().html()) insPEl.parent().html().replace('<ins>', '<del>'); //replace
    }
    


    function checkCount() {
        var count = GetCookie('count');
        if (count == null) {
            count = 1;
            SetCookie('count', count, exp);

            $s(document).ready(function() {
              (function($s) {
                  //Căn giữa phần tử thuộc tính là absolute so với phần hiển thị của trình duyệt, chỉ dùng cho phần tử absolute đối với body
                  $s.fn.absoluteCenter = function() {
                      this.each(function() {
                          var top = -($s(this).outerHeight() / 2) + 'px';
                          var left = -($s(this).outerWidth() / 2) + 'px';
                          $s(this).css({
                              'position': 'absolute',
                              'position': 'fixed',
                              'margin-top': top,
                              'margin-left': left,
                              'top': '50%',
                              'left': '50%'
                          });
                          return this;
                      });
                  }
              })($s);

              //Đặt biến cho các đối tượng để gọi dễ dàng
              var bg = $s('div#popup-bg');
              var obj = $s('div#popup');
              
              var btnClose = obj.find('#popup-close');
              //Hiện các đối tượng
              bg.animate({
                  opacity: 0.2
              }, 0).fadeIn(1000); //cho nền trong suốt
              obj.fadeIn(1000).draggable({
                  cursor: 'move',
                  handle: '#popup-header'
              }).absoluteCenter(); //căn giữa popup và thêm draggable của jquery UI cho phần header của popup
              //Đóng popup khi nhấn nút
              btnClose.click(function() {
                  bg.fadeOut(1000);
                  obj.fadeOut(1000);
              });
              //Đóng popup khi nhấn background
              //bg.click(function() {
              //    btnClose.click(); //Kế thừa nút đóng ở trên
              //});
              //Đóng popup khi nhấn nút Esc trên bàn phím
              $s(document).keydown(function(e) {
                  if (e.keyCode == 27) {
                      btnClose.click(); //Kế thừa nút đóng ở trên
                  }
              });
            });


        } else {
            count++;
            SetCookie('count', count, exp);
        }
    }

    function GetCookie(name) {
        var arg = name + "=";
        var alen = arg.length;
        var clen = document.cookie.length;
        var i = 0;
        while (i < clen) {
            var j = i + alen;
            if (document.cookie.substring(i, j) == arg) return getCookieVal(j);
            i = document.cookie.indexOf(" ", i) + 1;
            if (i == 0) break;
        }
        return null;
    }

    function DeleteCookie(name) {
        var exp = new Date();
        exp.setTime(exp.getTime() - 1);
        var cval = GetCookie(name);
        document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString();
    }

    function getCookieVal(offset) {
        var endstr = document.cookie.indexOf(";", offset);
        if (endstr == -1) endstr = document.cookie.length;
        return unescape(document.cookie.substring(offset, endstr));
    }

    function SetCookie(name, value) {
        var argv = SetCookie.arguments;
        var argc = SetCookie.arguments.length;
        var expires = (argc > 2) ? argv[2] : null;
        var path = (argc > 3) ? argv[3] : null;
        var domain = (argc > 4) ? argv[4] : null;
        var secure = (argc > 5) ? argv[5] : false;
        document.cookie = name + "=" + escape(value) + ((expires == null) ? "" : ("; expires=" + expires.toGMTString())) + ((path == null) ? "" : ("; path=" + path)) + ((domain == null) ? "" : ("; domain=" + domain)) + ((secure == true) ? "; secure" : "");
    }

    // Start up popup
    if (params.isHomePage) {

        var expDays = 0.25;
        var exp = new Date();
        exp.setTime(exp.getTime() + (expDays  * 60 * 60 * 1000));

        //checkCount();
    }
}); // END DOCUMENT.READY