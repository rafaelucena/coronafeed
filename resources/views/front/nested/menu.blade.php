<ul class="vertical-menu scrollspy">
    <li class="search-location">
        <i class="search-bar fas fa-search"></i>
        <select class="select2-simple js-states form-control" id="location-search-bar">
            <option value="">{{ $form->view->getMenu()['LOCATION_MENU_SEARCH'] }}</option>
            @foreach($form->menu->getList() as $location)
            <option value="{{ $location['id'] }}">{{ $location['label'] }}</option>
            @endforeach
        </select>
    </li>
    <li class="active"><a href="#home"><i class="fas fa-asterisk"></i>{{ $form->view->getMenu()['LOCATION_MENU_HOME'] }}</a></li>
    <!--<li><a href="#map"><i class="fas fa-globe-americas"></i>Map of Brazil</a></li>-->
    <li><a href="#about"><i class="fas fa-superscript"></i>{{ $form->view->getMenu()['LOCATION_MENU_NUMBERS'] }}</a></li>
    <li><a href="#map-world"><i class="fas fa-globe"></i>{{ $form->view->getMenu()['LOCATION_MENU_WORLD'] }}</a></li>
    <li><a href="#charts"><i class="fas fa-chart-bar"></i>{{ $form->view->getMenu()['LOCATION_MENU_CHARTS'] }}</a></li>
    <!-- <li><a href="#services"><i class="fas fa-chart-bar"></i>Analytics</a></li>
    <li><a href="#experience"><i class="fas fa-history"></i>History</a></li>
    <li><a href="#works"><i class="fas fa-question-circle"></i>Information</a></li>
    <li><a href="#blog"><i class="fas fa-link"></i>Links</a></li>
    <li><a href="#contact"><i class="fas fa-feather-alt"></i>Contact us</a></li> -->
</ul>

