<?php
    /* Set CTA link */
    $cta_link = get_the_category($post->ID)[0]->cat_name == 'TopDonasiBebas' && is_single() ?
        'https://www.tokopedia.com/donasi-online/?utm_source=site&utm_medium=WddmUAVW&utm_campaign=CO_TOP-DON_0_BO_0&utm_content=TOP-DON-B' :
        'https://www.tokopedia.com/';
    
?>

<!-- Search Box -->
<div class="sidebar-search">
    <h3 class="text-primary sidebar-search__heading">Cari Blog di Tokopedia Berbagi</h3>
    <form action="<?php bloginfo('url'); ?>" method="GET">
        <div class="input-group">
            <input type="text" name="s" class="form-control sidebar-search__input" placeholder="Ketik kata kunci blog di sini">
            <span class="input-group-btn">
                <button class="btn btn-green sidebar-search__btn" type="submit">Cari</button>
            </span>
        </div>
    </form>
</div>

<!-- Call-to-action -->
<div class="sidebar-box">
    <h3 class="text-primary sidebar-box__heading">Ayo mulai berbagi sesama di Tokopedia!</h2>
    <p class="text-secondary sidebar-box__p">Melalui Tokopedia, kamu bisa berdonasi dan berzakat. Berbagi untuk sesama, dimulai dari Tokopedia!</p>
    <div class="sidebar-cta">
        <a href="<?php echo $cta_link ?>" target="_blank">
            <button class="btn btn-orange btn-big sidebar-cta__btn">Salurkan Donasi</button>
        </a>
    </div>
</div>

<!-- If single page, display popular post -->
<?php if(is_single()): ?>

    <div class="sidebar-box">
        <?php dynamic_sidebar( 'sidebar-primary' ); ?>
    </div>
    
    
<?php else: ?>
    <!-- Topdonasi 100's Video-->
    <div class="sidebar-box">
        <h3 class="text-primary sidebar-box__heading">TopDonasi100 Bulan Ini</h3>
        <div class="blog-video">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/Bti4s43C8bI" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
    
    <!-- NGO logo -->
    <div class="sidebar-box">
        <h3 class="text-primary sidebar-box__heading">Lembaga Penyalur Donasi</h2>
        <div class="row">
            <div class="col-xs-4 col-sm-3 col-md-4 col-lg-3">
                <a href="http://pusat.baznas.go.id">
                    <img src="https://ecs7.tokopedia.net/microsite-production/donasi/logo/baznas.png" alt="baznas" class="img-responsive sidebar__img-partner">
                </a>
            </div>
            <div class="col-xs-4 col-sm-3 col-md-4 col-lg-3">
                <a href="http://www.dompetdhuafa.org">
                    <img src="https://ecs7.tokopedia.net/microsite-production/donasi/logo/dd.png" alt="dompet dhuafa" class="img-responsive sidebar__img-partner">
                </a>
            </div>
            <div class="col-xs-4 col-sm-3 col-md-4 col-lg-3">
                <a href="http://www.pkpu.org">
                    <img src="https://ecs7.tokopedia.net/microsite-production/donasi/logo/pkpu.png" alt="pkpu" class="img-responsive sidebar__img-partner">
                </a>
            </div>
            <div class="col-xs-4 col-sm-3 col-md-4 col-lg-3">
                <a href="http://www.ycabfoundation.org/en/">
                    <img src="https://ecs7.tokopedia.net/microsite-production/donasi/logo/ycab.png" alt="ycab" class="img-responsive sidebar__img-partner">
                </a>
            </div>
        </div>
    </div>
    
    <!-- Gallery -->
    <?php $gallery_ID = 119;
          $gallery_attachments = get_post_meta($gallery_ID, 'repeatable_fields', true);
          $gallery_url = get_permalink($gallery_ID);
        
    if($gallery_attachments != NULL): ?>
    
    <div class="sidebar-box hidden-xs hidden-sm">
        <h3 class="text-secondary sidebar-box__heading">Galeri Foto</h3>
        <div class="row">
            <?php if(sizeof($gallery_attachments) > 4) 
                $gallery_attachments = array_slice($gallery_attachments, -4, 4); // Select 4 last images for thumbnail
            
            foreach($gallery_attachments as $attachment): ?>
            
                <div class="sidebar-gallery">
                    <a href="<?php echo $gallery_url ?>">
                        <img src="<?php echo $attachment['url'] ?>" alt="gallery" class="sidebar-gallery__img">
                    </a>
                </div>
            
            <?php endforeach ?>
        </div>
        <div class="row">
            <div class="col-md-12 sidebar-gallery__link">
                <a href="<?php echo $gallery_url ?>" class="pull-right">Lihat lainnya &raquo;</a>
            </div>
        </div>
    </div>
        
    <?php endif ?>
    
<?php endif ?>