<?php
/**
 * @file Background template
 */

?>
<?php
  $type = !empty($type) ? $type : '';
  $content = !empty($content) ? $content : array();
  $bg_image = !empty($content['field_home_dest_bg_image']) ? file_create_url($content['field_home_dest_bg_image']['#items'][0]['uri']) : '';
?>

<?php if ($type == 'season_giving'): ?>
  <section class="section section-lanterns">
    <div class="inner">
      <div class="container">

        <?php if (!empty($content['field_home_dest_title_image'])): ?>
          <div class="img-desktop-only">
            <div class="img">
              <?php print render($content['field_home_dest_title_image']); ?>
            </div>
          </div>
        <?php endif; ?>

        <div class="content-wrap style-a">
          <header class="titles style-c">
            <?php if (!empty($content['field_home_dest_title'])): ?>
              <div class="title-h1">
                <h2>
                  <span><?php print render($content['field_home_dest_title']); ?></span>
                </h2>
              </div>
            <?php endif; ?>
          </header>

          <div class="desc style-d">
            <?php if (!empty($content['field_home_dest_description'])): ?>
              <p><?php print render($content['field_home_dest_description']); ?></p>
            <?php endif; ?>

            <?php print render($content['field_home_dest_link']); ?>
          </div>
        </div>
      </div>
    </div>


    <div class="float-elements first-start">
      <div class="items">
        <div class="item img-2 large position-1 top-1"></div>
        <div class="item middle position-19 top-2"></div>
        <div class="item x-large position-7 top-3"></div>
        <div class="item x-small position-20 top-4"></div>
        <div class="item small position-5 top-5"></div>
        <div class="item x-small position-15 top-6"></div>
        <div class="item img-2 middle position-2 top-7"></div>
        <div class="item img-2 x-small position-7 top-7"></div>
        <div class="item img-2 small position-1 top-8"></div>
        <div class="item img-2 small position-20 top-9"></div>
        <div class="item img-2 x-small position-15 top-10"></div>
        <div class="item small position-11 top-11"></div>
        <div class="item x-large position-1 top-12"></div>
        <div class="item large position-18 top-12"></div>
        <div class="item img-2 small position-8 top-13"></div>
        <div class="item x-small position-1 top-14"></div>
        <div class="item x-middle position-20 top-15"></div>
        <div class="item img-2 smallest position-4 top-16"></div>
        <div class="item x-small position-17 top-17"></div>
        <div class="item img-2 smallest position-10 top-18"></div>
        <div class="item x-large position-2 top-18"></div>
        <div class="item img-2 x-middle position-2 top-19"></div>
        <div class="item small position-20 top-20"></div>
        <div class="item x-middle position-18 top-21"></div>
        <div class="item img-2 small position-11 top-21"></div>
        <div class="item img-2 middle position-6 top-22"></div>
        <div class="item img-2 x-middle position-1 top-23"></div>
      </div>
    </div>
    <div class="float-elements">
      <div class="items">

        <div class="item img-2 large position-1 delay-1"></div>
        <div class="item middle position-2 delay-7"></div>
        <div class="item x-large position-3 delay-12"></div>
        <div class="item x-small position-4 delay-2"></div>
        <div class="item small position-4 delay-3"></div>
        <div class="item x-small position-5 delay-13"></div>
        <div class="item img-2 x-small position-6 delay-22"></div>
        <div class="item img-2 small position-7 delay-15"></div>
        <div class="item img-2 small position-8 delay-24"></div>
        <div class="item img-2 x-small position-9 delay-21"></div>
        <div class="item small position-10 delay-14"></div>
        <div class="item large position-11 delay-4"></div>
        <div class="item img-2 small position-11 delay-6"></div>
        <div class="item x-small position-12 delay-18"></div>
        <div class="item x-middle position-13 delay-17"></div>
        <div class="item img-2 smallest position-13 delay-23"></div>
        <div class="item x-small position-14 delay-11"></div>
        <div class="item img-2 smallest position-15 delay-9"></div>
        <div class="item img-2 x-middle position-16"></div>
        <div class="item small position-17 delay-10"></div>
        <div class="item img-2 small position-19 delay-16"></div>
        <div class="item img-2 middle position-20 delay-8"></div>
        <div class="item img-2 x-middle position-20 delay-20"></div>

        <div class="item img-2 large position-1 delay-25"></div>
        <div class="item middle position-2 delay-31"></div>
        <div class="item x-large position-3 delay-36"></div>
        <div class="item x-small position-4 delay-26"></div>
        <div class="item small position-4 delay-27"></div>
        <div class="item x-small position-5 delay-37"></div>
        <div class="item img-2 x-small position-6 delay-46"></div>
        <div class="item img-2 small position-7 delay-39"></div>
        <div class="item img-2 small position-8 delay-48"></div>
        <div class="item img-2 x-small position-9 delay-45"></div>
        <div class="item small position-10 delay-38"></div>
        <div class="item large position-11 delay-28"></div>
        <div class="item img-2 small position-11 delay-30"></div>
        <div class="item x-small position-12 delay-42"></div>
        <div class="item x-middle position-13 delay-43"></div>
        <div class="item img-2 smallest position-13 delay-47"></div>
        <div class="item x-small position-14 delay-35"></div>
        <div class="item img-2 smallest position-15 delay-33"></div>
        <div class="item img-2 x-middle position-40"></div>
        <div class="item small position-17 delay-34"></div>
        <div class="item img-2 small position-19 delay-40"></div>
        <div class="item img-2 middle position-20 delay-34"></div>
        <div class="item img-2 x-middle position-20 delay-44"></div>
      </div>
    </div>

  </section>
  <section class="section style-a section-foundation">
    <div class="bg">
      <div class="clip-path-img-top-a">
        <div class="bg-img" style="background-image: url('<?php print $bg_image; ?>');"
             data-bottom-top="transform:translate3d(0px, -150px, 0px)"
             data-top-bottom="transform:translate3d(0px, 150px, 0px)"></div>
      </div>

      <svg width="100%" height="100%" >
        <g clip-path="url(#clip-path-img-top-a)">
          <image data-bottom-top="@transform:translate(0, -150)" data-top-bottom="@transform:translate(0, 150)" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php print $bg_image; ?>"
                 width="100%" height="100%" preserveAspectRatio="xMidYMid slice"></image>
        </g>
      </svg>
    </div>
  </section>
<?php endif; ?>