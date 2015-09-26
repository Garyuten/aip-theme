
// window resize
// ------------------------------------------------

// （スマホ用）画面の向き

var ORIENTATION_LANDSCAPE = 1;
var ORIENTATION_PORTRAIT  = 2;

var orientation = Math.abs(window.orientation) === 90
      ? ORIENTATION_LANDSCAPE : ORIENTATION_PORTRAIT;

if ("onorientationchange" in window) {
  // スマホ・タブレットの場合は、向きが変わった時に
  var _orientation_event;
    if ( navigator.userAgent.indexOf('iPhone') > 0
      || navigator.userAgent.indexOf('iPad') > 0
      || navigator.userAgent.indexOf('iPod') > 0) {
    // iOSの場合は onorientationchange イベントを使う
    _orientation_event = 'orientationchange';
    } else {
    // Androidの場合は resize イベントを使う
    _orientation_event = 'resize';
    }
  $(window).bind(_orientation_event,function(){
      if (Math.abs(window.orientation) === 90) {
    if (orientation!==ORIENTATION_LANDSCAPE){
        // 縦→横になった
        orientation = ORIENTATION_LANDSCAPE;
        resizeEvent();
    }
      }else{
    if (orientation!==ORIENTATION_PORTRAIT){
        // 横→縦になった
        orientation = ORIENTATION_PORTRAIT;
        resizeEvent();
    }
      }
  });
} else {
  // PCの場合はウィンドウのリサイズ時に
  $(window).resize(function(){
    resizeEvent();
  });
}


var w = $(window).width();
var small = 480;

function resizeEvent() {
  w = $(window).width();

  if (w <= small) { // small以下

  } else {
    //アコーディオンのbodyを全て開く
    $(".accordion").removeClass("active").find(".body").show();
  }
}


// onload
// --------------------------------------------------------------
(function($){
  $(function(){

    // sidebar
    $( '#sidebar' ).simpleSidebar({
        settings: {
            opener: ".button-menu",
            wrapper: ".body-wrapper",
        },
        sidebar: {
            align: "left",
            width: 188,
            closingLinks: "a",
            style: {
                zIndex: 100
            }
        },
        mask: {
            style: {
                backgroundColor: "grey",
                opacity: 0.9,
                filter: 'Alpha(opacity=90)'
            }
        }
    });

    // accordion
    if( $(".accordion").length ){
      $(".accordion").each( function() {
        $(this).find('.title').on('click', function(e) {
          if (w <= small) { // small以下
            // console.log( $(this).parent().find(".body").html());
            $(this).parent().toggleClass("active");
            $(this).parent().find(".body").slideToggle();
          }
        });
      });
    }

    //リンクへのclass設定 (外部リンク、ファイルへのリンク
    var Location = location.href;
    var myDomain = location.host;

    if( $("a").length ){
        $("body").find("a").each( function() {

          //サイト外リンクにclass'LinkBlank'設定
          //外部リンクか判別
          if( myDomain.indexOf(this.hostname) == -1 &&
              this.hostname != "" )
              {
              //画像を含んでいない場合(テキストのみの場合）
              //if( $(this).find("img").length == 0) {
              if( $(this).find("img").length == 0) {
                  //違うサイトへのリンクの処理
                  $(this).addClass("link-external");  //Class名追加
              }
              $(this).attr("target","_blank");  //target = "_blank"
          }
      });
    }

    //ファイル拡張子別にclass設定
    $("a[href$='.xls'], a[href$='.xlsx']").addClass("link-xls");
    $("a[href$='.doc'], a[href$='.docx']").addClass("link-doc");
    $("a[href$='.pdf']:not(:has(img))").addClass("link-pdf").attr("target","_blank");

    // ページ内スクロール
    //ヘッダーの高さ
    var gNav1 = $("#g-nav");
    var gNav2 = $("#g-nav .site-nav");
    $('a[href^=#]').on('click', function(e) {
      var headerHight = gNav1.outerHeight() + gNav2.outerHeight() +10;
      var href= $(this).attr("href");
      var target = $(href == "#" || href == "" ? 'html' : href);
      var position = target.offset().top-headerHight;
      $("html, body").animate({scrollTop:position}, 550, "swing");
      return false;
    });

    // 他ページからページ内リンクで飛んでてきた場合のスクロール処理 (onload時にURLに"#"があるかで判断)
    var url = $(location).attr('href');
    var headerHight = gNav1.outerHeight() + gNav2.outerHeight() +10;
    if (url.indexOf("#") == -1) {
        // スムーズスクロール以外の処理（必要なら）
    }else{
        // スムーズスクロールの処理
        var url_sp = url.split("#");
        var hash   = '#' + url_sp[url_sp.length - 1];
        var tgt    = $(hash);
        var position    = tgt.offset().top - headerHight;
        $("html, body").animate({scrollTop:position}, 550, "swing");
    }



  });
})(jQuery);

//==========================

// スクロールしてナビを固定
var gNav    = $('#g-nav');
var siteNav    = $('#g-nav .site-nav');
var body = $('body');
// var contentsElm= $('#contents');

offset = gNav.offset();
fixedTop = offset.top - parseFloat(siteNav.height());
// contentsPTop = parseFloat(contentsElm.css("padding-top"));

$(window).scroll(function () {
  // console.log( $(window).scrollTop() +":"+ fixedTop );
  if($(window).scrollTop() > fixedTop ) {
    gNav.addClass('navFixed');
    body.addClass('onFixed');
    // contentsElm.css("padding-top" ,contentsPTop + parseFloat(gNav.height()) + "px");
  } else {
    gNav.removeClass('navFixed');
    body.removeClass('onFixed');
    // contentsElm.css("padding-top" ,contentsPTop + "px" );
  }


  if ($(this).scrollTop() > 150) {
    $(".pagetop").fadeIn();
  } else {
    $(".pagetop").fadeOut();
  }

  // page Topフェードイン・アウト
  // ドキュメントの高さ
  scrollHeight = $(document).height();
  // ウィンドウの高さ+スクロールした高さ→ 現在のトップからの位置
  scrollPosition = $(window).height() + $(window).scrollTop();
  // フッターの高さ
  footHeight = $("#g-footer").height();

  // スクロール位置がフッターまで来たら
  // if ( scrollHeight - scrollPosition  <= footHeight ) {
  //   // ページトップリンクをフッターに固定
  //   $(".pagetop a").css({"position":"absolute"});
  // } else {
  //   // ページトップリンクを右下に固定
  //   $(".pagetop a").css({"position":"fixed"});
  // }

});
