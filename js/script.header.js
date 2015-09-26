//IEの判定 via https://w3g.jp/blog/tools/js_browser_sniffing
var _ua = (function(){
  return {
    lte_IE6:typeof window.addEventListener == "undefined" && typeof document.documentElement.style.maxHeight == "undefined",
    lte_IE7:typeof window.addEventListener == "undefined" && typeof document.querySelectorAll == "undefined",
    lte_IE8:typeof window.addEventListener == "undefined" && typeof document.getElementsByClassName == "undefined",
    lte_IE9:document.uniqueID && typeof window.matchMedia == "undefined",
    gte_IE10:document.uniqueID && window.matchMedia ,
    eq_IE8:document.uniqueID && document.documentMode === 8,
    eq_IE9:document.uniqueID && document.documentMode === 9,
    eq_IE10:document.uniqueID && document.documentMode === 10,
    eq_IE11:document.uniqueID && document.documentMode === 11,
//        eq_IE10:document.uniqueID && window.matchMedia && document.selection,
//        eq_IE11:document.uniqueID && window.matchMedia && !document.selection,
//        eq_IE11:document.uniqueID && window.matchMedia && !window.ActiveXObject,
    Trident:document.uniqueID
  }
})();

if(_ua.lte_IE8){
  // alert("IE8");
}
// if(_ua.lte_IE7){
//   alert("lte_IE7");
// }

//単純にIEでないならfalse、IEならtrue IE10まで
//IE11は含まれない
var is_ie = false;
/*@cc_on
is_ie = true;
@*/

var userAgent, isIE, array, version;
// UserAgetn を小文字に正規化
userAgent = window.navigator.userAgent.toLowerCase();
// IE かどうか判定
isIE = (userAgent.indexOf('msie') >= 0 || userAgent.indexOf('trident') >= 0);

// IE の場合、バージョンを取得
if (isIE) {
  array = /(msie|rv:?)\s?([\d\.]+)/.exec(userAgent);
  version = (array) ? array[2] : '';
  document.write('<link rel="stylesheet" href="<?php echo $this->BcBaser->getThemeUrl() ?>css/ie.css">');
}