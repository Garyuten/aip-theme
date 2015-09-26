// materialize IE9以上のみ
// ------------------------------------------------
if(!_ua.lte_IE8){
  document.write('<script src="<?php echo $this->BcBaser->getThemeUrl() ?>js/materialize.min.js"></script>');
  // alert("IE8");
}


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
var small = 600;
var medium = 992;
var large = 1200;

function resizeEvent() {
  w = $(window).width();
  // 高さ揃え
  flatHeightsGroup();

  if (w <= small) { // small以下

  } else if (w <= medium) { // medium以下

  } else {

  }

  //アコーディオンコンテンツの初期化
  resetContentsAccordion($(".contents-accordion > section"));
  //アコーディオンコンテンツ（ブログ版）の初期化
  $(".contents-accordion-posts > section").each( function() {
    if (w > small) { // small以上
      $(this).removeClass("open");
      $(this).find(".body").show();
    } else {
      $(this).find(".body").hide();
    }
  });
}



// onload
(function($){
  $(function(){

    resizeEvent();

    //画像のサムネイルの縦横比揃え
    $(".post-items .eyecatchImage > span").imgLiquid();


    // jquery.simplesidebar.min.js
    // sidebar
    $( '#sidebar' ).simpleSidebar({
      settings: {
        opener: "#toolbar-sp-bars",
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
          backgroundColor: "black",
          opacity: 0.5,
          filter: 'Alpha(opacity=50)'
        }
      }
    });

    // color box
    var colorboxObj = {
      transition:"elastic", //"fade", "none"
      scalePhotos:true,
      // slideshow: true,
      // slideshowSpeed : 2000,
      // slideshowAuto : false,
      rel:"group1",
      width:'',
      height:'',
      maxWidth:"95%",
      maxHeight:"95%",
      current: "[ {current} / {total} ]"
    };

    if($("a[rel='colorbox']").colorbox){
        $("a[rel='colorbox']").colorbox(colorboxObj);
    }
    $('a[href$="jpg"],a[href$="jpeg"],a[href$="JPG"],a[href$="JPEG"],a[href$="png"],a[href$="gif"]').colorbox(colorboxObj);

    // accordion
    if( $(".contents-accordion-posts").length ){
      $(".contents-accordion-posts > section").each( function() {
        $(this).find('.title').on('click', function(e) {
          // alert($(this).parents("section").html());
          if (w <= small) { // small以下
            // console.log( $(this).parent().find(".body").html());
            $(this).parents("section").toggleClass("open");
            $(this).parents("section").find(".body").slideToggle();
          }
        });
      });
    }

    //contents-accordion
    if( $(".contents-accordion > section").length ){
      // resetContentsAccordion( $(".contents-accordion > section") );
      $(".contents-accordion > section").each( function() {
        $(this).find('h2').on('click', function(e) {
          if (w <= small) { // small以下
            // console.log( $(this).parent().find(".body").html());
            var secAcc = $(this).closest("section");
            var secH = secAcc.attr("data-height");
            // secAcc.slideToggle();
            // 見出しよりもセクションが高い＝開いている
            console.log( secAcc.outerHeight() +":"+ $(this).outerHeight() +":"+ secH );
            if( secAcc.outerHeight() <= $(this).outerHeight()+3 ) {
              //開く
              secAcc.addClass("open");
              //height("auto");
              // secH = secH;
              console.log("開く");
            } else {
              //閉じる
              secAcc.removeClass("open");
              secH = $(this).outerHeight();
            }

            secAcc.animate(
              { height: secH }
            );
          }
        });
      });
    }

    // Event handler
    function eventHandler(e,selector) {
        e.stopPropagation();
        e.preventDefault();

        if (!e) {
            // イベントオブジェクトが引数に渡されるブラウザでは、ここを通らない
            e = event;
        }
        if (e.type === 'touchend') selector.off('click');
    }

    // スライド
    if( $("#area-main-image").length > 0 ) {
      $('#area-main-image').sliderPro({
        responsive: true,
        aspectRatio: 1.77,
        width: "100%",
        height: 540,
        arrows: true,
        // buttons: false,
        waitForLayers: true,
        thumbnailWidth: 200,
        thumbnailHeight: 100,
        thumbnailPointer: true,
        // autoplay: false,
        autoScaleLayers: false,
        breakpoints: {
          500: {
            thumbnailWidth: 120,
            thumbnailHeight: 50
          }
        }
      });
    }

    // ページ内スクロール
    //ヘッダーの高さ
    var gNav1 = $("#g-nav");
    $('a[href^=#]').on('click', function(e) {
      var headerHight = gNav1.outerHeight() +10;
      var href= $(this).attr("href");
      var target = href == "#" || href == "" || href =="javascript:void(0)" ? 'html' : href;
      var position = $(target).get( 0 ).offsetTop - headerHight;
      $("html, body").animate({scrollTop:position}, 550, "swing");
      return false;
    });

    // 他ページからページ内リンクで飛んでてきた場合のスクロール処理 (onload時にURLに"#"があるかで判断)
    var url = $(location).attr('href');
    var headerHight = gNav1.outerHeight() +10;
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

    if ($("table.table-sp2").length) {
      $("table.table-sp2").wrap("<div class='table-wrapper' />");
    }


    // 各記事のSNSのシェアカウント数の取得
    if (typeof(sns_permalink) == "undefined" ) {
      // 未定義時の処理
      sns_permalink = location.href;
    }
    if (typeof(sns_selecor) == "undefined") {
      sns_selecor = ".sns-links";
    }
    if($(sns_selecor).length > 0 ) {
      get_social_count( sns_permalink, sns_selecor);
    }


    // //指定したカラムレイアウトの高さ調整
    flatHeightsGroup();

    //リンクへのclass設定 (外部リンク、ファイルへのリンク
    var Location = location.href;
    var myDomain = location.host;

    if ($("#main a").length) {
      $("#main").find("a").each(function() {
        //サイト外リンクにclass'LinkBlank'設定
        //外部リンクか判別
        if (myDomain.indexOf(this.hostname) == -1 &&
          this.hostname != "") {
          //画像を含んでいない場合(テキストのみの場合）
          //if( $(this).find("img").length == 0) {
          if ($(this).find("img").length == 0) {
            //違うサイトへのリンクの処理
            $(this).addClass("link-external"); //Class名追加
          }
          $(this).attr("target", "_blank"); //target = "_blank"
        }
      });
    }

    // var ul = $(".local-contents ul");
    // if ($(ul).length) {
    //   $(ul).find("li").each(function() {
    //     // <li><a>リスト</a></li>　の形か判別
    //     if (this.hostname) == -1 &&
    //         this.hostname != "") {
    //         //画像を含んでいない場合(テキストのみの場合）
    //         //if( $(this).find("img").length == 0) {
    //         if ($(this).find("img").length == 0) {
    //             //違うサイトへのリンクの処理
    //             $(this).addClass("link-external"); //Class名追加
    //         }
    //         $(this).attr("target", "_blank"); //target = "_blank"
    //     }
    //   });
    // }

    //ファイル拡張子別にclass設定
    $("#main a[href$='.xls'], #main a[href$='.xlsx']").addClass("link-xls");
    $("#main a[href$='.doc'], #main a[href$='.docx']").addClass("link-doc");
    $("#main a[href$='.pdf']:not(:has(img))").addClass("link-pdf").attr("target", "_blank");


    // ul>li>aなリンクリストの場合
    $("#main .main-contents ul > li > a").each(function() {
      if (!$(this).parents("li").hasClass("li-link")) {
        // alert($(this).html());
        $(this).parents("li").addClass("li-link"); //Class名追加
      }
    });


    // baserCMS メールフォーム ：送信ボタン、戻るボタン
    $(".form-submit").click(function(){
      var mode = $(this).attr('id').replace('BtnMessage', '');
      $("#MessageMode").val(mode);
      return true;
    });


    // ログイン判別:baserCMS
    if( $('#ToolBar').length > 0) {
      body.addClass('logined baserCMS');
    }

  }); // end of document ready
})(jQuery); // end of jQuery name space


