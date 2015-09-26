<?php
// SNSリンク共通パーツ
$siteName = $siteConfig["name"];
$postLink =$this->BcBaser->getUri($this->BcBaser->getHere());
$shareTxt = urlencode($this->BcBaser->getContentsTitle() ."｜". $siteName);

if( $this->BcBaser->isHome() ) {
  $shareTxt = urlencode($siteName);
} else {
  $shareTxt = urlencode($this->BcBaser->getContentsTitle() ."｜". $siteName);
}


?>
<ul>
  <li class="facebook">
    <a class="btn waves-effect waves-light" href="http://www.facebook.com/share.php?u=<?php echo $postLink; ?>" onclick="window.open(this.href, 'FBwindow', 'width=650, height=450, menubar=no, toolbar=no, scrollbars=yes'); return false;" target="_blank">
    <i class="fa fa-facebook"></i> いいね!
    </a>
    <strong class="count">0</strong>
  </li>
  <li class="twitter">
    <a class="btn waves-effect waves-light" href="http://twitter.com/share?url=<?php echo $postLink; ?>&amp;text=<?php echo $shareTxt; ?>&amp;via=npo_aip&amp;related=@npo_aip" onclick="window.open(this.href, 'FBwindow', 'width=650, height=450, menubar=no, toolbar=no, scrollbars=yes'); return false;"  target="_blank">
      <i class="fa fa-twitter"></i> ツイート
    </a>
    <strong class="count"><a href="http://twitter.com/search?q=" target="_blank">0</a></strong>
  </li>
</ul>
<?php /*
<script type="text/javascript">
//for get_social_count()
var sns_permalink =  "<?php echo $postLink; ?>";
var sns_selecor = ".sns-links";
// get_social_count( "<?php echo $postLink; ?>", ".sns-links");
</script>
*/ ?>