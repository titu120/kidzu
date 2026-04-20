<?php 

global $kidzu_option;
if(!empty($kidzu_option['facebook']) || !empty($kidzu_option['twitter']) || !empty($kidzu_option['rss']) || !empty($kidzu_option['pinterest']) || !empty($kidzu_option['google']) || !empty($kidzu_option['instagram']) || !empty($kidzu_option['vimeo']) || !empty($kidzu_option['tumblr']) ||  !empty($kidzu_option['youtube'])){
?>

    <ul class="offcanvas_social">  
        <?php
        if(!empty($kidzu_option['facebook'])) { ?>
        <li> 
        <a href="<?php echo esc_url($kidzu_option['facebook'])?>" target="_blank"><span><i class="fa fa-facebook"></i></span></a> 
        </li>
        <?php } ?>
        <?php if(!empty($kidzu_option['twitter'])) { ?>
        <li> 
        <a href="<?php echo esc_url($kidzu_option['twitter']);?> " target="_blank"><span><i class="fa fa-twitter"></i></span></a> 
        </li>
        <?php } ?>
        <?php if(!empty($kidzu_option['rss'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($kidzu_option['rss']);?> " target="_blank"><span><i class="fa fa-rss"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($kidzu_option['pinterest'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($kidzu_option['pinterest']);?> " target="_blank"><span><i class="fa fa-pinterest-p"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($kidzu_option['linkedin'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($kidzu_option['linkedin']);?> " target="_blank"><span><i class="fa fa-linkedin"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($kidzu_option['google'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($kidzu_option['google']);?> " target="_blank"><span><i class="fa fa-google-plus-square"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($kidzu_option['instagram'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($kidzu_option['instagram']);?> " target="_blank"><span><i class="fa fa-instagram"></i></span></a> 
        </li>
        <?php } ?>
        <?php if(!empty($kidzu_option['vimeo'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($kidzu_option['vimeo'])?> " target="_blank"><span><i class="fa fa-vimeo"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($kidzu_option['tumblr'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($kidzu_option['tumblr'])?> " target="_blank"><span><i class="fa fa-tumblr"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($kidzu_option['youtube'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($kidzu_option['youtube'])?> " target="_blank"><span><i class="fa fa-youtube"></i></span></a> 
        </li>
        <?php } ?>     
    </ul>
<?php }