/*
 scroll
 ================================================================*/

// スクロールしてナビを固定
var gNav    = $('#g-nav');
var loginedToolbar  = $('#ToolBar');
var body = $('body');
// var contentsElm= $('#contents');

offset = gNav.offset();
fixedTop = offset.top;

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
    // $(".pagetop").fadeOut();
  }
});


/*
 funcions
 ================================================================*/

// アコーディオンコンテンツを初期化する
function resetContentsAccordion(select){
  select.each( function() {
    var sec = $(this);
    var secH = sec.height();
    var secH2H = sec.find('h2').outerHeight();
    if (w <= small) { // small以下
      //セクションを閉じる前に高さをdata-height属性にメモして
      //見出しと同じ高さまで縮めて閉じる
      // alert( sec.outerHeight() );

      // .openが付いてる時は何もしない
      // if( sec.hasClass('oepn')) {

      // }
      // // まだ枠の高さがメモされてない時、
      // else if( !sec.attr("data-height") ) {
      //   sec.attr("data-height", secH );
      //   if( !sec.hasClass('oepn')) {
      //     sec.outerHeight( secH2H );
      //   }
      // }
      // // 枠の高さが見出し高さより上の時
      // else if( secH > secH2H  ) {
      //   // sec.outerHeight( secH2H );
      //   // sec.attr("data-height", secH );
      // } else {
      //   // sec.attr("data-height", secH );
      // }
      // // sec.attr("data-height", secH );

      if( !sec.attr("data-height") ) {
        sec.attr("data-height", secH );
        if( !sec.hasClass('oepn')) {
          sec.outerHeight( secH2H );
        }
      }

    } else {
      //全て開き classも削除
      sec.removeAttr("data-height").height("auto").removeClass("open");
    }
  });
}



