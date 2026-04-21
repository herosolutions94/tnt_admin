<footer>
    <div class="contain">
        <div class="flex">
            <div class="col">
                <h5>Contact Info</h5>
                <ul class="lst">
                    <li><a href="mailto:{{$site_settings->site_email}}">{{$site_settings->site_email}}</a></li>
                    <li><a href="tel:{{$site_settings->site_phone}}">{{$site_settings->site_phone}}</a></li>
                </ul>
                <div class="br"></div>
                <h5>Follow us on</h5>
                <ul class="social_lnks">
                    <li>
                        <a href="{{ $site_settings['site_facebook'] ?? '#' }}" target="_blank"><img src="assets/images/facebook.svg"
                                alt=""></a>
                    </li>
                    <li><a href="{{ $site_settings['site_instagram'] ?? '#' }}" target="_blank"><img src="assets/images/instagram.svg"
                                alt=""></a></li>
                    <li><a href="{{ $site_settings['site_twitter'] ?? '#' }}" target="_blank"><img src="assets/images/twitter.svg"
                                alt=""></a></li>
                    <li><a href="{{ $site_settings['site_linkedin'] ?? '#' }}" target="_blank"><img src="assets/images/linkedin.svg"
                                alt=""></a></li>
                </ul>
            </div>
            <div class="col">
                <h5>Short Links</h5>
                <ul class="lst">
                    <li><a href="/">Home</a></li>
                    <li><a href="/about">About Us</a></li>
                    <li><a href="/colors">Colors</a></li>
                    <li><a href="/aviva-pools">Aviva Pools</a></li>
                    <li><a href="/renaissance-patio">Renaissance Patio</a></li>
                    <li><a href="/stick-built">Stick Built</a></li>
                    <li><a href="/hardscapes">Hardscapes</a></li>


                </ul>
            </div>

            <div class="col">
                <h5>Other Links</h5>
                <ul class="lst">
                    <li><a href="/faqs">Faq's</a></li>
                    <li><a href="/blog">Blog</a></li>
                    <li><a href="/contact">Contact Us</a></li>
                </ul>
            </div>
            <div class="col">
                <h5>Warranty</h5>
                <ul class="lst">
                    <li><a href="">Warranty Registration</a></li>
                    <li><a href="/">Warranty Transfer</a></li>
                    <li><a href="/">Service Request</a></li>
                </ul>
            </div>
            <div class="col">
                <h5>Popular Articles</h5>
                <ul class="lst">
                    <li><a href="">Fiberglass Pools</a></li>
                    <li><a href="/">Small Inground Pools</a></li>
                    <li><a href="/">Fiberglass vs. vinyl vs. concrete</a></li>
                    <li><a href="">Salt Water Pools</a></li>
                    <li><a href="/">Safety Pool Covers</a></li>
                    <li><a href="/">Inground Swimming Pools</a></li>
                </ul>
            </div>

            <div class="col">
                <h5>Join our mailing list</h5>
                <form id="newsletterForm" action="{{url('/api/save-newsletter')}}" method="post" autocomplete="off"
                    class="frmAjax">
                    <label for="email">Stay up to date with the latest news and deals!</label>
                    <div class="txtGrp relative">
                        <input type="email" name="email" id="email" class="input" placeholder="@ your email address"
                            required>
                        <button type="submit"  class="site_btn">Submit<i class="spinner hidden"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="copy_right">
        <div class="contain">
            <div class="_inner">
                <p>©{{date('Y')}} <a href="{{url('/')}}">{{$site_settings->site_name}}</a>. All rights reserved</p>

            </div>
        </div>
    </div>
</footer>