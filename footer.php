<?php
$dark_footer_cond = get_field('page-settings__dark-footer-cond');
?>

<?php if(!is_404()): ?>
    <footer class="footer <?= $dark_footer_cond ? 'footer--dark' : ''; ?>">
        <div class="container">
            <div class="footer__menu">

                <ul>
                    <li>
                        <a href="#">Explore eXp</a>
                    </li>
                    <li>
                        <a href="#">Find an Agent</a>
                    </li>
                    <li>
                        <a href="#">Join eXp</a>
                    </li>
                    <li>
                        <a href="#">Investor Relations</a>
                    </li>
                    <li>
                        <a href="#">Company Careers</a>
                    </li>
                </ul>

                <ul>
                    <li>
                        <a href="#">eXp Life</a>
                    </li>
                    <li>
                        <a href="#">Zoocasa</a>
                    </li>
                    <li>
                        <a href="#">Success</a>
                    </li>
                    <li>
                        <a href="#">Quebec Listings</a>
                    </li>
                    <li>
                        <a href="#">Accessibility</a>
                    </li>
                </ul>

                <ul>
                    <li>
                        <a href="#">Terms and Conditions</a>
                    </li>
                    <li>
                        <a href="#">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#">Cookie Policy</a>
                    </li>
                    <li>
                        <a href="#">Modalités</a>
                    </li>
                    <li>
                        <a href="#">Politique de confidentialité</a>
                    </li>
                    <li>
                        <a href="#">Sitemap</a>
                    </li>
                </ul>

                <ul>
                    <li>
                        <a href="#">800 - 1070 Douglas Street, Victoria, BC, V8W2C4</a>
                    </li>
                    <li>
                        <a href="#">
                            <svg id="phone" xmlns="http://www.w3.org/2000/svg" width="17.21" height="17.21"
                                 viewBox="0 0 17.21 17.21">
                                <path id="Path_1742" data-name="Path 1742"
                                      d="M7.128,4A4.04,4.04,0,0,0,4.35,5.793,2.629,2.629,0,0,0,4.26,8.3a15.338,15.338,0,0,0,3.585,5.737,17.018,17.018,0,0,0,6.1,3.944,2.944,2.944,0,0,0,2.958-.717c.717-.717,1.434-1.434.627-2.51a7.278,7.278,0,0,0-2.42-2.151c-.925-.463-1.474-.294-1.793.359a14.452,14.452,0,0,0-.359,1.434c-.161.484-.807.359-1.524,0a13.245,13.245,0,0,1-3.854-3.944c-.889-1.334.531-1.341,1.434-1.793.717-.359.939-1.183.359-2.151C8.294,4.717,7.935,4,7.128,4Z"
                                      transform="translate(-2.557 -2.566)" fill="none" stroke="#1a1a1a" stroke-width="1" />
                                <path id="Path_1743" data-name="Path 1743" d="M0,0H17.21V17.21H0Z" fill="none" />
                            </svg>

                            833-303-0610</a>
                    </li>
                    <li>
                        <a href="#">
                            <svg id="mail" xmlns="http://www.w3.org/2000/svg" width="17.21" height="17.21"
                                 viewBox="0 0 17.21 17.21">
                                <path id="Path_1739" data-name="Path 1739"
                                      d="M5.434,8H16.907a1.438,1.438,0,0,1,1.434,1.434v8.6a1.438,1.438,0,0,1-1.434,1.434H5.434A1.438,1.438,0,0,1,4,18.039v-8.6A1.438,1.438,0,0,1,5.434,8Z"
                                      transform="translate(-2.566 -5.132)" fill="none" stroke="#1a1a1a" stroke-linecap="round"
                                      stroke-linejoin="round" stroke-width="1" />
                                <path id="Path_1740" data-name="Path 1740" d="M18.342,12l-7.171,5.02L4,12"
                                      transform="translate(-2.566 -7.698)" fill="none" stroke="#1a1a1a" stroke-linecap="round"
                                      stroke-linejoin="round" stroke-width="1" />
                                <path id="Path_1741" data-name="Path 1741" d="M0,0H17.21V17.21H0Z" fill="none" />
                            </svg>

                            info@exprealty.net</a>
                    </li>
                </ul>
            </div>

            <div class="footer__action">
                <div class="footer__logo">
                    <h2>eXp</h2>

                    <img width="92" height="92"
                         src="<?= THEME_URL; ?>/assets/img/kisspng-flag-of-portugal-national-flag-flag-of-spain-5b086a27cdc0e3.1270755815272781198428.png"
                         alt="">
                </div>

                <div class="footer__img">
                    <div class="footer__img-bg">
                        <img width="398" height="360" src="<?= THEME_URL; ?>/assets/img/dimitry-b-n7gJNgv6eN0-unsplash.jpg" alt="">
                    </div>

                    <a href="#" class="button">Agent? Join us’</a>
                </div>
            </div>

            <div class="footer__copy">
                <p>
                    The trademarks MLS®, Multiple Listing Service® and the associated logos are owned by The Canadian Real
                    Estate Association (CREA) and identify the quality of services provided by real estate professionals who are
                    members of CREA. eXp Realty holds real estate brokerage licenses in multiple provinces. For information on
                    licences please contact us at info@exprealty.net
                </p>

                <p>
                    For listings in Canada, the trademarks REALTOR®, REALTORS®, and the REALTOR® logo are controlled by The
                    Canadian Real Estate Association (CREA) and identify real estate professionals who are members of CREA. The
                    trademarks MLS®, Multiple Listing Service® and the associated logos are owned by CREA and identify the
                    quality of services provided by real estate professionals who are members of CREA. Used under license.
                </p>

                <p> © <?= date('Y'); ?> eXp Realty. eXp World Holdings, Inc. All Rights Reserved</p>
            </div>
        </div>


    </footer>
<?php endif; ?>

</main>

<?php
get_template_part('template-parts/modals/images-modal');
get_template_part('template-parts/modals/map-modal');
get_template_part('template-parts/modals/contact-modal');
?>

<script>
    const $ = jQuery
</script>

<?php wp_footer(); ?>

</body>

</html>