// 高さをそろえる
function flatHeightsGroup() {
  w = $(window).width();

  if (w <= small) { // small以下
    // プロジェクト紹介の3カラムの高さ→解除
    $(".project > .col").height("auto");
    //HOME
    $(".flatH > a").height("auto");
    setFlatHeights( ".flatH > a" , 3);
    $(".post-items > .item > a").height("auto");
    setFlatHeights( ".post-items > .item.s6 > a" , 2);

  } else if (w <= medium) { // medium以下
    // プロジェクト紹介の2カラムの高さ調整
    setFlatHeights( ".project > .col" , 2);
    //HOME
    setFlatHeights( ".flatH > a" , 3);

    $(".post-items > .item > a").height("auto");
    setFlatHeights( ".post-items > .item.m4 > a" , 3);
    setFlatHeights( ".post-items > .item.m3 > a" , 4);
  } else {
    //アコーディオンのbodyを全て開く
    $(".accordion").removeClass("active").find(".body").show();
    // プロジェクト紹介の3カラムの高さ調整
    setFlatHeights( ".project > .col" , 3);
    //HOME
    $(".flatH > a").height("auto");
    setFlatHeights( ".flatH > a" , 3);

    $(".post-items > .item > a").height("auto");
    $('.post-items').each(function(index, element){
      setFlatHeights( ".post-items:eq("+ index +") > .item.m4 > a" , 3);
      setFlatHeights( ".post-items:eq("+ index +") > .item.m3 > a" , 4);
    });
    // setFlatHeights( ".post-items > .item.m4 > a" , 3);
    // setFlatHeights( ".post-items > .item.m3 > a" , 4);
  }

  //教育事業など
  $(".flatH-col-p p").height("auto").flatHeights();

  $(".flatH-col > .col strong").height("auto").flatHeights();
  $(".flatH-col > .col p:not(.btn)").height("auto").flatHeights();

  // ログイン時のツールバーの分、ヘッダーをずらす
  // var loginedToolbarH = $('#ToolBar').outerHeight();
  // // console.log( loginedToolbarH );
  // if( loginedToolbarH > 0) {
  //   $("#g-header").css("margin-top", loginedToolbarH + "px");
  // }
}




