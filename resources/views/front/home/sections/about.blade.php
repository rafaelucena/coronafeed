<div class="container">
    <!-- section title -->
    <h2 class="section-title wow fadeInUp">{{ $form->about->getTitle() }}</h2>

    <div class="spacer" data-height="60"></div>

    <div class="row">

        <div class="col-md-3">
            <div class="text-center text-md-left">
                <!-- avatar image -->
                <img src="{{ asset('front/images/brazilglobered.png') }}" alt="Brasil on a Globe" />
            </div>
            <div class="spacer d-md-none d-lg-none" data-height="30"></div>
        </div>

        <div class="col-md-9 triangle-left-md triangle-top-sm">
            <div class="rounded bg-white shadow-dark padding-30">
                <div class="row">
                    
                    <div class="col-md-12">
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
                        <p class="update-time">Atualizado :
                            {{ $form->about->getUpdated() }}</p>
                    </div>
                    
                    
                    

                     <!--   <span class="badge-about">{{ $form->about->getUpdated() }}</span>
                        
                         about text 
                        <p>{{ $form->about->getDescription() }}</p>
                        -->
                        
                    
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
                @if($type === 'new-cases')
                <span class="icon fas fa-angle-double-up fa-2x"></span>
                @elseif($type === 'confirmed')
                <span class="icon fas fa-check"></span>
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