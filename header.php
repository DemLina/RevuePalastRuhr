<?php
$solid_btn = get_field('header__solid-btn', 'option');
$transparent_btn = get_field('header__transparent-btn', 'option');

$nav = get_field('global-nav__nav', 'option');

$agent_phone_number = get_field('agent__phone-number', 'option');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,400..700;1,14..32,400..700&display=swap" rel="stylesheet">

    <?php wp_head(); ?>

</head>

<body class="loading">
<header class="header">
    <div class="header__inner container">
        <figure class="header__logo">
            <a href="<?= HOME_URL; ?>">
                <img width="102" height="53" src="<?= THEME_URL; ?>/assets/img/logo.svg" alt="image">
            </a>
        </figure>
        <nav class="header__nav">
            <?php if(!empty($nav)): ?>
                <ul class="header__menu">
                    <?php
                    foreach($nav as $nav_row):
                        $nav_link = $nav_row['link'];
                        ?>
                        <li>
                            <a href="<?= $nav_link['url'] ?>" <?= $nav_link['target'] ? 'target="_blank"' : ''; ?>
                               aria-label="<?= $nav_link['title']; ?>">
                                <?= $nav_link['title']; ?>
                            </a>
                        </li>
                    <?php
                    endforeach;
                    ?>
                </ul>
            <?php endif; ?>

            <?php if($agent_phone_number): ?>
                <div class="header__tel">
                    <a href="tel:<?= $agent_phone_number; ?>"><?= $agent_phone_number; ?></a>
                </div>
            <?php endif; ?>

            <ul class="header__socials">
                <li>
                    <a href="#" aria-label="facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21" height="21" viewBox="0 0 21 21">
                            <defs>
                                <clipPath id="clip-path">
                                    <rect class="fill" id="Rectangle_3114" data-name="Rectangle 3114" width="21" height="21" fill="#fff"/>
                                </clipPath>
                            </defs>
                            <g id="Group_13620" data-name="Group 13620" clip-path="url(#clip-path)">
                                <path class="fill" id="Path_1765" data-name="Path 1765" d="M10.373,0A10.374,10.374,0,0,0,7.868,20.441v-6.9H5.729v-3.17H7.868V9.007c0-3.531,1.6-5.167,5.064-5.167a11.458,11.458,0,0,1,2.255.258V6.971c-.245-.026-.67-.039-1.2-.039-1.7,0-2.358.644-2.358,2.319v1.121h3.388l-.582,3.17H11.631v7.127A10.374,10.374,0,0,0,10.373,0Z" transform="translate(0 0.253)" fill="#fff"/>
                            </g>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#" aria-label="instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21" height="21" viewBox="0 0 21 21">
                            <defs>
                                <clipPath id="clip-path">
                                    <rect class="fill" id="Rectangle_3112" data-name="Rectangle 3112" width="21" height="21" fill="#fff"/>
                                </clipPath>
                            </defs>
                            <g id="Group_13618" data-name="Group 13618" clip-path="url(#clip-path)">
                                <path class="fill" id="Path_1760" data-name="Path 1760" d="M10.373,1.868c2.772,0,3.1.012,4.19.061a5.684,5.684,0,0,1,1.925.357,3.208,3.208,0,0,1,1.191.774,3.191,3.191,0,0,1,.774,1.191,5.709,5.709,0,0,1,.357,1.925c.049,1.094.061,1.422.061,4.19s-.012,3.1-.061,4.19a5.685,5.685,0,0,1-.357,1.925,3.419,3.419,0,0,1-1.965,1.965,5.708,5.708,0,0,1-1.925.357c-1.094.049-1.422.061-4.19.061s-3.1-.012-4.19-.061a5.684,5.684,0,0,1-1.925-.357,3.208,3.208,0,0,1-1.191-.774,3.191,3.191,0,0,1-.774-1.191,5.708,5.708,0,0,1-.357-1.925c-.049-1.094-.061-1.422-.061-4.19s.012-3.1.061-4.19a5.684,5.684,0,0,1,.357-1.925,3.208,3.208,0,0,1,.774-1.191,3.191,3.191,0,0,1,1.191-.774,5.708,5.708,0,0,1,1.925-.357C7.274,1.88,7.6,1.868,10.373,1.868Zm0-1.868C7.557,0,7.2.012,6.1.061A7.58,7.58,0,0,0,3.582.543a5.063,5.063,0,0,0-1.84,1.2,5.083,5.083,0,0,0-1.2,1.836A7.6,7.6,0,0,0,.061,6.094C.012,7.2,0,7.557,0,10.373s.012,3.169.061,4.275a7.58,7.58,0,0,0,.482,2.516A5.063,5.063,0,0,0,1.742,19a5.071,5.071,0,0,0,1.836,1.2,7.6,7.6,0,0,0,2.516.482c1.106.049,1.459.061,4.275.061s3.169-.012,4.275-.061a7.579,7.579,0,0,0,2.516-.482,5.3,5.3,0,0,0,3.031-3.031,7.6,7.6,0,0,0,.482-2.516c.049-1.106.061-1.459.061-4.275s-.012-3.169-.061-4.275a7.579,7.579,0,0,0-.482-2.516A4.859,4.859,0,0,0,19,1.742a5.071,5.071,0,0,0-1.836-1.2A7.6,7.6,0,0,0,14.652.065C13.542.012,13.19,0,10.373,0Z" transform="translate(0.129 0.253)" fill="#fff"/>
                                <path class="fill" id="Path_1761" data-name="Path 1761" d="M17,11.672A5.329,5.329,0,1,0,22.329,17,5.33,5.33,0,0,0,17,11.672Zm0,8.785A3.456,3.456,0,1,1,20.457,17,3.457,3.457,0,0,1,17,20.457Z" transform="translate(-6.498 -6.374)" fill="#fff"/>
                                <path class="fill" id="Path_1762" data-name="Path 1762" d="M36.425,9.55a1.244,1.244,0,1,1-1.244-1.244A1.244,1.244,0,0,1,36.425,9.55Z" transform="translate(-19.14 -4.463)" fill="#fff"/>
                            </g>
                        </svg>

                    </a>
                </li>
                <li>
                    <a href="#" aria-label="tiktok">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17.721" height="20.747" viewBox="0 0 17.721 20.747">
                            <path class="fill" id="Path_1766" data-name="Path 1766" d="M17.029,0h-3.5V14.132a3.019,3.019,0,1,1-3.108-3.067V7.517a6.615,6.615,0,1,0,6.664,6.615V6.886a8.1,8.1,0,0,0,4.632,1.564V4.9A4.872,4.872,0,0,1,17.029,0Z" transform="translate(-4)" fill="#fff"/>
                        </svg>

                    </a>
                </li>
                <li>
                    <a href="#" aria-label="linkedin">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21" height="21" viewBox="0 0 21 21">
                            <defs>
                                <clipPath id="clip-path">
                                    <rect class="fill" id="Rectangle_3113" data-name="Rectangle 3113" width="21" height="21" transform="translate(-0.375)" fill="#fff"/>
                                </clipPath>
                            </defs>
                            <g id="Group_13619" data-name="Group 13619" transform="translate(0.375)" clip-path="url(#clip-path)">
                                <path class="fill" id="Path_1764" data-name="Path 1764" d="M19.211,0H1.532A1.513,1.513,0,0,0,0,1.5V19.248a1.516,1.516,0,0,0,1.532,1.5H19.211a1.519,1.519,0,0,0,1.536-1.5V1.5A1.516,1.516,0,0,0,19.211,0ZM6.155,17.679H3.076v-9.9h3.08ZM4.615,6.427A1.783,1.783,0,1,1,6.4,4.644,1.784,1.784,0,0,1,4.615,6.427ZM17.679,17.679H14.6V12.865c0-1.147-.02-2.626-1.6-2.626-1.6,0-1.844,1.252-1.844,2.545v4.895H8.088v-9.9h2.95V9.129h.041a3.231,3.231,0,0,1,2.909-1.6c3.116,0,3.691,2.05,3.691,4.717Z" transform="translate(-0.239 0.253)" fill="#fff"/>
                            </g>
                        </svg>

                    </a>
                </li>
                <li>
                    <a href="#" aria-label="facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20.648" height="20.747" viewBox="0 0 20.648 20.747">
                            <path class="fill" id="Path_1763" data-name="Path 1763" d="M0,20.747l1.458-5.328a10.28,10.28,0,1,1,3.992,3.9Zm5.7-3.291A8.525,8.525,0,1,0,3.332,15.15L2.468,18.3Zm9.843-4.723c-.064-.107-.235-.171-.493-.3s-1.52-.75-1.756-.836-.406-.129-.578.129-.664.836-.813,1.007-.3.193-.557.064a7.011,7.011,0,0,1-2.066-1.275,7.733,7.733,0,0,1-1.429-1.78c-.15-.257-.016-.4.112-.524s.257-.3.386-.45a1.685,1.685,0,0,0,.259-.428.472.472,0,0,0-.022-.45C8.525,7.761,8.012,6.5,7.8,5.982s-.421-.433-.578-.441l-.493-.009a.941.941,0,0,0-.685.322A2.882,2.882,0,0,0,5.143,8a5,5,0,0,0,1.049,2.657,11.453,11.453,0,0,0,4.388,3.879,14.864,14.864,0,0,0,1.464.541,3.531,3.531,0,0,0,1.618.1A2.646,2.646,0,0,0,15.4,13.955,2.14,2.14,0,0,0,15.546,12.732Z" fill="#fff"/>
                        </svg>
                    </a>
                </li>
            </ul>

            <?php if($solid_btn || $transparent_btn): ?>
                <div class="header__btns">
                    <?php if($solid_btn): ?>
                        <div class="header__btn">
                            <?php get_template_part('template-parts/components/btn', null, ['btn' => $solid_btn, 'btn_class' => 'button']); ?>
                        </div>
                    <?php endif; ?>

                    <?php if($transparent_btn): ?>
                        <div class="header__btn">
                            <?php get_template_part('template-parts/components/btn', null, ['btn' => $transparent_btn, 'btn_class' => 'button button--outline']); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </nav>
        <div class="header__burger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</header>
<main>
