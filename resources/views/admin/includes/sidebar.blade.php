<?php $admin_page = request()->segment(2); ?>
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ url('admin/dashboard') }}" class="text-nowrap logo-img">
                <img src="{{ get_site_image_src('images', $site_settings->site_logo) }}" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'dashboard' ? 'active' : '' }}"
                        href="{{ url('admin/dashboard') }}" aria-expanded="false">
                        <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>

                <li class="nav-small-cap">
                    <iconify-icon icon="octicon:gear-24"></iconify-icon>
                    <span class="hide-menu">Site Settings</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'site_settings' ? 'active' : '' }}"
                        href="{{ url('admin/site_settings') }}" aria-expanded="false">
                        <iconify-icon icon="octicon:gear-24"></iconify-icon>
                        <span class="hide-menu">Site Settings</span>
                    </a>
                </li>



                {{-- <li class="nav-small-cap">
                    <iconify-icon icon="lucide:users-round"></iconify-icon>
                    <span class="hide-menu">Users</span>
                </li> --}}

                {{-- <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'members' ? 'active' : '' }}"
                href="{{ url('admin/members') }}" aria-expanded="false">
                <iconify-icon icon="lucide:users-round"></iconify-icon>
                <span class="hide-menu">Clients</span>
                </a>
                </li> --}}

                {{-- <li class="sidebar-item">
                            <a class="sidebar-link {{ $admin_page == 'agents' ? 'active' : '' }}"
                href="{{ url('admin/agents') }}" aria-expanded="false">
                <iconify-icon icon="lucide:users"></iconify-icon>
                <span class="hide-menu">Agents</span>
                </a>
                </li> --}}


                <li class="nav-small-cap">
                    <iconify-icon icon="icon-park-outline:data-user"></iconify-icon>
                    <span class="hide-menu">User Entries</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'contact' ? 'active' : '' }}"
                        href="{{ url('admin/contact') }}" aria-expanded="false">
                        <iconify-icon icon="tabler:message-user"></iconify-icon>
                        <span class="hide-menu">Contact Messages</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'request-quote' ? 'active' : '' }}"
                        href="{{ url('admin/request-quote') }}" aria-expanded="false">
                        <iconify-icon icon="tabler:message-user"></iconify-icon>
                        <span class="hide-menu">Request Quotes</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'subscribers' ? 'active' : '' }}"
                        href="{{ url('admin/subscribers') }}" aria-expanded="false">
                        <iconify-icon icon="jam:newsletter"></iconify-icon>
                        <span class="hide-menu">Subscribers</span>
                    </a>
                </li>


                <li>
                    <span class="sidebar-divider lg"></span>
                </li>

                <li class="nav-small-cap">
                    <iconify-icon icon="fluent-mdl2:content-feed"></iconify-icon>
                    <span class="hide-menu">Site Content</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'sitecontent' || $admin_page == 'pages' ? 'active' : '' }}"
                        href="{{ url('admin/sitecontent') }}" aria-expanded="false">
                        <iconify-icon icon="oui:pages-select"></iconify-icon>
                        <span class="hide-menu">Website Pages</span>
                    </a>
                </li>

                {{-- <li class="sidebar-item">
                    <a class="sidebar-link has-arrow {{ $admin_page == 'locations' || $admin_page == 'specialization' || $admin_page == 'job_type' || $admin_page == 'jobs' ? 'active' : '' }}"
                href="javascript:void(0)" aria-expanded="false">
                <iconify-icon icon="ooui:articles-rtl"></iconify-icon>
                <span class="hide-menu">Manage Jobs</span>
                </a>
                <ul aria-expanded="false"
                    class="collapse first-level {{ $admin_page == 'locations' || $admin_page == 'specialization' || $admin_page == 'job_type' || $admin_page == 'jobs' ? 'in' : '' }}">
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ $admin_page == 'locations' ? 'active' : '' }}"
                            href="{{ url('admin/locations') }}">
                            <span class="icon-small"></span>Locations

                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ $admin_page == 'specialization' ? 'active' : '' }}"
                            href="{{ url('admin/specialization') }}">
                            <span class="icon-small"></span>Specialization

                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ $admin_page == 'job_type' ? 'active' : '' }}"
                            href="{{ url('admin/job_type') }}">
                            <span class="icon-small"></span>Job Types

                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ $admin_page == 'jobs' ? 'active' : '' }}"
                            href="{{ url('admin/jobs') }}">
                            <span class="icon-small"></span>Jobs

                        </a>
                    </li>

                </ul>
                </li> --}}

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow {{ $admin_page == 'blog' || $admin_page == 'blog_categories' ? 'active' : '' }}"
                        href="javascript:void(0)" aria-expanded="false">
                        <iconify-icon icon="ooui:articles-rtl"></iconify-icon>
                        <span class="hide-menu">Manage Blogs</span>
                    </a>
                    <ul aria-expanded="false"
                        class="collapse first-level {{ $admin_page == 'blog' || $admin_page == 'blog_categories' ? 'in' : '' }}">


                        <li class="sidebar-item">
                            <a class="sidebar-link {{ $admin_page == 'blog_categories' ? 'active' : '' }}"
                                href="{{ url('admin/blog_categories') }}">
                                <span class="icon-small"></span>Blogs
                                Categories
                            </a>
                        </li>


                        <li class="sidebar-item">
                            <a class="sidebar-link {{ $admin_page == 'blog' ? 'active' : '' }}"
                                href="{{ url('admin/blog') }}">
                                <span class="icon-small"></span>Blogs
                            </a>
                        </li>


                    </ul>
                </li>

                {{-- <li class="sidebar-item">
                    <a class="sidebar-link has-arrow {{ $admin_page == 'executive' || $admin_page == 'directors' || $admin_page == 'team' ? 'active' : '' }}"
                href="javascript:void(0)" aria-expanded="false">
                <iconify-icon icon="lucide:users"></iconify-icon>
                <span class="hide-menu">Our Team</span>
                </a>
                <ul aria-expanded="false"
                    class="collapse first-level {{ $admin_page == 'executive' || $admin_page == 'directors' || $admin_page == 'team' ? 'in' : '' }}">


                    <li class="sidebar-item">
                        <a class="sidebar-link {{ $admin_page == 'executive' ? 'active' : '' }}"
                            href="{{ url('admin/executive') }}" aria-expanded="false">
                            <iconify-icon icon="lucide:users"></iconify-icon>
                            <span class="hide-menu">Executive Team Members</span>

                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ $admin_page == 'directors' ? 'active' : '' }}"
                            href="{{ url('admin/directors') }}" aria-expanded="false">
                            <iconify-icon icon="lucide:users"></iconify-icon>
                            <span class="hide-menu">Board of Directors</span>

                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ $admin_page == 'team' ? 'active' : '' }}"
                            href="{{ url('admin/team') }}" aria-expanded="false">
                            <iconify-icon icon="lucide:users"></iconify-icon>
                            <span class="hide-menu">Team</span>

                        </a>
                    </li>

                </ul>
                </li> --}}

               <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'testimonials' ? 'active' : '' }}"
                href="{{ url('admin/testimonials') }}" aria-expanded="false">
                <iconify-icon icon="dashicons:testimonial"></iconify-icon>
                <span class="hide-menu">Testimonials</span>
                </a>
                </li>

                {{-- <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'testimonials' ? 'active' : '' }}"
                href="{{ url('admin/testimonials') }}" aria-expanded="false">
                <iconify-icon icon="dashicons:testimonial"></iconify-icon>
                <span class="hide-menu">Testimonials</span>
                </a>
                </li> --}}




              
                <!-- <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'services' ? 'active' : '' }}"
                        href="{{ url('admin/services') }}" aria-expanded="false">
                        <iconify-icon icon="carbon:cloud-services"></iconify-icon>
                        <span class="hide-menu">Services</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'testimonials' ? 'active' : '' }}"
                        href="{{ url('admin/testimonials') }}" aria-expanded="false">
                        <iconify-icon icon="dashicons:testimonial"></iconify-icon>
                        <span class="hide-menu">Testimonials</span>
                    </a>
                </li> -->


                {{-- <li class="sidebar-item">
                            <a class="sidebar-link {{ $admin_page == 'emails_content' || $admin_page == 'emails' ? 'active' : '' }}"
                href="{{ url('admin/emails_content') }}" aria-expanded="false">
                <iconify-icon icon="mdi:email-edit-outline"></iconify-icon>
                <span class="hide-menu">Edit Emails</span>
                </a>
                </li> --}}


                {{-- <li class="sidebar-item">
                        <a class="sidebar-link has-arrow {{ $admin_page == 'real_estate_focus' || $admin_page == 'specialties' || $admin_page == 'area_served' || $admin_page == 'languages' || $admin_page == 'time_zones' || $admin_page == 'seller_add_on' || $admin_page == 'buyer_add_on' || $admin_page == 'categories' ? 'active' : '' }}"
                href="javascript:void(0)" aria-expanded="false">
                <iconify-icon icon="clarity:list-solid"></iconify-icon>
                <span class="hide-menu">Extras</span>
                </a>
                <ul aria-expanded="false"
                    class="collapse first-level {{ $admin_page == 'real_estate_focus' || $admin_page == 'specialties' || $admin_page == 'area_served' || $admin_page == 'languages' || $admin_page == 'time_zones' || $admin_page == 'seller_add_on' || $admin_page == 'buyer_add_on' || $admin_page == 'categories' ? 'in' : '' }}">

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ $admin_page == 'real_estate_focus' ? 'active' : '' }}"
                            href="{{ url('admin/real_estate_focus') }}" aria-expanded="false">
                            <iconify-icon icon="mdi:home-outline"></iconify-icon>

                            <span class="hide-menu">Property Type</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ $admin_page == 'specialties' ? 'active' : '' }}"
                            href="{{ url('admin/specialties') }}" aria-expanded="false">
                            <iconify-icon icon="mdi:star-outline"></iconify-icon>
                            <span class="hide-menu">Real Estate Specialties</span>
                        </a>
                    </li>


                    <li class="sidebar-item">
                        <a class="sidebar-link {{ $admin_page == 'languages' ? 'active' : '' }}"
                            href="{{ url('admin/languages') }}" aria-expanded="false">
                            <iconify-icon icon="mdi:translate"></iconify-icon>
                            <span class="hide-menu">Languages Fluent</span>
                        </a>
                    </li>


                    <li class="sidebar-item">
                        <a class="sidebar-link {{ $admin_page == 'time_zones' ? 'active' : '' }}"
                            href="{{ url('admin/time_zones') }}" aria-expanded="false">
                            <iconify-icon icon="mdi:clock-outline"></iconify-icon>
                            <span class="hide-menu">Primary Time Zones</span>
                        </a>
                    </li>



                    <li class="sidebar-item">
                        <a class="sidebar-link {{ $admin_page == 'seller_add_on' ? 'active' : '' }}"
                            href="{{ url('admin/seller_add_on') }}" aria-expanded="false">
                            <iconify-icon icon="game-icons:sell-card"></iconify-icon>
                            <span class="hide-menu">Seller Add-ons</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ $admin_page == 'buyer_add_on' ? 'active' : '' }}"
                            href="{{ url('admin/buyer_add_on') }}" aria-expanded="false">
                            <iconify-icon icon="game-icons:buy-card"></iconify-icon>
                            <span class="hide-menu">Buyer Add-ons</span>
                        </a>
                    </li>


                    <li class="sidebar-item">
                        <a class="sidebar-link {{ $admin_page == 'categories' ? 'active' : '' }}"
                            href="{{ url('admin/categories') }}" aria-expanded="false">
                            <iconify-icon icon="carbon:category"></iconify-icon>
                            <span class="hide-menu">Report Issue Categories</span>
                        </a>
                    </li>


                </ul>
                </li> --}}




                {{-- <li class="sidebar-item">
                            <a class="sidebar-link has-arrow {{ $admin_page == 'article' || $admin_page == 'article_topic' ? 'active' : '' }}"
                href="javascript:void(0)" aria-expanded="false">
                <iconify-icon icon="ooui:articles-rtl"></iconify-icon>
                <span class="hide-menu">Articles</span>
                </a>
                <ul aria-expanded="false"
                    class="collapse first-level {{ $admin_page == 'article' || $admin_page == 'article_topic' ? 'in' : '' }}">


                    <li class="sidebar-item">
                        <a class="sidebar-link {{ $admin_page == 'article_topic' ? 'active' : '' }}"
                            href="{{ url('admin/article_topic') }}">
                            <span class="icon-small"></span>Article
                            Topics
                        </a>
                    </li>


                    <li class="sidebar-item">
                        <a class="sidebar-link {{ $admin_page == 'article' ? 'active' : '' }}"
                            href="{{ url('admin/article') }}">
                            <span class="icon-small"></span>Articles
                        </a>
                    </li>


                </ul>
                </li> --}}


                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow {{ $admin_page == 'faqs' || $admin_page == 'faq_categories' ? 'active' : '' }}"
                        href="javascript:void(0)" aria-expanded="false">
                        <iconify-icon icon="mdi:faq"></iconify-icon>
                        <span class="hide-menu">FAQs</span>
                    </a>
                    <ul aria-expanded="false"
                        class="collapse first-level {{ $admin_page == 'faqs' || $admin_page == 'faq_categories' ? 'in' : '' }}">

                        <li class="sidebar-item">
                            <a class="sidebar-link {{ $admin_page == 'faqs' ? 'active' : '' }}"
                                href="{{ url('admin/faqs') }}">
                                <span class="icon-small"></span>FAQs

                            </a>
                        </li>


                    </ul>
                </li>

            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>