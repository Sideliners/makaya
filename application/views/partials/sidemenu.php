<ul class="nav nav-list bs-docs-sidenav affix no-margin">
    <li><a href="#"><i class="icon-chevron-right"></i> Subscribe</a></li>
    <li class="dropdown-submenu">
        <a class="dropdown-toggle btn-link"><i class="icon-chevron-right"></i> Share</a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
            <li><a role="button" class="facebook btn-link"><i class="icon-facebook icon-2x"></i> Share on Facebook</a></li>
            <li><a href="https://twitter.com/share?text=<?=$twitterPost;?>" role="button" class="twitter btn-link"><i class="icon-twitter icon-2x"></i> Tweet this</a></li>
            <li><a href="http://www.pinterest.com/pin/create/button/?url=<?=$pinterest->url;?>&media=<?=$pinterest->media;?>&description=<?=$pinterest->description;?>" role="button" class="pinterest btn-link"><i class="icon-pinterest icon-2x"></i> Pin it</a></li>
        </ul>
    </li>
    <li><a href="<?=site_url('donation-info')?>"><i class="icon-chevron-right"></i> Support</a></li>
</ul>
