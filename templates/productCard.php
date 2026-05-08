<div class="ProductCard">
    <a href="#product" class="ProductCard-link"></a>
    <div class="ProductCard-header">
        <div class="ProductCard-imageWrapper">
            <img src="public/images/product-<?php echo rand(0,1); ?>.png" width="652" height="560" alt="" class="ProductCard-image ProductCard-image--primary" loading="lazy">
        </div>
        <?php if (rand(0,1)) { ?>
            <div class="ProductCard-primaryBadges">
                <div class="Badge Badge--circle">
                    -10%
                </div>
            </div>
        <?php } ?>
        <?php if (rand(0,1)) { ?>
            <div class="ProductCard-tertiaryBadges">
                <div class="Badge Badge--rectangleSide">Pro grafiky</div>
            </div>
        <?php } ?>
    </div>
    <div class="ProductCard-body">
        <div>
            <?php if (rand(0,1)) { ?>
            <div class="ProductCard-secondaryBadges">
                <div class="Badge Badge--rectangle" style="--color: #5ce62e">
                    štítek test
                </div>
            </div>
            <?php } ?>
            <h2 class="ProductCard-title">
                <?php if (rand(0,1)) { ?>
                    MacBook Pro 15" 2,5 GHz s Retina displejem, 512 GB (2015)
                <?php } else { ?>
                    iPhone 5s
                <?php } ?>
            </h2>
        </div>
        <div class="ProductCard-stock">
            <?php if (rand(0,1)) { ?>
            <div class="u-fontMedium u-textColorGreen">Skladem &gt; 5 ks</div>
            <?php } else { ?>
                <div class="u-fontMedium u-textColorOrange">Naskladníme do 24 hodin</div>
            <?php } ?>
        </div>
    </div>
    <div class="ProductCard-footer">
        <div class="ProductCard-footerContent">
            <div class="ProductCard-priceWrapper">
                <div class="ProductCard-price"> 76&nbsp;990&nbsp;Kč</div>
            </div>
            <div class="ProductCard-quantity">
                <a href="#basket" class="Btn Btn--secondary Btn--style1 Btn-0--block Btn-xs--block Btn-sm--block ProductCard-btn ">Do košíku</a>
            </div>
        </div>
    </div>
</div>