//指定したカラムレイアウトの高さ調整
function setFlatHeights(selector, col) {
    //初期化
    $(selector).css({
        'height': 'auto'
    });

    var i = 0;
    var slc = ''; //高さを揃える要素のselect文
    var MaxNum = $(selector).length;
    $(selector).each(function() {
        index = $(selector).index(this); //Index Noを取得
        //指定したカラム数か、 最後の要素だったら
        if ((index * 1 + 1) % col == 0 || (index * 1 + 1) == MaxNum) {
            slc += selector + ':eq(' + index + ')';
            $(slc).flatHeights();
            slc = '';
        } else {
            slc += selector + ':eq(' + index + ') ,';
        }
        i++;
    });
}

//テーブルの高さを画面幅一杯に揃える
function fixTableBoxHeighSet() {
    if ($("#fixTableBox").length > 0) {
        var bH = $("body").outerHeight(true);
        var ghH = $("#gHeader").outerHeight(true);
        var sfH = $("#search-form-box").outerHeight(true);
        var gfH = $("#gFooter").outerHeight(true);
        var inH = $("#result h2").outerHeight(true);
        var tmpH = 20;
        var tbH = Math.ceil(bH - ghH - sfH - gfH - inH - tmpH);

        // 計算結果の高さが100px以内だった
        if (tbH < 100) tbH = 100;
        $("#fixTableBox").height(tbH);

        msg = "bH=" + bH + ", ghH=" + ghH + ", sfH=" + sfH + ", gfH=" + gfH + ", inH=" + inH + ", tbH=" + tbH;
        // alert(msg);
    }
}


// SNS関連

// Facebook,Twitter,Google+のカウント取得
function get_social_count(postUrl, selector) {
    get_social_count_facebook(postUrl, selector +" .facebook .count");
    get_social_count_twitter(postUrl, selector +" .twitter .count");
    // get_social_count_google(postUrl, selector +" .google .count");
}

// Facebookのカウント数を取得
function get_social_count_facebook(url, selector) {
    $.ajax({
        url:'https://graph.facebook.com/',
        dataType:'jsonp',
        data:{
            id:url
        },
        success:function(res){
            $(selector).text( res.shares || 0 );
            if(res.count>0)  $(selector).show(); // 1以上だったら表示
        },
        error:function(){
            $(selector).text('?').hide();
        }
    });
}

// Twitterのカウント数を取得
function get_social_count_twitter(url, selector) {
    $.ajax({
        url:'http://urls.api.twitter.com/1/urls/count.json',
        dataType:'jsonp',
        data:{
            url:url
        },
        success:function(res){
            $(selector).find("a").text( res.count || 0 );
            if(res.count>0)  $(selector).show(); // 1以上だったら表示
            $(selector).find("a").attr("href", "http://twitter.com/search?q=" + encodeURIComponent(url) );
        },
        error:function(){
            $(selector).text('?').hide();
            $(selector).find("a").attr("href", "http://twitter.com/search?q=" + encodeURIComponent(url) );
        }
    });
}

// Google+のカウント数を取得
function get_social_count_google(url, selector) {
    //PHPプログラムのURL
    var php_url = '<?php echo $this->BcBaser->getThemeUrl() ?>js/get_count_googleplus.php';

    //Ajax通信
    $.ajax({
        url:php_url + '?url=' + url,
        success:function(count){
            $(selector).text( count || 0 );
            if(res.count>0)  $(selector).show(); // 1以上だったら表示
        },
        error:function(){
            $(selector).text('?').hide();
        },
        complete:function(){ return false; }
    });
}

