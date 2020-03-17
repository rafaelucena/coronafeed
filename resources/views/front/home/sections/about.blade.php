<div class="container">		
    <!-- section title -->
    <h2 class="section-title wow fadeInUp">{{ $form->about->getTitle() }}</h2>

    <div class="spacer" data-height="60"></div>
    
    <div class="row">

        <div class="col-md-3">
            <div class="text-center text-md-left">
                <!-- avatar image -->
                <img src="https://via.placeholder.com/150x150" alt="Bolby" />
            </div>
            <div class="spacer d-md-none d-lg-none" data-height="30"></div>
        </div>

        <div class="col-md-9 triangle-left-md triangle-top-sm">
            <div class="rounded bg-white shadow-dark padding-30">
                <div class="row">
                    <div class="col-md-6">
                        <!-- about text -->
                        <p>{{ $form->about->getDescription() }}</p>
                        <div class="mt-3">
                            <a href="#" class="btn btn-default">{{ $form->about->getButton() }}</a>
                        </div>
                        <div class="spacer d-md-none d-lg-none" data-height="30"></div>
                    </div>
                    <div class="col-md-6">
                        <!-- skill item -->
                        <div class="skill-item">
                            <div class="skill-info clearfix">
                                <h4 class="float-left mb-3 mt-0">Development</h4>
                                <span class="float-right">85%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar data-background" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="85" data-color="#FFD15C">
                                </div>
                            </div>
                            <div class="spacer" data-height="20"></div>
                        </div>

                        <!-- skill item -->
                        <div class="skill-item">
                            <div class="skill-info clearfix">
                                <h4 class="float-left mb-3 mt-0">UI/UX design</h4>
                                <span class="float-right">95%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar data-background" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="95" data-color="#FF4C60">
                                </div>
                            </div>
                            <div class="spacer" data-height="20"></div>
                        </div>

                        <!-- skill item -->
                        <div class="skill-item">
                            <div class="skill-info clearfix">
                                <h4 class="float-left mb-3 mt-0">Photography</h4>
                                <span class="float-right">70%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar data-background" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="70" data-color="#6C6CE5">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- row end -->

    <div class="spacer" data-height="70"></div>
    
    <div class="row">
        @foreach($form->about->getCounters() as $type => $counter)
        <div class="col-md-3 col-sm-6">
            <!-- fact item -->
            <div class="fact-item">
                @if($type === 'suspected')
                <span class="icon icon-magnifier"></span>
                @elseif($type === 'confirmed')
                <span class="icon icon-people"></span>
                @elseif($type === 'deaths')
                <span class="icon icon-ghost"></span>
                @elseif($type === 'cured')
                <span class="icon icon-heart"></span>
                @endif
                <div class="details">
                    <h3 class="mb-0 mt-0 number"><em class="count">{{ $counter['count'] }}</em></h3>
                    <p class="mb-0">{{ $counter['label'] }}</p>
                </div>
            </div>
            <div class="spacer d-md-none d-lg-none" data-height="30"></div>
        </div>
        @endforeach
    </div>

</div>