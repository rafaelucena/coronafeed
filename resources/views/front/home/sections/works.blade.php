<div class="container">			
    <!-- section title -->
    <h2 class="section-title wow fadeInUp">Recent works</h2>

    <div class="spacer" data-height="60"></div>

    <!-- portfolio filter (desktop) -->
    <ul class="portfolio-filter list-inline wow fadeInUp">
        <li class="current list-inline-item" data-filter="*">Everything</li>
        <li class="list-inline-item" data-filter=".creative">Creative</li>
        <li class="list-inline-item" data-filter=".art">Art</li>
        <li class="list-inline-item" data-filter=".design">Design</li>
        <li class="list-inline-item" data-filter=".branding">Branding</li>
    </ul>
    
    <!-- portfolio filter (mobile) -->
    <div class="pf-filter-wrapper">
        <select class="portfolio-filter-mobile">
            <option value="*">Everything</option>
            <option value=".creative">Creative</option>
            <option value=".art">Art</option>
            <option value=".design">Design</option>
            <option value=".branding">Branding</option>
        </select>
    </div>
    
    <!-- portolio wrapper -->
    <div class="row portfolio-wrapper">
        
        <!-- portfolio item -->
        <div class="col-md-4 col-sm-6 grid-item art">
            <a href="https://via.placeholder.com/330x267" class="work-image">
                <div class="portfolio-item rounded shadow-dark">
                    <div class="details">
                        <span class="term">Art</span>
                        <h4 class="title">Project Managment Illustration</h4>
                        <span class="more-button"><i class="icon-magnifier-add"></i></span>
                    </div>
                    <div class="thumb">
                        <img src="https://via.placeholder.com/330x267" alt="Portfolio-title" />
                        <div class="mask"></div>
                    </div>
                </div>
            </a>
        </div>

        <!-- portfolio item -->
        <div class="col-md-4 col-sm-6 grid-item creative design">
            <a href="#small-dialog" class="work-content">
                <div class="portfolio-item rounded shadow-dark">
                    <div class="details">
                        <span class="term">Creative</span>
                        <h4 class="title">Guest App Walkthrough Screens</h4>
                        <span class="more-button"><i class="icon-options"></i></span>
                    </div>
                    <div class="thumb">
                        <img src="https://via.placeholder.com/330x267" alt="Portfolio-title" />
                        <div class="mask"></div>
                    </div>
                </div>
            </a>
            <div id="small-dialog" class="white-popup zoom-anim-dialog mfp-hide">
                <img src="https://via.placeholder.com/590x280" alt="Title" />
                <h2>Guest App Walkthrough Screens</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam hendrerit nibh in massa semper rutrum. In rhoncus eleifend mi id tempus.</p>
                <p>Donec consectetur, libero at pretium euismod, nisl felis lobortis urna, id tristique nisl lectus eget ligula.</p>
                <a href="#" class="btn btn-default">View on Dribbble</a>
            </div>
        </div>

        <!-- portfolio item -->
        <div class="col-md-4 col-sm-6 grid-item branding">
            <a href="https://www.youtube.com/watch?v=qf9z4ulfmYw" class="work-video">
                <div class="portfolio-item rounded shadow-dark">
                    <div class="details">
                        <span class="term">Branding</span>
                        <h4 class="title">Delivery App Wireframe</h4>
                        <span class="more-button"><i class="icon-camrecorder"></i></span>
                    </div>
                    <div class="thumb">
                        <img src="https://via.placeholder.com/330x267" alt="Portfolio-title" />
                        <div class="mask"></div>
                    </div>
                </div>
            </a>
        </div>

        <!-- portfolio item -->
        <div class="col-md-4 col-sm-6 grid-item creative">
            <a href="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/240233494&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true" class="work-video">
                <div class="portfolio-item rounded shadow-dark">
                    <div class="details">
                        <span class="term">Creative</span>
                        <h4 class="title">Onboarding Motivation</h4>
                        <span class="more-button"><i class="icon-music-tone-alt"></i></span>
                    </div>
                    <div class="thumb">
                        <img src="https://via.placeholder.com/330x267" alt="Portfolio-title" />
                        <div class="mask"></div>
                    </div>
                </div>
            </a>
        </div>

        <!-- portfolio item -->
        <div class="col-md-4 col-sm-6 grid-item art branding">
            <a href="#gallery-1" class="gallery-link">
                <div class="portfolio-item rounded shadow-dark">
                    <div class="details">
                        <span class="term">Art, Branding</span>
                        <h4 class="title">iMac Mockup Design</h4>
                        <span class="more-button"><i class="icon-picture"></i></span>
                    </div>
                    <div class="thumb">
                        <img src="https://via.placeholder.com/330x267" alt="Portfolio-title" />
                        <div class="mask"></div>
                    </div>
                </div>
            </a>
            <div id="gallery-1" class="gallery mfp-hide">
                <a href="https://via.placeholder.com/330x267"></a>
                <a href="https://via.placeholder.com/330x267"></a>
            </div>
        </div>

        <!-- portfolio item -->
        <div class="col-md-4 col-sm-6 grid-item creative design">
            <a href="https://themeforest.net/user/pxlsolutions/portfolio" target="_blank">
                <div class="portfolio-item rounded shadow-dark">
                    <div class="details">
                        <span class="term">Creative, Design</span>
                        <h4 class="title">Game Store App Concept</h4>
                        <span class="more-button"><i class="icon-link"></i></span>
                    </div>
                    <div class="thumb">
                        <img src="https://via.placeholder.com/330x267" alt="Portfolio-title" />
                        <div class="mask"></div>
                    </div>
                </div>
            </a>
        </div>

    </div>
    
    <!-- more button -->
    <div class="load-more text-center mt-4">
        <a href="javascript:" class="btn btn-default"><i class="fas fa-spinner"></i> Load more</a>
        <!-- numbered pagination (hidden for infinite scroll) -->
        <ul class="portfolio-pagination list-inline d-none">
            <li class="list-inline-item">1</li>
            <li class="list-inline-item"><a href="works-2.html">2</a></li>
        </ul>
    </div>

</div>