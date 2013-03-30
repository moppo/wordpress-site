<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style>
            * { margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; } a#show-popup
            { margin:20px 0 0 20px; float:left; text-decoration:none; } div#popup-bg
            { position:absolute; top:0; bottom:0; left:0; right:0; z-index:99; background:#000;
            display:none; } div#popup { width:680px; height:480px; border:solid 1px
            #d5d5d5; z-index:999; display:none; background:#FFF; } div#popup-header
            { position:relative; float:left; width:680px; line-height:30px; font-size:20px;
             cursor:move; } span#popup-close { cursor:pointer;
            color:#000; font-size:12px; position:absolute; top:-2px; right:10px; z-index:9999;
            } div#popup-content { width:670px; float:left; padding:5px; }
        </style>
        <script language="javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js">
                
        </script>
        <script language="javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js">
                
        </script>
        <script language="javascript">
                $(document).ready(function() {
            (function($) {
                //Căn giữa phần tử thuộc tính là absolute so với phần hiển thị của trình duyệt, chỉ dùng cho phần tử absolute đối với body
                $.fn.absoluteCenter = function() {
                    this.each(function() {
                        var top = -($(this).outerHeight() / 2) + 'px';
                        var left = -($(this).outerWidth() / 2) + 'px';
                        $(this).css({
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
            })(jQuery);

            //Đặt biến cho các đối tượng để gọi dễ dàng
            var bg = $('div#popup-bg');
            var obj = $('div#popup');
            var btnClose = obj.find('#popup-close');
            //Hiện các đối tượng
            bg.animate({
                opacity: 0.2
            }, 0).fadeIn(1000); //cho nền trong suốt
            obj.fadeIn(1000).draggable({
                cursor: 'move',
                handle: '#popup-header'
            });
            //.absoluteCenter(); //căn giữa popup và thêm draggable của jquery UI cho phần header của popup
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
            $(document).keydown(function(e) {
                if (e.keyCode == 27) {
                    btnClose.click(); //Kế thừa nút đóng ở trên
                }
            });
        });
        </script>
        <title>
            Untitled Document
        </title>
    </head>
    
    <body>
        <div id="popup-bg">
        </div>
        <div id="popup">
            <div id="popup-header">
                <span id="popup-close" title="Close">
                    X
                </span>
            </div>
            <div id="popup-content">
                Content
                <img style="width:650px" src="/samsung_lap.jpeg">
            </div>
        </div>
    </body>

</html>