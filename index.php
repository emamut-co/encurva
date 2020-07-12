<?php get_header();

$do_not_duplicate = array();
$sticky = get_option( 'sticky_posts' );

$sliderArray = new WP_Query(
  array(
    'post__in'            => $sticky,
    'posts_per_page'      => -1,
    'orderby'             => 'rand',
    'ignore_sticky_posts' => 1
  )
);

$first = true; ?>

<div class="row">
  <div class="col">
    <?php if(isset($sticky[0])): ?>
    <div id="main-carousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php for($cont == 0; $cont < sizeof($sliderArray->posts); $cont++): ?>
        <li data-target="#main-carousel" data-slide-to="0" <?php if($cont == 0) echo 'class="active"' ?>></li>
        <?php endfor ?>
      </ol>
      <div class="carousel-inner">
        <?php while ( $sliderArray->have_posts() ) : $sliderArray->the_post(); $do_not_duplicate[] = get_the_ID(); ?>
        <div class="carousel-item<?php if($first) echo ' active' ?>">
          <?php the_post_thumbnail('large', ['class' => 'd-block mx-auto w-100 h-auto']) ?>
          <div class="carousel-caption d-none d-md-block">
            <h1><?php the_title() ?></h1>
          </div>
        </div>
          <?php $first = false;
        endwhile ?>
        <a class="carousel-control-prev" href="#main-carousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#main-carousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
    <?php endif ?>
  </div>
</div>
<div class="row mt-5">
  <div class="col">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <h4 class="subtitle mb-3">EN NUESTRAS SECCIONES</h4>
        </div>
        <div class="col-md-4">
          <h4 class="subtitle mb-3">LAS MÁS LEIDAS HOY</h4>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer() ?>