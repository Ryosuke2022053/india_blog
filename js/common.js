// スマホ用メニュー　クラス追加
		$(function(){
		$("#menubtn").on("click", function(){
			$(".ui-hamburger-05").toggleClass('is-active');
			$(".globalnav").slideToggle();
		});
	});

// スムーススクロール
      $(function(){
      var width =  $(window).width();
      $('a[href*="#"]').click(function() {
      var speed = 400;
      var href= $(this).attr("href");
      var target = $(href == "#" || href == "" ? 'php' : href);
      var position = target.offset().top;
      $('body,html').animate({scrollTop:position}, speed, 'swing');
      return false;
      });
      });

//スクロールしたらメニューボタンの表示
      $(function(){
        $(window).on('load scroll', function(){
          if ($(window).scrollTop() > 300) {
            $('#menubtn').css('background-color','#a2d7dd');
           } else {
            $('#menubtn').css('background-color','');
           }
         });
      });
