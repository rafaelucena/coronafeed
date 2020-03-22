<div class="container">		
    <!-- section title -->
    <h2 class="section-title wow fadeInUp">{{ $form->about->getTitle() }}</h2>

    <div class="spacer" data-height="60"></div>
    
    <div class="row">

        <div class="col-md-3">
            <div class="text-center text-md-left">
                <!-- avatar image -->
                <img src="https://via.placeholder.com/150x150" alt="Covid-19" />
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
                        @foreach($form->about->getEstimations() as $type => $estimation)
                        <div class="skill-item">
                            <div class="skill-info clearfix">
                                <h4 class="float-left mb-3 mt-0">{{ $estimation['label'] }}</h4>
                                <span class="float-right">{{ $estimation['average'] }}%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar data-background" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="{{ $estimation['average'] }}" data-color="#FF4C60">
                                </div>
                            </div>
                            <div class="spacer" data-height="20"></div>
                        </div>
                        @endforeach
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
                <span class="icon fas fa-search fa-2x"></span>
                @elseif($type === 'confirmed')
                <span class="icon fas fa-search-plus"></span>
                @elseif($type === 'deaths')
                <span class="icon fas fa-cross"></span>
                @elseif($type === 'cured')
                <span class="icon fas fa-heart"></span>
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