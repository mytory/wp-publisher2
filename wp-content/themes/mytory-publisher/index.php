<? get_header(); ?>
  <div class="body">
    <div class="content">
      <? if ( have_posts() ) : ?>
        <ul>
          <? while ( have_posts() ) : the_post(); ?>
            <li class="home-li">
              <a href="<?the_permalink()?>"><?the_title()?></a>
              <small><?=get_the_date()?></small>
            </li>
          <? endwhile; ?>
        </ul>
      <? endif; ?>
    </div>
  </div>
<? get_footer(); ?>